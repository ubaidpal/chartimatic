<?php

namespace Cartimatic\Admin\Http\Controllers;

use App\User;
use Bican\Roles\Models\Permission;
use Carbon\Carbon;
use Cartimatic\Admin\Repositories\SettingsRepository;
use Illuminate\Http\Request;
use Bican\Roles\Models\Role;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    protected $user_id = NULL;
    protected $user;
    /**
     * @var \Cartimatic\Admin\Repositories\SettingsRepository
     */
    private $settingsRepository;

    public function __construct(SettingsRepository $settingsRepository) {
        if(isset(\Auth::user()->id)) {
            $this->user_id = \Auth::user()->id;
            $this->user    = \Auth::user();
        }

        $this->settingsRepository = $settingsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data['users'] = User::where('user_type', '!=', '1')->where('user_type', '!=', '2')->orderBy('id', 'DESC')
                             ->where('id', '<>', $this->user_id)->orderBy('id', 'DESC')->paginate(25);

        $data['permissions'] = Permission::lists('name', 'id');
        return view('Admin::settings.permissions', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home_categories() {
        $data['categories'] = $this->settingsRepository->getCategories();

        return view('Admin::settings.home-categories', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $users = $request->get('users');

        foreach ($users as $user) {
            $user = User::find($user);
            $user->attachPermission($request->get('permission'));
        }
        return redirect()->back();

    }


    public function save_categories() {
       $this->settingsRepository->saveCategories();
        return redirect()->back();
    }

    public function allRequests() {
        $data['title'] = 'All Requests';
        $data['requests'] = $this->settingsRepository->getPendingRequests();
        $data['type']       = 'pending';
        return view('Admin::settings.requests', $data);
    }
    public function viewDescription($id) {
        $data['request'] = $this->settingsRepository->getDescription($id);
        return view('Admin::settings.description', $data);
    }
    public function statusChange(Request $request) {
       $this->settingsRepository->getStatusUpdate($request->id);
        return 1;
    }
    public function allResolved() {
        $data['title'] = 'All Requests';
        $data['requests'] = $this->settingsRepository->getResolvedRequests();
        $data['type']       = 'resolved';
        return view('Admin::settings.resolvedRequests', $data);
    }
   

}
