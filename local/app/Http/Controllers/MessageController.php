<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Repository\Eloquent\ActivityActionRepository;
use App\Repository\Eloquent\FriendshipRepository;
use App\Repository\Eloquent\MessageRepository;
use App\Repository\Eloquent\PrivacyRepository;
use App\Repository\Eloquent\UsersRepository;
use App\Traits\GenerateThumb;
use App\Traits\UploadAttachment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Jenssegers\Agent\Agent;
use Vinkla\Hashids\Facades\Hashids;

class MessageController extends Controller
{
    //use GenerateThumb;
    use UploadAttachment;
    private $data;
    private $user_id;
    private $is_api;
    /**
     * @var MessageRepository
     */
    private $messageRepository;
    /**
     * @var UsersRepository
     */
    private $usersRepository;

    /**
     * MessageController constructor.
     *
     * @param Request $middleware
     * @param MessageRepository $messageRepository
     * @param UsersRepository $usersRepository
     */

    public function __construct(Request $middleware, MessageRepository $messageRepository, UsersRepository $usersRepository) {
        parent::__construct();
        $this->user_id = $middleware[ 'middleware' ][ 'user_id' ];
        @$this->data->user = $middleware[ 'middleware' ][ 'user' ];
        $this->is_api            = $middleware[ 'middleware' ][ 'is_api' ];
        $this->messageRepository = $messageRepository;
        $this->usersRepository   = $usersRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($conv_id = NULL) {
        if(\Input::has('timezone')) {
            $TZ = \Input::get('timezone');
            $this->saveTimeZone($TZ);
        }
        // $data = $this->messageRepository->get_conversations($this->user_id, $conv_id);

        $convData                = $this->messageRepository->get_conversations($this->user_id);
        $data[ 'conversations' ] = $this->conversations_data($convData);
        $data['unread'] =  $this->messageRepository->getUnreadConversations($this->user_id);
        $data['unread'] = $this->messageRepository->parseUnreadMessages($data['unread']);

        $data[ 'counter' ] = $this->messageRepository->message_counter($this->user_id);

        if($this->is_api) {
            $conversations = $this->conversations_data($convData);

            return \Api::success_list($conversations);
        }
        $data[ 'title' ] = $this->data->user->displayname . ' | Messages';
        if(!empty($this->theme_id)){
            return view()->file($this->getThemePath().'/messages/main.blade.php',$data);
        }else{
              $user = User::find($this->user_id);
            if($user->user_type == \Config::get('constants.REGULAR_USER')){
                return view('messages.main', $data);
            }else if($user->user_type == \Config::get('constants.BRAND_USER')){
                return view('Store::notifications', $data);
            }

        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if($request->has('conv_id')) {
            $response = $this->messageRepository->is_conv_open($request[ 'conv_id' ]);
            if(!$response) {
                if($this->is_api) {
                    return \Api::other_error('Conversation is closed. You cannot send messages');
                }

                return array('is_closed' => 1, 'msg' => 'Conversation is closed. You cannot send messages');
            }
        }

        $value          = $request->file('attachment');
        $file[ 'data' ] = [];
        if(!empty($value)) {
            $file = $this->upload_attachment($value, $this->user_id);

            if($file == 'invalid_file') {
                if($this->is_api()) {
                    return \Api::other_error('Invalid File Type');
                }
                return 'invalid_file';
            }
            $request[ 'file_id' ] = $file[ 'file_id' ];
        }
        $user_id = $this->user_id;
        /*if ($this->is_api) {
            $user_id = $request['sender_id'];
        }*/
        $value          = $request->file('attachment');
        $file[ 'data' ] = [];
        if(!empty($value)) {
            $file                 = $this->upload_attachment($value, $this->user_id);
            $request[ 'file_id' ] = $file[ 'file_id' ];
        }

        $data = $this->messageRepository->save_message($request, $user_id);
        return ['data' => $data, 'attachment' => $file[ 'data' ]];

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($conv_id) {
        $conv_id = Hashids::connection('message')->decode($conv_id)[ 0 ];

        $data   = $this->messageRepository->get_messages($this->user_id, $conv_id);
        $result = view('messages.conversation-messages', $data)->render();

        //$result['conv_type'] = $data['conv_type'];

        return $result;
        //return view('messages.conversation-messages', $data);
    }

    public function get_messages($conv_id) {
        $conv_id = Hashids::connection('message')->decode($conv_id)[ 0 ];
        //$user     = $this->usersRepository->get_user($userId)->id;
        //$data     = $this->messageRepository->get_messages($user, $conv_id);
        $data[ 'messages' ]     = $this->get_group_messages($conv_id, 1, 'ASC');
        $data[ 'conversation' ] = $this->messageRepository->get_conv_by_id($conv_id);
        if($data[ 'conversation' ]->type == 'group') {
            $data[ 'title' ] = $data[ 'conversation' ]->title;
        } else {
            $members = $this->messageRepository->getUsersInConvs($conv_id);
            foreach ($members as $row) {
                if($row->id != $this->user_id) {
                    $data[ 'title' ] = User::findOrNew($row->id)->displayname;
                }
            }
        }
        if(!empty($this->theme_id))
        {
            return view()->file($this->getThemePath().'/messages/conversation-messages.blade.php',$data);
        }else {
            $user = User::find($this->user_id);
            if($user->user_type == \Config::get('constants.REGULAR_USER')){
                return view('messages.conversation-messages', $data);
            }else if($user->user_type == \Config::get('constants.BRAND_USER')){

                return view('Store::seller-conversation-message', $data);
            }

        }

        //return view('messages.thread', $data);

    }

    public function update(Request $request) {
        $conv_id = $request[ 'conv_id' ];
        $name    = $request[ 'name' ];
        $this->messageRepository->update_name($conv_id, $name, $this->user_id);
    }

    public function create_group(Request $request) {
        if($this->is_api) {
            if(!$request->has('users')) {
                return \Api::invalid_param();
            }
        }
        $conv_id = $this->messageRepository->make_group($request, $this->user_id);
        if($this->is_api) {
            return \Api::success(['data' => $conv_id]);
        }

        return $conv_id;
    }

    public function add_member_to_group(Request $request) {
        if($this->is_api) {
            if(!$request->has('member') || !$request->has('conv_id')) {
                return \Api::invalid_param();
            }
        }
        $members      = $request[ 'member' ];
        $conversation = $request[ 'conv_id' ];

        $members = $this->messageRepository->add_member_to_group($members, $conversation);

        if($this->is_api) {
            $data[ 'participants' ] = $members;

            return \Api::success(['data' => $data]);
        }

        return $members;
    }

    public function get_new_message() {
        $data[ 'friends' ] = \Kinnect2::get_friends($this->user_id);

        return view('messages.new-thread', $data);
        //return view('messages.create-new-message', $data);
    }

    public function leave_group($conv_id = NULL, $user_id = NULL) {
        if($this->is_api) {
            if(!\Input::has('user_id') || !\Input::has('conv_id')) {
                return \Api::invalid_param();
            }
            $user_id = \Input::get('user_id');
            $conv_id = \Input::get('conv_id');
        }
        if(empty($user_id)) {
            $user_id = $this->user_id;
        }
        $this->messageRepository->leave_group($conv_id, $user_id);
        if($this->is_api) {
            return \Api::success_with_message('Successfully leaved the group');
        }

        return $conv_id;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function get_thread(Request $request) {
        $page = isset($request[ 'page' ]) ? $request[ 'page' ] : 1;

        if($this->is_api) {
            if(!$request->has('group_id') && !($request->has('user_1') && $request->has('user_2'))) {
                return \Api::invalid_param();
            }
        }

        if(isset($request[ 'group_id' ])) {
            $messages = $this->get_group_messages($request[ 'group_id' ], $page);
            if($this->is_api) {
                if(!empty($messages)) {
                    return \Api::success(['data' => $messages, 'count' => count($messages)]);
                } else {
                    return \Api::success_with_message('Detail not found');
                }
            }

            return \Response::json($messages);
        }

        $messages = $this->getMessagesByTwoUsers($page);
        if($this->is_api) {
            return \Api::success(['data' => $messages, 'count' => count($messages)]);
        }

        return \Response::json($messages);
    }

    public function get_user_detail() {
        if($this->is_api) {
            if(!\Input::has('users')) {
                return \Api::invalid_param();
            }
        }
        $users = \Input::get('users');

        $detail = $this->messageRepository->get_user_detail($users);

        if($this->is_api) {
            return \Api::success(['results' => $detail]);
        }

        return $detail;
    }

    public function get_friends_detail() {
        $user_id = $this->user_id;
        if(\Input::has('user_id')) {
            $user_id = \Input::get('user_id');
        }

        $detail = $this->messageRepository->get_friends($user_id);
        if($this->is_api) {
            return \Api::success(['results' => $detail]);
        }

        return $detail;
    }

    public function getUserByID() {
        $user_id              = \Input::get('user_id');
        $user                 = User::whereUsername($user_id)->orWhere('id', $user_id)->first();
        $row[ 'user_id' ]     = $user->user_id;
        $row[ 'displayname' ] = $user->displayname;
        $row[ 'profile_pic' ] = \Kinnect2::get_photo_path($user->photo_id);
        $row[ 'user_type' ]   = $user->user_type;//($user->user_type == \Config::get('constants.REGULAR_USER')?'kinnector':'brand');
        return $row;
    }

    public function get_conv_name() {
        if(!\Input::has('conv_id')) {
            return \Api::invalid_param();
        }
        $conv_id                   = \Input::get('conv_id');
        $conv_name[ 'group_name' ] = $this->messageRepository->get_conv_name($conv_id);
        if($this->is_api) {
            return \Api::success_data($conv_name);
        }

        return $conv_name;
    }

    public function saveTimeZone($TZ) {
        $this->messageRepository->saveTimeZone($TZ, $this->user_id);

        return redirect('messages');
    }

    private function conversations_data($data) {
        $all = [];
        foreach ($data[ 'conversation' ] as $item) {

            $row[ 'id' ]      = $item->getId();
            $row[ 'conv_id' ] = $row[ 'id' ];
            if(!isset($data[ 'conv_data' ][ $item->getId() ])){continue;}
            $row[ 'type' ]      = $data[ 'conv_data' ][ $item->getId() ]->type;
            $row[ 'conv_type' ] = $data[ 'conv_data' ][ $item->getId() ]->conv_for;
            $row[ 'title' ]     = $data[ 'conv_data' ][ $item->getId() ]->title;

            if($row[ 'conv_type' ] == 'messages') {
                $allParticipants = array_diff($item->getAllParticipants(), [$this->user_id]);
                $userId          = implode($allParticipants);
                $row[ 'title' ]  = $data[ 'users' ][ $userId ]->displayname;
            }
            $row[ 'last_message' ]        = $item->getLastMessage()->getContent() == '?-empty-?' ? '' : $item->getLastMessage()->getContent();
            $row[ 'last_message_sender' ] = $item->getLastMessage()->getSender();
            $row[ 'file_meta' ]           = $this->messageRepository->attachment_detail($item->getLastMessage()
                                                                                             ->getFile());
            //$row[ 'time' ]                = $data[ 'conv_data' ][ $item->getId() ]->created_at;
            $row[ 'time' ]        = $item->getLastMessage()->getCreated();
            $row[ 'participant' ] = $this->get_participants_detail($item->getAllParticipants(), $data);
            $all[]                = $row;
        }

        return $all;
    }

    /**
     * @param $allParticipants
     * @param $data
     *
     * @return array
     */
    private function get_participants_detail($allParticipants, $data) {
        $all             = [];
        $allParticipants = array_diff($allParticipants, [$this->user_id]);
        foreach ($allParticipants as $participant) {
            $row[ 'id' ]          = $data[ 'users' ][ $participant ]->id;
            $row[ 'name' ]        = $data[ 'users' ][ $participant ]->displayname;
            $row[ 'user_type' ]   = $data[ 'users' ][ $participant ]->user_type;
            $row[ 'profile_url' ] = $data[ 'users' ][ $participant ]->username;
            $row[ 'profile_pic' ] = \Kinnect2::getPhotoUrl($data[ 'users' ][ $participant ]->photo_id, $data[ 'users' ][ $participant ]->id, 'user', 'thumb_normal');

            $all[ $data[ 'users' ][ $participant ]->id ] = $row;
        }

        return $all;
    }

    private function get_group_messages($group_id, $page, $order = 'DESC') {
        \TBMsg::markReadAllMessagesInConversation($group_id, $this->user_id);

        return $this->messageRepository->getConvMessages($group_id, $page, $order);
    }

    private function getMessagesByTwoUsers($page) {
        $user_1  = \Input::get('user_1');
        $user_2  = \Input::get('user_2');
        $conv_id = $this->messageRepository->getConversationByTowUsers($user_1, $user_2);

        return $this->get_group_messages($conv_id, $page);

    }

    public function all_participants() {
        if(!\Input::has('conv_id')) {
            return \Api::invalid_param();
        }

        $conv_id = \Input::get('conv_id');
        $users   = $this->messageRepository->getUsersInConversation($conv_id);
        $users   = User::whereIn('id', $users)->get();
        return \Api::success_list($this->get_all_participants_detail($users));

    }

    private function get_all_participants_detail($users) {
        $all = [];
        //$allParticipants = array_diff($users, [$this->user_id]);
        foreach ($users as $participant) {
            $row[ 'id' ]          = $participant->id;
            $row[ 'name' ]        = $participant->displayname;
            $row[ 'user_type' ]   = $participant->user_type;
            $row[ 'profile_url' ] = $participant->username;
            $row[ 'profile_pic' ] = \Kinnect2::getPhotoUrl($participant->photo_id, $participant->id, 'user', 'thumb_normal');

            $all[] = $row;
        }
        return $all;
    }

    public function contactBidder($seller_id) {
        $seller_id = Hashids::connection('message')->decode($seller_id)[ 0 ];
        $conv_id   = $this->messageRepository->check_userin_conversation($this->user_id, $seller_id);

        // echo '<tt><pre>'; print_r($conv_id); die;
        if(!$conv_id) {
            $data    = $this->messageRepository->createConversation($users_ids = array($this->user_id, $seller_id), $this->user_id, 'couple');
            $conv_id = $data[ 'convId' ];
            $this->messageRepository->addMessageToConversation($conv_id, $this->user_id, $data = ['body' => '?-empty-?', 'file_id' => NULL]);
        }

        return $this->index($conv_id);

    }

}
