<?php

namespace Cartimatic\Store\Http;

use App\Http\Controllers\Controller;
use Cartimatic\Store\Repository\NotificationRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class NotificationController extends Controller
{
    protected $user_id;
    protected $user;
    protected $is_api;
    private $notification;

    /**
     * NotificationController constructor.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(NotificationRepository $notification, Request $request) {
        parent::__construct();
        $this->notification = $notification;
        $this->user_id   = $request[ 'middleware' ][ 'user_id' ];
        $this->user      = $request[ 'middleware' ][ 'user' ];
        $this->is_api    = $request[ 'allData' ][ 'is_api' ];
    }

    public function index() {
        $data[ 'title' ] = 'All Notifications';
        $data = $this->notification->getNotifications($this->user_id, $this->user);
       if($this->is_api){
           return \Api::success(['results'=> $data['strings']]);
       }
       if(count($data) == 0){
           $data['notifications'] = [];
       }
        return view('Store::notifications', $data);
    }

    public function readNotification($url, $id) {
        if($this->notification->markRead($id, $this->user_id)){
            return redirect(base64_decode($url));
        }else{
            return redirect()->back();
        }
    }

    /**
     * @param $userId
     *
     * @return int
     */
    public function getNotificationCount($userId) {
        return $this->notification->getNotificationCount($userId);
    }
}
