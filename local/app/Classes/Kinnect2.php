<?php
/**
 * Created by PhpStorm.
 * User: n0impossible
 * Date: 6/13/15
 * Time: 11:35 AM
 */

namespace App\Classes;

use App\AdCampaign;
use App\AdStatistics;
use App\StoreOption;
use App\AdUserAd;
use App\Attachment;
use App\Battle;
use App\Consumer;
use App\Repository\Eloquent\ActivityActionRepository;
use App\Repository\Eloquent\SkoreRepository;
use App\User;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Config;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class Kinnect2
{

    protected $data;
    protected $is_api;
    private   $user_id;

    public function __construct() {
        $this->is_api = UrlFilter::filter();
        if($this->is_api) {
            $this->user_id = Authorizer::getResourceOwnerId();
            @$this->data->user = User::findOrNew($this->user_id);
        } else {
            if(Auth::check()) {
                @$this->data->user = Auth::user();
                $this->user_id = $this->data->user->id;
            }
        }
    }

    public function getCampaign($campaign_id) {
        return AdCampaign::find($campaign_id);
    }

    public function getAd($ad_id) {
        return AdUserAd::find($ad_id);
    }

    public function getCountryName($id) {
        return $userFollowingBrandIds = DB::table('countries')
                                          ->where('id', $id)
                                          ->pluck('name');
    }

    public function getCampaignStatistics($created_at, $campaign_id) {
        $date                       = explode(' ', $created_at);
        $stats                      = AdStatistics::where('ad_campaign_id', $campaign_id)
                                                  ->join('users', 'users.id', '=', 'ad_statistics.viewer_id')
                                                  ->groupBy('date')
                                                  ->orderBy('date', 'DESC')
                                                  ->whereBetween('ad_statistics.created_at', array(
                                                      $date[0] . ' 00:00:00',
                                                      $date[0] . ' 23:59:59',
                                                  ))
                                                  ->get(array(
                                                      DB::raw('ad_statistics.created_at as date, ad_statistics.value_click, ad_statistics.value_view, users.country as country'),
                                                  ));
        $data['camp_total_clicks']  = '0';
        $data['camp_total_views']   = '0';
        $data['view_country_list']  = '';
        $data['click_country_list'] = '';

        foreach ($stats as $stat):
            if($stat->value_click == 1):
                $data['camp_total_clicks']++;
                $data['click_country_list'] .= $stat->country . ', ';
            endif;

            if($stat->value_view == 1):
                $data['camp_total_views']++;
                $data['view_country_list'] .= $stat->country . ', ';
            endif;
        endforeach;

        return $data;
    }

    public function incrementAdClick($ad) {
        $adStat = new AdStatistics;

        $adStat->user_ad_id     = $ad->id;
        $adStat->ad_campaign_id = $ad->campaign_id;
        $adStat->viewer_id      = $this->user_id;
        $adStat->host_name      = $_SERVER['HTTP_HOST'];
        $adStat->user_agent     = $_SERVER['HTTP_USER_AGENT'];
        $adStat->url            = $ad->cads_url;
        $adStat->value_click    = 1;
        $adStat->value_view     = '';
        $adStat->value_like     = '';

        $adStat->save();

        $end_date = explode(' ', $ad->cads_end_date);

        if($end_date[0] < Carbon::now()->toDateString()) {
            $ad->enable = '0';
            $ad->status = '0';
        }

        if($ad->price_model == 'Pay/click') {
            if($ad->limit_click == 1) {
                $ad->approved       = '0';
                $ad->enable         = '0';
                $ad->status         = '0';
                $ad->payment_status = '0';
            }

            $ad->limit_click = $ad->limit_click - 1;
        }
        $ad->save();
    }

    public function getAdsWidget() {
        if($this->data->user->userable_type == 'App\Consumer') {
            $userConsumer = Consumer::find($this->data->user->userable_id);

            $birthdate = explode('-', $userConsumer->birthdate);
            $birthdate = Carbon::createFromDate($birthdate[0], $birthdate[1], $birthdate[2]);

            $adsIdsReportedByThisUser = DB::table('ad_cancels')
                                          ->where('user_id', $this->data->user->id)
                                          ->lists('ad_id');

            $adsIdsCountryByThisUser = DB::table('ad_targets_countries')
                                         ->where('ad_targets_countries.country_id', "=", $this->data->user->country)
                                         ->orWhere('ad_targets_countries.country_id', "=", 0)
                                         ->lists('user_ad_id');

            $adsIdsTargettingByThisUser = DB::table('ad_targets')
                                            ->where('ad_targets.age_max', ">=", $birthdate->diff(Carbon::now())->format('%y'))
                                            ->where('ad_targets.age_min', "<=", $birthdate->diff(Carbon::now())->format('%y'))
                                            ->where('ad_targets.gender', "<=", $userConsumer->gender)
                                            ->where('ad_targets.profile', "<=", Config::get('constants.REGULAR_USER'))
                                            ->lists('user_ad_id');

            return $ads = DB::table('ad_user_ads')
                            ->where('ad_user_ads.enable', 1)
                            ->whereNotIn('ad_user_ads.id', $adsIdsReportedByThisUser)
                            ->whereIn('ad_user_ads.id', $adsIdsCountryByThisUser)
                            ->whereIn('ad_user_ads.id', $adsIdsTargettingByThisUser)
                            ->where('ad_user_ads.payment_status', 1)
                            ->where('ad_user_ads.status', 1)
                            ->orderByRaw("RAND()")
                            ->take(2)
                            ->get();
        }

        return $ads = AdUserAd::where('enable', 1)
                              ->where('payment_status', 1)
                              ->where('status', 1)
                              ->orderByRaw("RAND()")
                              ->take(2)->get();
    }

    public function countCampaignAds($id) {
        return AdUserAd::where(['campaign_id' => $id])->count();
    }

    public function countCampaignAdsTotalViews($id) {
        return AdStatistics::where(['ad_campaign_id' => $id])
                           ->where(['value_view' => 1])->count();
    }

    public function countCampaignAdsTotalClicks($id) {
        return AdStatistics::where(['ad_campaign_id' => $id])
                           ->where(['value_click' => 1])->count();
    }

    public function countAdTotalViews($id) {
        return AdStatistics::where(['user_ad_id' => $id])
                           ->where(['value_view' => 1])->count();
    }

    public function countAdTotalClicks($id) {
        return AdStatistics::where(['user_ad_id' => $id])
                           ->where(['value_click' => 1])->count();
    }

    public function update_skore($type, $user_id) {
        $skoreRepository = new SkoreRepository();
        $skoreRepository->update_skore($type, $user_id);
    }

    public function isAdPaused($ad_id) {
        $ad = AdUserAd::find($ad_id);

        return $ad->status;
    }

    function slugify($str, $options = array()) {
        // Make sure string is in UTF-8 and strip invalid UTF-8 characters
        $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());

        $defaults = array(
            'delimiter'     => '-',
            'limit'         => NULL,
            'lowercase'     => TRUE,
            'replacements'  => array(),
            'transliterate' => FALSE,
        );

        // Merge options
        $options = array_merge($defaults, $options);

        $char_map = array(
            // Latin
            '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'AE', '�' => 'C',
            '�' => 'E', '�' => 'E', '�' => 'E', '�' => 'E', '�' => 'I', '�' => 'I', '�' => 'I', '�' => 'I',
            '�' => 'D', '�' => 'N', '�' => 'O', '�' => 'O', '�' => 'O', '�' => 'O', '�' => 'O', '?' => 'O',
            '�' => 'O', '�' => 'U', '�' => 'U', '�' => 'U', '�' => 'U', '?' => 'U', '�' => 'Y', '�' => 'TH',
            '�' => 'ss',
            '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'ae', '�' => 'c',
            '�' => 'e', '�' => 'e', '�' => 'e', '�' => 'e', '�' => 'i', '�' => 'i', '�' => 'i', '�' => 'i',
            '�' => 'd', '�' => 'n', '�' => 'o', '�' => 'o', '�' => 'o', '�' => 'o', '�' => 'o', '?' => 'o',
            '�' => 'o', '�' => 'u', '�' => 'u', '�' => 'u', '�' => 'u', '?' => 'u', '�' => 'y', '�' => 'th',
            '�' => 'y',
            // Latin symbols
            '�' => '(c)',
            // Greek
            '?' => 'A', '?' => 'B', '?' => 'G', '?' => 'D', '?' => 'E', '?' => 'Z', '?' => 'H', '?' => '8',
            '?' => 'I', '?' => 'K', '?' => 'L', '?' => 'M', '?' => 'N', '?' => '3', '?' => 'O', '?' => 'P',
            '?' => 'R', '?' => 'S', '?' => 'T', '?' => 'Y', '?' => 'F', '?' => 'X', '?' => 'PS', '?' => 'W',
            '?' => 'A', '?' => 'E', '?' => 'I', '?' => 'O', '?' => 'Y', '?' => 'H', '?' => 'W', '?' => 'I',
            '?' => 'Y',
            '?' => 'a', '?' => 'b', '?' => 'g', '?' => 'd', '?' => 'e', '?' => 'z', '?' => 'h', '?' => '8',
            '?' => 'i', '?' => 'k', '?' => 'l', '?' => 'm', '?' => 'n', '?' => '3', '?' => 'o', '?' => 'p',
            '?' => 'r', '?' => 's', '?' => 't', '?' => 'y', '?' => 'f', '?' => 'x', '?' => 'ps', '?' => 'w',
            '?' => 'a', '?' => 'e', '?' => 'i', '?' => 'o', '?' => 'y', '?' => 'h', '?' => 'w', '?' => 's',
            '?' => 'i', '?' => 'y', '?' => 'y', '?' => 'i',
            // Turkish
            '?' => 'S', '?' => 'I', '�' => 'C', '�' => 'U', '�' => 'O', '?' => 'G',
            '?' => 's', '?' => 'i', '�' => 'c', '�' => 'u', '�' => 'o', '?' => 'g',
            // Russian
            '?' => 'A', '?' => 'B', '?' => 'V', '?' => 'G', '?' => 'D', '?' => 'E', '?' => 'Yo', '?' => 'Zh',
            '?' => 'Z', '?' => 'I', '?' => 'J', '?' => 'K', '?' => 'L', '?' => 'M', '?' => 'N', '?' => 'O',
            '?' => 'P', '?' => 'R', '?' => 'S', '?' => 'T', '?' => 'U', '?' => 'F', '?' => 'H', '?' => 'C',
            '?' => 'Ch', '?' => 'Sh', '?' => 'Sh', '?' => '', '?' => 'Y', '?' => '', '?' => 'E', '?' => 'Yu',
            '?' => 'Ya',
            '?' => 'a', '?' => 'b', '?' => 'v', '?' => 'g', '?' => 'd', '?' => 'e', '?' => 'yo', '?' => 'zh',
            '?' => 'z', '?' => 'i', '?' => 'j', '?' => 'k', '?' => 'l', '?' => 'm', '?' => 'n', '?' => 'o',
            '?' => 'p', '?' => 'r', '?' => 's', '?' => 't', '?' => 'u', '?' => 'f', '?' => 'h', '?' => 'c',
            '?' => 'ch', '?' => 'sh', '?' => 'sh', '?' => '', '?' => 'y', '?' => '', '?' => 'e', '?' => 'yu',
            '?' => 'ya',
            // Ukrainian
            '?' => 'Ye', '?' => 'I', '?' => 'Yi', '?' => 'G',
            '?' => 'ye', '?' => 'i', '?' => 'yi', '?' => 'g',
            // Czech
            '?' => 'C', '?' => 'D', '?' => 'E', '?' => 'N', '?' => 'R', '�' => 'S', '?' => 'T', '?' => 'U',
            '�' => 'Z',
            '?' => 'c', '?' => 'd', '?' => 'e', '?' => 'n', '?' => 'r', '�' => 's', '?' => 't', '?' => 'u',
            '�' => 'z',
            // Polish
            '?' => 'A', '?' => 'C', '?' => 'e', '?' => 'L', '?' => 'N', '�' => 'o', '?' => 'S', '?' => 'Z',
            '?' => 'Z',
            '?' => 'a', '?' => 'c', '?' => 'e', '?' => 'l', '?' => 'n', '�' => 'o', '?' => 's', '?' => 'z',
            '?' => 'z',
            // Latvian
            '?' => 'A', '?' => 'C', '?' => 'E', '?' => 'G', '?' => 'i', '?' => 'k', '?' => 'L', '?' => 'N',
            '�' => 'S', '?' => 'u', '�' => 'Z',
            '?' => 'a', '?' => 'c', '?' => 'e', '?' => 'g', '?' => 'i', '?' => 'k', '?' => 'l', '?' => 'n',
            '�' => 's', '?' => 'u', '�' => 'z',
        );

        // Make custom replacements
        $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

        // Transliterate characters to ASCII
        if($options['transliterate']) {
            $str = str_replace(array_keys($char_map), $char_map, $str);
        }

        // Replace non-alphanumeric characters with our delimiter
        $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

        // Remove duplicate delimiters
        $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

        // Truncate slug to max. characters
        $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');

        // Remove delimiter from ends
        $str = trim($str, $options['delimiter']);

        $slug = $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;

        $result = DB::table($options['table'])
                    ->where($options['field'], 'like', $slug . '%')
                    ->get();

        // echo '<tt><pre>'; print_r($result); die;
        //dd(DB::getQueryLog());
        if(count($result)) {

            $slugs = array();
            $i     = 0;
            foreach ($result as $row) {
                $slugs[$i] = $options['lowercase'] ? mb_strtolower($row->{$options['field']}, 'UTF-8') : $row->{$options['field']};
                $i++;
            }

            if(in_array($slug, $slugs)) {

                $max = 0;

                //keep incrementing $max until a space is found
                while (in_array(($slug . '-' . ++$max), $slugs))
                    ;

                //update $slug with the appendage
                $slug .= '-' . $max;
            }

            return $slug;
        } else {
            return $slug;
        }
    }

    public function getPhotoUrl($photo_id = NULL, $user_id = NULL, $type = NULL, $thumb_type = NULL) {

    }

    public function isPhotoAvaiable($photo_id = NULL, $user_id = NULL, $type = NULL, $thumb_type = NULL) {

    }

    public function profileAddress($ownerInfo) {

        if(isset($ownerInfo->user_type)) {
            if($ownerInfo->user_type == \Config::get('constants.BRAND_USER')) {
                return $profileUrl = url('brand' . '/' . urlencode($ownerInfo->username));
            } else {
                return $profileUrl = url('profile' . '/' . urlencode($ownerInfo->username));
            }
        }

        return $profileUrl = url('/');

    }

    public function get_friends($user_id) {
        return \DB::table('user_membership')
                  ->join('users', 'users.id', '=', 'user_membership.user_id')
                  ->where('resource_id', $user_id)
            // ->where('users.user_type', '=', \Config::get('constants.REGULAR_USER'))
                  ->where('user_membership.active', 1)
                  ->select('user_membership.*', 'users.name', 'users.username', 'users.displayname', 'users.user_type', 'users.photo_id')
                  ->get();

    }

    public function get_attachment_thumb($id, $type = NULL) {
        $path = \Config::get('constants.ATTACHMENT_THUMB').'/app/';
        if(!is_null($type)) {
            $file = Attachment::whereFileId($id)->whereType($type)->first();

        } else {
            $file = Attachment::whereFileId($id)->first();
        }

        if($file) {
            //return $path . $file->storage_path . '?type=' . urlencode($file->photo_mime);
            return url('photo/' . $file->storage_path);
        } else {
            return asset('/local/public/assets/images/defaults/default_event_icon.svg');
        }
    }
    public function formatStoreName($store_name) {
        $store_name = trim($store_name);
        return preg_replace('#[ -]+#', '-', $store_name);
    }
    public function getStoreNameValidationRule(){
        return 'required:user_type,2|max:60|min:4|regex:/(^[A-Za-z0-9-]+$)+/|unique:store_options,value';
    }
    public function saveDefaultTheme($store_id)
    {
        $soObj = new StoreOption();
        $soObj->key = \Config::get('constants_theme.STORE_SELECTED_THEME');
        $soObj->value = \Config::get('constants_theme.DEFAULT_THEME_ID');;
        $soObj->store_id = $store_id;

        $soObj->save();
    }
    public function saveStoreOption($store_id,$key,$value)
    {
        $storeOptObj = new StoreOption();
        $storeOptObj->key = $key;
        $storeOptObj->value = $value;
        $storeOptObj->store_id = $store_id;

        $storeOptObj->save();
    }
}