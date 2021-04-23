<?php

namespace App\Http\Controllers;

use App\ActivityAction;
use App\Consumer;
use App\Repository\Eloquent\ActivityActionRepository;
use App\Repository\Eloquent\FriendshipRepository;
use App\Repository\Eloquent\PrivacyRepository;
use App\Repository\Eloquent\SettingRepository;
use App\Repository\Eloquent\UsersRepository;
use App\User;
use Auth;
use Config;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Validator;

//use App\StorageFile;

class UsersController extends Controller
{
    protected $usersRepository;
    protected $data;
    protected $is_api;
    private   $user_id;
    private   $users;
    private   $setting;
    /**
     * @var AlbumRepository
     */

    /**
     * @var FriendshipRepository
     */
    private $friendshipRepository;

    public function __construct(UsersRepository $users, Request $middleware, FriendshipRepository $friendshipRepository) {
        parent::__construct();
        $this->users   = $users;
        $this->user_id = $middleware[ 'middleware' ][ 'user_id' ];
        @$this->data->user = $middleware[ 'middleware' ][ 'user' ];
        $this->is_api               = $middleware[ 'middleware' ][ 'is_api' ];
        $this->friendshipRepository = $friendshipRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = NULL) {

        return view('user.index');
    }

    public function profile(UsersRepository $usersRepository, $user_id = NULL, $tab = NULL) {

        return view('user.index');

    }

    public function generalSetting() {

        $defaultTimezone = ['0' => 'Select Timezone'];
        $timezonesList   = DB::table('time_zone')->lists('country', 'value');
        $timezonesList   = $defaultTimezone + $timezonesList;
        if($this->is_api) {
            $data[ 'email' ]       = $this->data->user->email;
            $data[ 'username' ]    = $this->data->user->username;
            $data[ 'displayname' ] = $this->data->user->displayname;
            $data[ 'timezone' ]    = (isset($this->data->user->timezone) ? $this->data->user->timezone : '');
            $data[ 'birthdate' ]   = Consumer::find($this->data->user->userable_id)->birthdate;
            $data[ 'timezones' ]   = $timezonesList;

            return \Api::success_data($data);
        }
        $currentUser = User::find($this->user_id);
        $consumer    = Consumer::find($currentUser->userable_id);

        return view('settings.generalSetting', ['consumer' => $consumer])
            ->with('timezonesList', $timezonesList)
            ->with('userTimezone', '')
            ->with('current', $currentUser)
            ->with('title', 'General Settings');
    }

    public function generalSettingSave(Request $request) {
        $currentUser = User::find($this->user_id);
        if(!\Input::has('timezone')) {
            if($this->is_api) {
                return \Api::invalid_param();
            }
        }
        $currentUser->timezone = $request->timezone;

        if($currentUser->user_type == Config::get('constants.REGULAR_USER')) {
            // consumer
            $consumer = Consumer::find($currentUser->userable_id);
            if($this->is_api) {
                $consumer->birthdate = $request->birthdate;
            } else {
                $consumer->birthdate = $request->datepicker;
            }

            $consumer->save();

            if($currentUser->user_type == Config::get('constants.BRAND_USER')) {
                // brand
                $brand = Consumer::find($currentUser->userable_id);
                $brand->save();
                //end for brand

            }
        }
        $currentUser->save();
        if($this->is_api) {
            return \Api::success_with_message();
        }

        return Redirect::back();

    }

    public function changePassword() {

        return view("settings.changePassword")->with('title', 'Change Password');
    }

    public function userPasswordChange(Request $request) {

        if($this->is_api) {
            $validation = Validator::make($request->all(), [
                'old_password'       => 'required',
                'password'           => 'required|min:7|different:old_password|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!@#$%^&*]).*$/',
                'conformed_password' => 'required|min:7',
            ]);
            if($validation->fails()) {
                return \Api::invalid_param();
            }
        } else {
            $this->validate($request, [
                'old_password'       => 'required',
                'password'           => 'required|min:7|different:old_password|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!@#$%^&*]).*$/',
                'conformed_password' => 'required|min:7',
            ]);
        }

        $oldPassword      = Input::get('old_password');
        $id               = $this->user_id;
        $user             = User::find($id);
        $current_password = $user->password;
        $new_password     = Input::get('password');
        $confirm_password = Input::get('conformed_password');

        if(\Hash::check($oldPassword, $current_password)) {

            if($new_password != $confirm_password) {
                if($this->is_api) {
                    return \Api::other_error('New password and conformed password does not match');
                }

                return Redirect::back()->withErrors('New password and conformed password does not match');
            } else {
                $user->password = bcrypt($new_password);

                $user->save();
                if($this->is_api) {
                    return \Api::success_with_message();
                }

                return Redirect::to('/logout');
            }
        } else {
            if($this->is_api) {
                return \Api::other_error('Old password is incorrect');
            }

            return Redirect::back()->withErrors('Old password is incorrect');
        }
    }

    public function deleteAccountpage() {

        return view("settings.deleteAccount")->with('title', 'Delete Account');
    }

    public function getProfile() {

        $user_id                          = Auth::user()->id;
        $get_user_record[ 'user_record' ] = User::select('first_name', 'last_name', 'gender')->where('id', $user_id)->first();
        if($this->is_api) {
            return \Api::success($get_user_record[ 'user_record' ]);
        }
        return view("settings.profileSetting", $get_user_record);
    }

    public function updateProfile(Request $request) {

        $user_id                      = Auth::user()->id;
        $save_user_record             = User::find($user_id);
        $save_user_record->first_name = $request->first_name;
        $save_user_record->last_name  = $request->last_name;
        $save_user_record->gender     = $request->gender;
        $save_user_record->save();
        $save_user_record[ 'user_record' ] = User::where('id', $user_id)->first();
        if($this->is_api) {
            return \Api::success_with_message();
        }
        return view("settings.profileSetting", $save_user_record)->with('message', 'Update Record Successfully');
    }

    /**
     * @param SettingRepository $setting
     *
     * @return $this|\Illuminate\Http\JsonResponse
     *
     */
    public function privacySetting(SettingRepository $setting) {

        $this->setting = $setting;
        $userId        = $this->user_id;
        $records       = $this->setting->getSetting($userId);
        $all_data      = array();
        foreach ($records as $key => $record) {
            $all_data[ $record->setting ] = array(
                'category'      => $record->category,
                'setting'       => $record->setting,
                'setting_value' => $record->setting_value,
            );
        }

        if($this->is_api) {
            $data[ 'privacy' ][ 'title' ] = 'Privacy';
            foreach (Config::get('constants_setting.privacyApi') as $key => $row) {
                $data[ 'privacy' ][ 'options' ][] = [
                    'title'       => $row[ 'TITLE' ],
                    'description' => $row[ 'DESCRIPTION' ],
                    'type'        => $row[ 'TYPE' ],
                    'options'     => $this->get_setting_options($row, $all_data),
                    'value'       => (isset($all_data[ $key ]) ? $all_data[ $key ][ 'setting_value' ] : ''),
                ];
            }
            $data[ 'notification' ][ 'title' ]       = 'Notification Settings';
            $data[ 'notification' ][ 'subtitle' ]    = 'Notification Settings';
            $data[ 'notification' ][ 'description' ] = 'Which of the these do you want to receive email alerts about?';
            foreach (Config::get('constants_setting.notificationApi') as $key => $row) {
                $data[ 'notification' ][ 'options' ][] = [
                    'title'       => $row[ 'TITLE' ],
                    'description' => $row[ 'DESCRIPTION' ],
                    'type'        => $row[ 'TYPE' ],
                    'options'     => $this->get_setting_options($row, $all_data),
                ];
            }

            return \Api::success(['results' => $data]);
        }
        $data[ 'settings' ] = $all_data;

        return view('settings.privacySetting', $data)->with('title', 'Privacy Settings');
    }

    public function postSetting() {
        if($this->is_api) {

            return $this->users->save_settings_api($this->user_id);
        }
        $data[ 'category' ] = Input::get('category');
        $data[ 'item' ]     = Input::get('item');
        $data[ 'value' ]    = Input::get('value');

        return $this->users->post_settings($this->user_id, $data);
    }

    public function saveSetting(SettingRepository $setting) {//Save all setting in db

        $this->setting = $setting;
        $userId        = Auth::user()->id;
        $this->setting->saveAllSetting($userId);

    }

    /*public function search_friends() {
        $userId         = \Input::get('userId');
        $searchType     = \Input::get('srchType');
        $key            = \Input::get('key');
        $data['type']   = $searchType;
        $data['userId'] = $userId;
        switch ($searchType) {
            case 'kinnectors':
                if(empty($key)) {
                    $data['kinnectors'] = $this->users->friends($userId);
                } else {
                    $data['kinnectors'] = $this->search_kinnectors($userId, $key);
                }
                break;
            case 'following':
                if(empty($key)) {
                    $data['brands'] = \Kinnect2::myAllBrands($userId);
                } else {
                    $data['brands'] = $this->searchMyBrands($userId, $key);
                }
                break;
            case 'followers':
                if(empty($key)) {
                    $data['followers'] = $this->brandRepository->get_brand_kinnectors($userId);
                } else {
                    $data['followers'] = $this->searchBrandKinnectors($userId, $key);
                }
                break;
            case 'all_recommended':
                if(empty($key)) {
                    $data['all_recommended'] = $this->friendshipRepository->all_recommended($userId, NULL);
                } else {
                    $data['all_recommended'] = $this->friendshipRepository->all_recommended_search($userId, $key);
                }
                break;
            case 'recommended-brands':
                if(empty($key)) {
                    $data['brands'] = \Kinnect2::recomendedAllBrands();
                } else {
                    $data['brands'] = \Kinnect2::recommendedAllBrandsSearch($key);
                }

        }

        return view('templates.partials.paginate.users', $data);

    }

    private function search_kinnectors($userId, $key) {
        return $this->users->search_kinnectors($userId, $key);
    }

    private function searchMyBrands($userId, $key) {
        return $this->users->searchMyBrands($userId, $key);
    }

    private function searchBrandKinnectors($userId, $key) {
        return $this->users->searchBrandKinnectors($userId, $key);
    }

    private function get_setting_options($row, $all_data) {
        $options = [];
        if($row['TYPE'] == 'multi-check') {
            foreach ($row['OPTIONS'] as $optKey => $option) {
                $options[] = [
                    'description' => $option,
                    'id'          => $optKey,
                    'value'       => (isset($all_data[$optKey]) ? $all_data[$optKey]['setting_value'] : '0'),
                ];
            }
        } else {
            foreach ($row['OPTIONS'] as $optKey => $option) {
                $options[] = [
                    'description' => $option,
                    'id'          => $optKey,
                ];
            }
        }

        return $options;
    }

    public function changeCover(Request $request) {
        if($this->is_api) {
            if(!$request->hasFile('file')) {
                return \Api::invalid_param();
            }
        }
        $action = new ActivityActionRepository();
        $data   = $action->uploadFile($this->user_id, $request->file('file'), 'album_photo');
        $sfObj  = new StorageFile();

        $sfObj->parent_file_id = !empty($data['parent_file_id']) ? $data['parent_file_id'] : NULL;
        $sfObj->type           = !empty($data['type']) ? $data['type'] : NULL;
        $sfObj->parent_id      = isset($data['parent_id']) ? $data['parent_id'] : NULL;
        $sfObj->parent_type    = $data['parent_type'];
        $sfObj->user_id        = $data['user_id'];
        $sfObj->storage_path   = $data['storage_path'];
        $sfObj->extension      = $data['extension'];
        $sfObj->name           = $data['name'];
        $sfObj->mime_type      = $data['mime_type'];
        $sfObj->size           = $data['size'];
        $sfObj->hash           = $data['hash'];
        $sfObj->save();
        $photo_id             = $sfObj->file_id;
        $user                 = User::find($this->data->user->id);
        $user->cover_photo_id = $photo_id;
        $user->save();
        if($this->is_api) {
            return \Api::success_data(['cover_photo_url' => \Kinnect2::getPhotoUrl($photo_id, $user->id, $type = NULL, 'thumb_normal')]);
        }
    }*/

}
