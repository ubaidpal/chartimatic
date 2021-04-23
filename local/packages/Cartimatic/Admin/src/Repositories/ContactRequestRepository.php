<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 19-Dec-16 1:00 PM
 * File Name    : ContactRequestRepository.php
 */

namespace Cartimatic\Admin\Repositories;

use App\ContactRequest;
use App\Repository\Eloquent\Repository;
use App\User;
use Carbon\Carbon;
use Vinkla\Hashids\Facades\Hashids;

class ContactRequestRepository extends Repository
{
    public function __construct() {
        parent::__construct();
        $this->status = \Config::get('admin_constants.CLAIM_STATUS');

    }

    public function getAllRequests() {
        return ContactRequest::orderBy('updated_at', 'DESC')->with('countryDetail')->get();
    }

    public function saveUser($data) {
        $user            = new User();
        $username        = \Kinnect2::slugify($data[ 'first_name' ] . '-' . $data[ 'last_name' ], ['table' => 'users', 'field' => 'username']);
        $activation_code = str_random(60) . $data[ 'email' ];

        $user->email             = $data[ 'email' ];
        $user->first_name        = $data[ 'first_name' ];
        $user->last_name         = $data[ 'last_name' ];
        $user->username          = $username;
        $user->activation_code   = $activation_code;
        $user->store_id          = 0;
        $user->password          = bcrypt(123456);
        $user->displayname       = $data[ 'first_name' ] . ' ' . $data[ 'last_name' ];
        $user->name       = $data[ 'first_name' ] . ' ' . $data[ 'last_name' ];
        $user->country           = $data[ 'country' ];
        $user->gender            = $data[ 'gender' ];
        $user->user_type         = \Config::get('constants.BRAND_USER');
        $user->postal_zip_code   = $data[ 'post_code' ];
        $user->phone             = $data[ 'phone' ];
        $user->city_state_county = $data[ 'city' ];

        $dt = Carbon::Now();
        $dt->addDays(29);

        $user->token_expiry_date = $dt;

        if($user->save()) {
            $this->sendEmail($user);
            $this->updateStatus(Hashids::connection('main')->decode($data[ 'contact_id' ])[ 0 ], 2);
        };

        return [
            'error'   => 0,
            'type'    => 'success',
            'message' => 'User created successfully'
        ];
    }

    private function sendEmail($user) {
        $data = array(
            'name' => $user->name,
            'code' => $user->activation_code,
        );

        \Mail::queue('emails.account-created', $data, function ($message) use ($user) {
            $message->subject(\Lang::get('auth.pleaseActivate'));
            $message->to($user->email);
            $message->from("Cartimatic@no-reply.com");
        });
    }

    public function updateStatus($id, $type) {
        $contact = ContactRequest::find($id);
        if(empty($contact)) {
            return [
                'error'   => 1,
                'type'    => 'error',
                'message' => 'Record not found'
            ];
        }
        $contact->status = $type;
        $contact->save();
        return [
            'error'   => 0,
            'type'    => 'success',
            'message' => 'Rejected Successfully'
        ];
    }

}
