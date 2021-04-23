<?php namespace App\Http\Controllers\Auth;

use App\Classes\Kinnect2;
use App\Repository\Eloquent\SettingRepository;
use App\Repository\Eloquent\UsersRepository;
use App\StoreOption;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    protected $usersRepository;
    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    protected $redirectTo = '/';

    //protected $redirectTo = '/profile';
    protected $redirectPath  = '/';
    protected $loginPath = 'login';
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the REGISTRATION of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;


    /**
     * AuthController constructor.
     * @param Guard $auth
     * @param Registrar $registrar
     * @param UsersRepository $usersRepository
     * @param SettingRepository $settingRepository
     */
    public function __construct(Guard $auth, Registrar $registrar, UsersRepository $usersRepository, SettingRepository $settingRepository)
    {
        parent::__construct();
        \View::addLocation(realpath(base_path('resources/views')));
        $this->auth            = $auth;
        $this->registrar       = $registrar;
        $this->usersRepository = $usersRepository;

        $this->middleware('guest',
            ['except' =>
                 ['getLogout', 'resendEmail', 'activateAccount'],
            ]);
        $this->settingRepository = $settingRepository;
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required',
            'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        //$credentials = $this->getCredentials($request);
        $remember = $request->remember;
        $fields = ['email' => $request->email, 'password' => $request->password, 'active' => 1];

        if(!empty($this->store_id))
        {
            $fields['store_id'] = $this->store_id;
        }elseif(!$this->is_market_place) {
            $fields['user_type'] = 2;
        }else{
            $fields['registered_via'] = 'marketplace';
        }

        if (\Auth::attempt($fields ,$remember)) {
            $previous_session = \Auth::user()->session_id;

            if ($previous_session) {
                \Session::getHandler()->destroy($previous_session);
            }

            \Auth::user()->session_id = \Session::getId();
            \Auth::user()->save();
            // if (Auth::attempt($credentials, $request->has('remember'))) {
            if(\Auth::user()->user_type == 3){
                \Session::flush(); // removes all session data
                return redirect($this->loginPath())
                  ->withInput($request->only($this->loginUsername(), 'remember'))
                  ->withErrors([
                    $this->loginUsername() => $this->getFailedLoginMessage(),
                  ]);
            }

            if(\Auth::user()->user_type == 100) {
                return redirect('admin');
            }

            if(\Auth::user()->user_type == 2) {
                //return redirect('store/'.\Auth::user()->username.'/admin/orders');
                $systemConfig = StoreOption::where('store_id', \Auth::user()->id)->select(['key','value'])->get()->toArray();
                $systemConfig = $this->parseSystemConfiguration($systemConfig);

                \Session::put('SYSTEM_CONFIGURATION',$systemConfig);
                return redirect('admin/dashboard');
            }


                return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
          ->withInput($request->only($this->loginUsername(), 'remember'))
          ->withErrors([
            $this->loginUsername() => $this->getFailedLoginMessage(),
          ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request, Kinnect2 $kinnect2)
    {
        $validated = $this->stepOne($request);
        if($validated != '')
        {
            return response()->json($validated);
        }

        $activation_code = str_random(60) . $request->input('email');
        $user            = new User;

        $username = \Kinnect2::slugify($request->input('first_name') . '-' . $request->input('last_name'), ['table' => 'users', 'field' => 'username']);

        $user->name            = $request->input('first_name') . ' ' . $request->input('last_name');
        $user->first_name      = $request->input('first_name');
        $user->last_name       = $request->input('last_name');
        $user->email           = $request->input('email');
        $user->password        = bcrypt($request->input('password'));
        $user->activation_code = $activation_code;
        $user->store_id        = !empty($this->store_id) ? $this->store_id : 0;
        $user->user_type       = $request->input('user_type');
        $user->gender           = $request->input('gender');
        $user->displayname     = $request->input('first_name') . ' ' . $request->input('last_name');
        $user->username        = $username;
        $user->website         = '';
        $user->facebook        = '';
        $user->twitter         = '';
        $user->country         = '161';
        $user->timezone        = 'asia';

        $dt = Carbon::Now();
        $dt->addDays(29);

        $user->token_expiry_date = $dt;

        if ($user->save()) {

            if($this->is_market_place)
            {
                $user->registered_via = 'marketplace';
            }else{
                $user->registered_via = 'store';
            }

            if($user->user_type == \Config::get('constants.BRAND_USER')) {

                $user->store_id = $user->id;

                if(!$this->is_market_place) {

                    $this->setDefaultTheme($user->id);

                }

                $store_name = $final = \Kinnect2::formatStoreName($request->get('store_name'));
                $key = \Config::get('constants_theme.STORE_URL');
                $this->saveStoreOption($user->id, $key, $store_name);

            }

            $user->save();

            $this->sendEmail($user);

            if($user->user_type == \Config::get('constants.BRAND_USER') && !$this->is_market_place)
            {
                \Session::flash('message', 'accountCreated');
                \Session::flash('email', $request->input('email'));
                return redirect('/');
            }

            return view('auth.activateAccount')
                ->with('email', $request->input('email'))->with('store_name',@$store_name);

        } else {

            \Session::flash('message', \Lang::get('notCreated'));
            return redirect()->back()->withInput();
        }
    }
    protected function setDefaultTheme($store_id) {

        \Kinnect2::saveDefaultTheme($store_id);

    }
    public function saveStoreOption($store_id,$key,$value)
    {
        \Kinnect2::saveStoreOption($store_id,$key,$value);
    }
    public function sendEmail(User $user)
    {

        $data = array(
            'name' => $user->name,
            'code' => $user->activation_code,
        );

       \Mail::queue('emails.activateAccount', $data, function ($message) use ($user) {
            $message->subject(\Lang::get('auth.pleaseActivate'));
            $message->to($user->email);
            $message->from("Cartimatic@no-reply.com");
        });
    }

    public function resendEmail()
    {
        $user = \Auth::user();
        if ($user->resent >= 5) {
            return view('auth.tooManyEmails')
                ->with('email', $user->email);
        } else {
            if ($user->deleted == 1) {
                $activation_code       = str_random(60) . $user->email;
                $user->activation_code = $activation_code;
                $user->deleted         = 0;
            }

            $user->resent = $user->resent + 1;
            $dt           = Carbon::Now();
            $dt->addDays(30);

            $user->token_expiry_date = $dt;

            $user->save();
            $this->sendEmail($user);

            return view('auth.activateAccount')
                ->with('email', $user->email);
        }
    }

    public function activateAccount($code, User $user)
    {

        if ($user->accountIsActive($code)) {
                \Session::flash('message', \Lang::get('auth.successActivated'));

                return redirect('/');
        }

        \Session::flash('message', \Lang::get('auth.unsuccessful'));

        return redirect('/');

    }

    public function userAlreadyRegistered(Request $request)
    {
        $data['email'] = $request->email;
        return view("auth.activateAccount", $data);
    }

    public function allCountries()
    {
        return DB::table('countries')->lists('name', 'id');
    }


    public function home(Request $reques)
    {
        return abort('404');
    }

    public function stepOne(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/|confirmed',
            'password_confirmation' => 'required|min:6',
        ];
        if ($request->user_type == 2 && !$this->is_market_place) {
            $rules['store_name'] = \Kinnect2::getStoreNameValidationRule();
        }
        $validator = Validator::make(
            [
                'email' => $request->email,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation,
                'store_name' => \Kinnect2::formatStoreName($request->store_name),
            ],
            $rules,
            [
                'required' => ':attribute field is required',
            ]
        );

        $email = $request->email;

        if ($request->user_type == 2) {
            $validator->after(function ($validator) use ($email) {
                if ($this->isUniqueSellerEmail($email))
                {
                    $validator->errors()->add('email', 'This is email address is already taken');
                }
            });
        }elseif($request->user_type == 1) {
            $validator->after(function ($validator) use ($email) {
                if ($this->isUniqueBuyerEmail($email))
                {
                    $validator->errors()->add('email', 'This is email address is already taken');
                }
            });
        }

        if ($validator->fails()) {
            return $validator->messages();
        } else {
            return '';
        }
    }
    public function isUniqueSellerEmail($email)
    {
        return User::where('email','like',$email)->count();
    }
    public function isUniqueBuyerEmail($email)
    {
        return User::where('email','like',$email)->where('store_id',$this->store_id)->count();
    }
    public function resetPassword(Request $request) {
         $data['token'] = $request->token;
        return view("auth.passwords.reset" ,$data)->with('title', 'Reset Password');

    }
    /*protected function authenticated(Request $request, User $user)
    {
        return redirect()->route('home');
    }*/
    public function postReset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:7|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!@#$%^&*]).*$/',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        DB::table('users')
          ->where('email' ,$request->email )
          ->update(['active' => 1 , 'activation_code' => '' ,'verified' => 1 ]);
        $response = Password::reset($credentials, function ($user, $password) {
            $this->resetNewPassword($user, $password);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                return redirect($this->redirectPath())->with('status', trans($response));
            default:
                return redirect()->back()
                                 ->withInput($request->only('email'))
                                 ->withErrors(['email' => trans($response)]);
        }
    }
    protected function resetNewPassword($user, $password)
    {
        $user->password = bcrypt($password);

        $user->save();

        Auth::login($user);
    }
    public function validateEmail(Request $request)
    {
        $email = \Request::get('email');

        $validator = Validator::make(
            ['email' => $request->email],
            ['email' => 'required|email|unique:users']
        );

        if($validator->fails()){
            return response()->json("The email is already taken");
        }else{
            return response()->json("true");
        }
    }

    /**
     * @return string
     */
    public function loginPath() {
        return $this->loginPath;
    }

    private function parseSystemConfiguration($systemConfig) {
        $config = [];
        $systemConfigD = array_column($systemConfig, 'key');

        $key = array_search('CURRENCY', $systemConfigD);
        if(!$key){
            $defaultConfig = \Config::get('store_configuration');
            foreach ( $defaultConfig as $item) {
                if(isset($item['DEFAULT_VALUE'])){
                    $config[$item['NAME']] = $item['DEFAULT_VALUE'];
                }
            }
        }else{
            foreach ($systemConfig as $item) {
                $config[$item['key']] = $item['value'];
                //$config[] = $con;
            }
        }
        return $config;
    }
}
