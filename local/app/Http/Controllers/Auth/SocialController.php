<?php

namespace App\Http\Controllers\Auth;

use App\Social;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function getSocialRedirect($provider) {
        $providerKey = \Config::get('services.' . $provider);
        if(empty($providerKey))
            return view('pages.status')
                ->with('error', 'No such provider');

        return Socialite::driver($provider)->redirect();

    }

    public function handle($provider) {
        $user = Socialite::driver($provider)->user();
        //$user = Socialite::with($provider)->user();

        $socialUser = NULL;

        $userCheck = User::where('email', '=', $user->email)->first();

        if(!empty($userCheck)) {
            $socialUser = $userCheck;
        } else {
            $sameSocialId = Social::whereSocialId($user->id)->whereProvider($provider)->first();

            if(empty($sameSocialId)) {
                //There is no combination of this social id and provider, so create new one
                $newSocialUser        = new User();
                $newSocialUser->email = $user->email;
                list($f_name, $l_name) = explode(' ', $user->name);
                $newSocialUser->first_name  = $f_name;
                $newSocialUser->last_name   = $l_name;
                $newSocialUser->displayname = $f_name . ' ' . $l_name;
                $newSocialUser->active      = 1;
                $newSocialUser->user_type   = 1;
                $newSocialUser->username    = \Kinnect2::slugify($f_name . '-' . $l_name, ['table' => 'users', 'field' => 'username']);

                $newSocialUser->save();

                $socialData            = new Social();
                $socialData->user_id   = $newSocialUser->id;
                $socialData->social_id = $user->id;
                $socialData->provider  = $provider;
                $socialData->save();

                // Add role
                $socialUser = User::findOrNew($newSocialUser->id);
                $socialUser->attachRole(3);
            } else {
                //Load this existing social user
                $socialUser = $sameSocialId->user;
            }
        }
        //echo '<tt><pre>'; print_r($socialUser); die;
        \Auth::login($socialUser, TRUE);
        return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
