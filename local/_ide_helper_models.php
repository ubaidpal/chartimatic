<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\ActivityNotification
 *
 * @property-read \App\User $user
 */
	class ActivityNotification extends \Eloquent {}
}

namespace App{
/**
 * App\Ad
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $level_id
 * @property float $price
 * @property boolean $sponsored
 * @property boolean $featured
 * @property string $url_option
 * @property boolean $enable
 * @property boolean $network
 * @property boolean $public
 * @property string $price_model
 * @property integer $model_detail
 * @property boolean $renew
 * @property integer $renew_before
 * @property boolean $auto_approve
 * @property integer $order
 * @property string $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Ad whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ad whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ad whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ad whereLevelId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ad wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ad whereSponsored($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ad whereFeatured($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ad whereUrlOption($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ad whereEnable($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ad whereNetwork($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ad wherePublic($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ad wherePriceModel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ad whereModelDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ad whereRenew($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ad whereRenewBefore($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ad whereAutoApprove($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ad whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ad whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ad whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ad whereUpdatedAt($value)
 */
	class Ad extends \Eloquent {}
}

namespace App{
/**
 * App\AdCampaign
 *
 * @property integer $id
 * @property string $name
 * @property boolean $status
 * @property integer $owner_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\AdCampaign whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdCampaign whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdCampaign whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdCampaign whereOwnerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdCampaign whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdCampaign whereUpdatedAt($value)
 */
	class AdCampaign extends \Eloquent {}
}

namespace App{
/**
 * App\AdCancels
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $report_type
 * @property string $report_description
 * @property integer $ad_id
 * @property integer $is_cancel
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\AdCancels whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdCancels whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdCancels whereReportType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdCancels whereReportDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdCancels whereAdId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdCancels whereIsCancel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdCancels whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdCancels whereUpdatedAt($value)
 */
	class AdCancels extends \Eloquent {}
}

namespace App{
/**
 * App\AdStatistics
 *
 * @property integer $id
 * @property integer $user_ad_id
 * @property integer $ad_campaign_id
 * @property integer $viewer_id
 * @property string $host_name
 * @property string $user_agent
 * @property string $url
 * @property integer $value_click
 * @property integer $value_view
 * @property string $value_like
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\AdStatistics whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdStatistics whereUserAdId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdStatistics whereAdCampaignId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdStatistics whereViewerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdStatistics whereHostName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdStatistics whereUserAgent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdStatistics whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdStatistics whereValueClick($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdStatistics whereValueView($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdStatistics whereValueLike($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdStatistics whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdStatistics whereUpdatedAt($value)
 */
	class AdStatistics extends \Eloquent {}
}

namespace App{
/**
 * App\AdTargets
 *
 * @property integer $id
 * @property integer $user_ad_id
 * @property boolean $birthday_enable
 * @property integer $age_min
 * @property integer $age_max
 * @property boolean $gender
 * @property boolean $profile
 * @property string $country
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\AdTargets whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTargets whereUserAdId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTargets whereBirthdayEnable($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTargets whereAgeMin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTargets whereAgeMax($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTargets whereGender($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTargets whereProfile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTargets whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTargets whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTargets whereUpdatedAt($value)
 */
	class AdTargets extends \Eloquent {}
}

namespace App{
/**
 * App\AdTargetsCountry
 *
 * @property integer $id
 * @property integer $user_ad_id
 * @property integer $country_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\AdTargetsCountry whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTargetsCountry whereUserAdId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTargetsCountry whereCountryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTargetsCountry whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTargetsCountry whereUpdatedAt($value)
 */
	class AdTargetsCountry extends \Eloquent {}
}

namespace App{
/**
 * App\AdTransaction
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $ad_id
 * @property integer $gateway_id
 * @property string $timestamp
 * @property string $type
 * @property string $state
 * @property string $gateway_transaction_id
 * @property string $gateway_parent_transaction_id
 * @property string $gateway_order_id
 * @property float $amount
 * @property string $currency
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\AdTransaction whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTransaction whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTransaction whereAdId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTransaction whereGatewayId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTransaction whereTimestamp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTransaction whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTransaction whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTransaction whereGatewayTransactionId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTransaction whereGatewayParentTransactionId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTransaction whereGatewayOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTransaction whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTransaction whereCurrency($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdTransaction whereUpdatedAt($value)
 */
	class AdTransaction extends \Eloquent {}
}

namespace App{
/**
 * App\AdUserAd
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $ad_type
 * @property integer $package_id
 * @property integer $campaign_id
 * @property string $cads_url
 * @property string $cads_title
 * @property string $cads_body
 * @property integer $owner_id
 * @property integer $photo_id
 * @property string $gateway_order_id
 * @property string $cads_start_date
 * @property string $cads_end_date
 * @property boolean $sponsored
 * @property boolean $featured
 * @property boolean $like
 * @property string $resourece_type
 * @property integer $resourece_id
 * @property boolean $public
 * @property boolean $approved
 * @property boolean $enable
 * @property boolean $status
 * @property string $payment_status
 * @property boolean $declined
 * @property string $approve_date
 * @property string $price_model
 * @property integer $limit_click
 * @property integer $limit_view
 * @property integer $limit_like
 * @property integer $count_view
 * @property integer $count_like
 * @property string $expiry_date
 * @property integer $weight
 * @property float $min_ctr
 * @property integer $gateway_id
 * @property string $gateway_profile_id
 * @property string $renew_by_admin_date
 * @property integer $profile
 * @property integer $story_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereAdType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd wherePackageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereCampaignId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereCadsUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereCadsTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereCadsBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereOwnerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd wherePhotoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereGatewayOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereCadsStartDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereCadsEndDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereSponsored($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereFeatured($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereLike($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereResoureceType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereResoureceId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd wherePublic($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereApproved($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereEnable($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd wherePaymentStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereDeclined($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereApproveDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd wherePriceModel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereLimitClick($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereLimitView($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereLimitLike($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereCountView($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereCountLike($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereExpiryDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereWeight($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereMinCtr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereGatewayId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereGatewayProfileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereRenewByAdminDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereProfile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereStoryType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AdUserAd whereUpdatedAt($value)
 */
	class AdUserAd extends \Eloquent {}
}

namespace App{
/**
 * App\Attachment
 *
 * @property integer $file_id
 * @property integer $parent_file_id
 * @property string $type
 * @property string $parent_type
 * @property integer $parent_id
 * @property integer $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $storage_path
 * @property string $extension
 * @property string $name
 * @property string $mime_type
 * @property string $mime_major
 * @property integer $size
 * @property string $hash
 * @property boolean $is_temp
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereFileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereParentFileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereParentType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereStoragePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereExtension($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereMimeType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereMimeMajor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereSize($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereHash($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attachment whereIsTemp($value)
 */
	class Attachment extends \Eloquent {}
}

namespace App{
/**
 * App\AuthorizationAllow
 *
 * @property integer $id
 * @property string $resource_type
 * @property integer $resource_id
 * @property string $action
 * @property integer $permission
 * @property string $params
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\AuthorizationAllow whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AuthorizationAllow whereResourceType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AuthorizationAllow whereResourceId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AuthorizationAllow whereAction($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AuthorizationAllow wherePermission($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AuthorizationAllow whereParams($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AuthorizationAllow whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AuthorizationAllow whereUpdatedAt($value)
 */
	class AuthorizationAllow extends \Eloquent {}
}

namespace App{
/**
 * App\Brand
 *
 * @property integer $id
 * @property string $brand_history
 * @property string $brand_name
 * @property string $description
 * @property string $store_created
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @property-read \App\User $brand_detail
 * @method static \Illuminate\Database\Query\Builder|\App\Brand whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Brand whereBrandHistory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Brand whereBrandName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Brand whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Brand whereStoreCreated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Brand whereUpdatedAt($value)
 */
	class Brand extends \Eloquent {}
}

namespace App{
/**
 * App\BrandMembership
 *
 * @property integer $id
 * @property integer $brand_id This is a id of users table. For user who's type is Brand.
 * @property integer $user_id
 * @property boolean $brand_approved
 * @property boolean $user_approved
 * @property boolean $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\BrandMembership whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandMembership whereBrandId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandMembership whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandMembership whereBrandApproved($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandMembership whereUserApproved($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandMembership whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandMembership whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandMembership whereUpdatedAt($value)
 */
	class BrandMembership extends \Eloquent {}
}

namespace App{
/**
 * App\Consumer
 *
 * @property integer $id
 * @property string $gender
 * @property string $birthdate
 * @property string $about_me
 * @property string $personnel_info
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @property-read \App\User $user_detail
 * @method static \Illuminate\Database\Query\Builder|\App\Consumer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Consumer whereGender($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Consumer whereBirthdate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Consumer whereAboutMe($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Consumer wherePersonnelInfo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Consumer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Consumer whereUpdatedAt($value)
 */
	class Consumer extends \Eloquent {}
}

namespace App{
/**
 * App\Conversation
 *
 * @property integer $id
 * @property string $deleted_at
 * @property string $type
 * @property string $title
 * @property integer $file_id
 * @property integer $updated_by
 * @property \Carbon\Carbon $created_at
 * @property integer $created_by
 * @property string $conv_for
 * @property boolean $status 1:Open, 0:Closed
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereFileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereConvFor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Conversation whereUpdatedAt($value)
 */
	class Conversation extends \Eloquent {}
}

namespace App{
/**
 * App\ConversationUser
 *
 * @property integer $conv_id
 * @property integer $user_id
 * @method static \Illuminate\Database\Query\Builder|\App\ConversationUser whereConvId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ConversationUser whereUserId($value)
 */
	class ConversationUser extends \Eloquent {}
}

namespace App{
/**
 * App\Country
 *
 * @property integer $id
 * @property string $iso
 * @property string $name
 * @property string $region
 * @property string $nicename
 * @property string $iso3
 * @property integer $numcode
 * @property integer $phonecode
 * @method static \Illuminate\Database\Query\Builder|\App\Country whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Country whereIso($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Country whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Country whereRegion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Country whereNicename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Country whereIso3($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Country whereNumcode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Country wherePhonecode($value)
 */
	class Country extends \Eloquent {}
}

namespace App{
/**
 * App\Hashtag
 *
 */
	class Hashtag extends \Eloquent {}
}

namespace App{
/**
 * App\Link
 *
 * @property integer $link_id
 * @property string $uri
 * @property string $title
 * @property string $description
 * @property integer $photo_id
 * @property string $parent_type
 * @property integer $parent_id
 * @property string $owner_type
 * @property integer $owner_id
 * @property integer $view_count
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property boolean $search
 * @method static \Illuminate\Database\Query\Builder|\App\Link whereLinkId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Link whereUri($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Link whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Link whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Link wherePhotoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Link whereParentType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Link whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Link whereOwnerType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Link whereOwnerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Link whereViewCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Link whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Link whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Link whereSearch($value)
 */
	class Link extends \Eloquent {}
}

namespace App{
/**
 * App\Message
 *
 * @property integer $id
 * @property integer $sender_id
 * @property integer $conv_id
 * @property string $content
 * @property integer $file_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereSenderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereConvId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereFileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Message whereUpdatedAt($value)
 */
	class Message extends \Eloquent {}
}

namespace App{
/**
 * App\MessageStatus
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $msg_id
 * @property boolean $self
 * @property integer $status
 * @method static \Illuminate\Database\Query\Builder|\App\MessageStatus whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MessageStatus whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MessageStatus whereMsgId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MessageStatus whereSelf($value)
 * @method static \Illuminate\Database\Query\Builder|\App\MessageStatus whereStatus($value)
 */
	class MessageStatus extends \Eloquent {}
}

namespace App{
/**
 * App\Report
 *
 */
	class Report extends \Eloquent {}
}

namespace App{
/**
 * App\SnsEndpoint
 *
 * @property-read \App\User $User
 * @property-read mixed $check_closed
 */
	class SnsEndpoint extends \Eloquent {}
}

namespace App{
/**
 * App\Social
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $social_id
 * @property string $provider
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Social whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Social whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Social whereSocialId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Social whereProvider($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Social whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Social whereUpdatedAt($value)
 */
	class Social extends \Eloquent {}
}

namespace App{
/**
 * App\StoreClaimRequest
 *
 * @property integer $id
 * @property integer $seller_id
 * @property string $owner_type
 * @property integer $owner_id
 * @property string $status
 * @property float $amount
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $seller
 * @property-read \Cartimatic\Store\StoreClaim $store_claim
 * @method static \Illuminate\Database\Query\Builder|\App\StoreClaimRequest whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StoreClaimRequest whereSellerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StoreClaimRequest whereOwnerType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StoreClaimRequest whereOwnerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StoreClaimRequest whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StoreClaimRequest whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StoreClaimRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StoreClaimRequest whereUpdatedAt($value)
 */
	class StoreClaimRequest extends \Eloquent {}
}

namespace App{
/**
 * App\StoreOption
 *
 * @property integer $id
 * @property integer $store_id
 * @property string $key
 * @property string $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\StoreOption whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StoreOption whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StoreOption whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StoreOption whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StoreOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StoreOption whereUpdatedAt($value)
 */
	class StoreOption extends \Eloquent {}
}

namespace App{
/**
 * App\Timezone
 *
 * @property integer $time_zone_id
 * @property string $country
 * @property string $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Timezone whereTimeZoneId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Timezone whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Timezone whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Timezone whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Timezone whereUpdatedAt($value)
 */
	class Timezone extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property string $activation_code
 * @property boolean $active
 * @property boolean $resent
 * @property string $username
 * @property string $displayname
 * @property integer $userable_id
 * @property string $userable_type
 * @property string $country
 * @property string $contact_info
 * @property string $website
 * @property string $facebook
 * @property string $twitter
 * @property integer $photo_id
 * @property string $profile_photo_url
 * @property string $cover_photo_url
 * @property integer $cover_photo_id
 * @property string $mood
 * @property string $mode_date
 * @property string $salt
 * @property string $locale
 * @property string $language
 * @property string $timezone
 * @property boolean $search
 * @property boolean $show_profileviewers
 * @property string $user_type
 * @property integer $invites_used
 * @property integer $extra_used
 * @property boolean $enabled
 * @property boolean $verified
 * @property boolean $approved
 * @property string $creation_ip
 * @property string $lastlogin_date
 * @property string $lastlogin_ip
 * @property integer $skore
 * @property integer $member_count
 * @property integer $view_count
 * @property string $remember_token
 * @property string $deleted
 * @property string $gender
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $token_expiry_date
 * @property integer $login_counter
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $userable
 * @property-read \App\Consumer $consumer
 * @property-read \App\Brand $brand
 * @property-read \App\Consumer $consumer_detail
 * @property-read \App\Brand $brand_detail
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActivityNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Bican\Roles\Models\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\Bican\Roles\Models\Permission[] $userPermissions
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereActivationCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereResent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDisplayname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUserableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUserableType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereContactInfo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereWebsite($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereFacebook($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereTwitter($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePhotoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereProfilePhotoUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCoverPhotoUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCoverPhotoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereMood($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereModeDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereSalt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLocale($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereTimezone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereSearch($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereShowProfileviewers($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUserType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereInvitesUsed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereExtraUsed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEnabled($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereVerified($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereApproved($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreationIp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastloginDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastloginIp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereSkore($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereMemberCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereViewCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDeleted($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereGender($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereTokenExpiryDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLoginCounter($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\UserBrand
 *
 * @property integer $id
 * @property string $brand_history
 * @property string $brand_name
 * @property string $description
 * @property string $store_created
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\UserBrand whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserBrand whereBrandHistory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserBrand whereBrandName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserBrand whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserBrand whereStoreCreated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserBrand whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserBrand whereUpdatedAt($value)
 */
	class UserBrand extends \Eloquent {}
}

namespace App{
/**
 * App\UserMembership
 *
 * @property integer $id
 * @property integer $resource_id
 * @property integer $user_id
 * @property boolean $active
 * @property boolean $resource_approved
 * @property boolean $user_approved
 * @property string $message
 * @property string $description
 * @property integer $is_viewed
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\UserMembership whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserMembership whereResourceId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserMembership whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserMembership whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserMembership whereResourceApproved($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserMembership whereUserApproved($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserMembership whereMessage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserMembership whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserMembership whereIsViewed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserMembership whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserMembership whereUpdatedAt($value)
 */
	class UserMembership extends \Eloquent {}
}

namespace App{
/**
 * App\Usersetting
 *
 * @property integer $setting_id
 * @property string $category
 * @property string $setting
 * @property boolean $setting_value
 * @property integer $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Usersetting whereSettingId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Usersetting whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Usersetting whereSetting($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Usersetting whereSettingValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Usersetting whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Usersetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Usersetting whereUpdatedAt($value)
 */
	class Usersetting extends \Eloquent {}
}

namespace App{
/**
 * App\users_membership
 *
 */
	class users_membership extends \Eloquent {}
}

namespace Cartimatic\POS\Http\Models{
/**
 * Cartimatic\POS\Http\Models\POS
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $manager_id
 * @property string $pos_name
 * @property string $email Manager Email
 * @property string $city
 * @property string $location
 * @property string $password
 * @property string $logo
 * @property boolean $is_sync
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Cartimatic\Store\Employee $manager
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\POS whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\POS whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\POS whereManagerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\POS wherePosName($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\POS whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\POS whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\POS whereLocation($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\POS wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\POS whereLogo($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\POS whereIsSync($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\POS whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\POS whereUpdatedAt($value)
 */
	class POS extends \Eloquent {}
}

namespace Cartimatic\POS\Http\Models{
/**
 * Cartimatic\POS\Http\Models\PosProductKeeping
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $barcode
 * @property string $custom_product_id
 * @property integer $store_product_keeping_id
 * @property integer $pos_id
 * @property boolean $status
 * @property integer $master_attribute_1
 * @property integer $master_attribute_1_value
 * @property integer $master_attribute_2
 * @property integer $master_attribute_2_value
 * @property float $price
 * @property float $cost_price
 * @property integer $discount
 * @property integer $quantity
 * @property integer $updated_quantity
 * @property string $package
 * @property string $labelcolor
 * @property string $labelsize
 * @property string $labelpackage
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Cartimatic\Store\StoreProduct $product
 * @property-read \Cartimatic\Admin\Http\StoreAttribute $master1
 * @property-read \Cartimatic\Admin\Http\StoreAttributeValue $value1
 * @property-read \Cartimatic\Admin\Http\StoreAttribute $master2
 * @property-read \Cartimatic\Admin\Http\StoreAttributeValue $value2
 * @property-read \Cartimatic\POS\Http\Models\POS $pos
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping whereBarcode($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping whereCustomProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping whereStoreProductKeepingId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping wherePosId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping whereMasterAttribute1($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping whereMasterAttribute1Value($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping whereMasterAttribute2($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping whereMasterAttribute2Value($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping whereCostPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping whereDiscount($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping whereUpdatedQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping wherePackage($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping whereLabelcolor($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping whereLabelsize($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping whereLabelpackage($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\PosProductKeeping whereDeletedAt($value)
 */
	class PosProductKeeping extends \Eloquent {}
}

namespace Cartimatic\POS\Http\Models{
/**
 * Cartimatic\POS\Http\Models\Returns
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $pos_id
 * @property boolean $return_type
 * @property integer $product_id
 * @property integer $store_keeping_id
 * @property integer $quantity
 * @property integer $quantity_received
 * @property string $description
 * @property boolean $status
 * @property string $detail
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Cartimatic\POS\Http\Models\POS $pos
 * @property-read \Cartimatic\Store\StoreProduct $product
 * @property-read \Cartimatic\Store\StoreProductKeepingLog $productLog
 * @property-read \Cartimatic\Store\StoreProductKeeping $keeping
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\Returns whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\Returns whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\Returns wherePosId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\Returns whereReturnType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\Returns whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\Returns whereStoreKeepingId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\Returns whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\Returns whereQuantityReceived($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\Returns whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\Returns whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\Returns whereDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\Returns whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\POS\Http\Models\Returns whereUpdatedAt($value)
 */
	class Returns extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\Cart
 *
 * @property integer $id
 * @property string $order_number
 * @property integer $drawer_id
 * @property integer $customer_id
 * @property integer $seller_id
 * @property integer $delivery_address_id
 * @property string $payment_type
 * @property integer $status
 * @property string $is_deleted
 * @property float $total_price
 * @property float $cash_price
 * @property float $card_price
 * @property float $total_affiliate_amount
 * @property float $total_shiping_cost
 * @property float $total_discount
 * @property integer $total_quantity
 * @property integer $conv_id
 * @property \Carbon\Carbon $created_at
 * @property string $approved_date
 * @property string $shiping_date
 * @property integer $pos_id
 * @property string $customer_name
 * @property integer $pos_order_id
 * @property string $received_date
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart whereOrderNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart whereDrawerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart whereSellerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart whereDeliveryAddressId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart wherePaymentType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart whereIsDeleted($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart whereTotalPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart whereCashPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart whereCardPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart whereTotalAffiliateAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart whereTotalShipingCost($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart whereTotalDiscount($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart whereTotalQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart whereConvId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart whereApprovedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart whereShipingDate($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart wherePosId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart whereCustomerName($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart wherePosOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart whereReceivedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Cart whereUpdatedAt($value)
 */
	class Cart extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\Category
 *
 * @property integer $id
 * @property string $slug
 * @property string $name
 * @property integer $owner_id
 * @property integer $category_parent_id
 * @property string $category_image
 * @property string $category_icon_url
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartimatic\Store\Category[] $childCategories
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartimatic\Store\StoreProduct[] $products
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Category whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Category whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Category whereOwnerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Category whereCategoryParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Category whereCategoryImage($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Category whereCategoryIconUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Category whereDeletedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\DeliveryCourier
 *
 * @property integer $id
 * @property integer $seller_id
 * @property integer $order_id
 * @property string $courier_service_name
 * @property string $courier_service_url
 * @property string $order_tracking_number
 * @property string $delivery_estimated_time
 * @property string $date_to_be_delivered
 * @property string $delivery_charges_paid
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\DeliveryCourier whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\DeliveryCourier whereSellerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\DeliveryCourier whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\DeliveryCourier whereCourierServiceName($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\DeliveryCourier whereCourierServiceUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\DeliveryCourier whereOrderTrackingNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\DeliveryCourier whereDeliveryEstimatedTime($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\DeliveryCourier whereDateToBeDelivered($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\DeliveryCourier whereDeliveryChargesPaid($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\DeliveryCourier whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\DeliveryCourier whereUpdatedAt($value)
 */
	class DeliveryCourier extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\Employee
 *
 * @property integer $id
 * @property string $name
 * @property integer $employer_id
 * @property string $email
 * @property string $phone_number
 * @property string $city
 * @property string $address
 * @property string $birthday
 * @property string $hire_date
 * @property integer $employee_number
 * @property integer $employee_type
 * @property string $employee_picture
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Cartimatic\Store\StoreEmployeeRoles $role
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Employee whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Employee whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Employee whereEmployerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Employee whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Employee wherePhoneNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Employee whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Employee whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Employee whereBirthday($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Employee whereHireDate($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Employee whereEmployeeNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Employee whereEmployeeType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Employee whereEmployeePicture($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Employee whereUpdatedAt($value)
 */
	class Employee extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\Notification
 *
 * @property integer $id
 * @property integer $resource_id created for
 * @property integer $subject_id Who create
 * @property string $object_type
 * @property integer $object_id
 * @property string $type
 * @property string $read
 * @property string $clicked
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Notification whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Notification whereResourceId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Notification whereSubjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Notification whereObjectType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Notification whereObjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Notification whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Notification whereRead($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Notification whereClicked($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\Notification whereUpdatedAt($value)
 */
	class Notification extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\ProductFavorites
 *
 * @property integer $favorite_id
 * @property integer $product_id
 * @property string $poster_type
 * @property integer $poster_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\ProductFavorites whereFavoriteId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\ProductFavorites whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\ProductFavorites wherePosterType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\ProductFavorites wherePosterId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\ProductFavorites whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\ProductFavorites whereUpdatedAt($value)
 */
	class ProductFavorites extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\RefundRequestAttachment
 *
 * @property integer $id
 * @property integer $refund_request_id
 * @property string $attachment_path
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\RefundRequestAttachment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\RefundRequestAttachment whereRefundRequestId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\RefundRequestAttachment whereAttachmentPath($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\RefundRequestAttachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\RefundRequestAttachment whereUpdatedAt($value)
 */
	class RefundRequestAttachment extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreAlbumPhotos
 *
 * @property integer $photo_id
 * @property integer $album_id
 * @property string $title
 * @property integer $parent_id
 * @property string $description
 * @property integer $order
 * @property string $owner_type
 * @property integer $owner_id
 * @property integer $file_id
 * @property integer $view_count
 * @property integer $comment_count
 * @property integer $he_featured
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Cartimatic\Store\StoreStorageFiles $storageFile
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbumPhotos wherePhotoId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbumPhotos whereAlbumId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbumPhotos whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbumPhotos whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbumPhotos whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbumPhotos whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbumPhotos whereOwnerType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbumPhotos whereOwnerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbumPhotos whereFileId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbumPhotos whereViewCount($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbumPhotos whereCommentCount($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbumPhotos whereHeFeatured($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbumPhotos whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbumPhotos whereUpdatedAt($value)
 */
	class StoreAlbumPhotos extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreAlbums
 *
 * @property integer $album_id
 * @property string $title
 * @property string $description
 * @property string $owner_type
 * @property integer $owner_id
 * @property integer $category_id
 * @property integer $photo_id
 * @property integer $view_count
 * @property integer $comment_count
 * @property boolean $search
 * @property string $type
 * @property integer $he_featured
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartimatic\Store\StoreAlbumPhotos[] $albumPhoto
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbums whereAlbumId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbums whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbums whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbums whereOwnerType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbums whereOwnerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbums whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbums wherePhotoId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbums whereViewCount($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbums whereCommentCount($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbums whereSearch($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbums whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbums whereHeFeatured($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbums whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreAlbums whereUpdatedAt($value)
 */
	class StoreAlbums extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreBankAccount
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $store_withdrawal_method_id
 * @property string $account_title
 * @property string $permanent_billing_address
 * @property string $temp_billing_address
 * @property string $city
 * @property string $state
 * @property string $post_code
 * @property string $country_code
 * @property string $account_number
 * @property string $iban_number
 * @property string $swift_code
 * @property string $bank_name
 * @property string $bank_branch_country_code
 * @property string $bank_branch_city
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreBankAccount whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreBankAccount whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreBankAccount whereStoreWithdrawalMethodId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreBankAccount whereAccountTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreBankAccount wherePermanentBillingAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreBankAccount whereTempBillingAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreBankAccount whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreBankAccount whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreBankAccount wherePostCode($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreBankAccount whereCountryCode($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreBankAccount whereAccountNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreBankAccount whereIbanNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreBankAccount whereSwiftCode($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreBankAccount whereBankName($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreBankAccount whereBankBranchCountryCode($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreBankAccount whereBankBranchCity($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreBankAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreBankAccount whereUpdatedAt($value)
 */
	class StoreBankAccount extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreCategoryAttribute
 *
 * @property integer $id
 * @property integer $store_attribute_id
 * @property integer $category_id
 * @property \Carbon\Carbon $created_at
 * @property string $is_default
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreCategoryAttribute whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreCategoryAttribute whereStoreAttributeId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreCategoryAttribute whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreCategoryAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreCategoryAttribute whereIsDefault($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreCategoryAttribute whereUpdatedAt($value)
 */
	class StoreCategoryAttribute extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreClaim
 *
 * @property integer $id
 * @property string $uuid
 * @property string $owner_type
 * @property integer $owner_id
 * @property integer $reason
 * @property string $detail
 * @property boolean $status
 * @property integer $arbitrator_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $title
 * @property integer $bank_account_id
 * @property string $favour_of_seller
 * @property string $favour_of_buyer
 * @property float $amount
 * @property string $remarks
 * @property string $attachment
 * @property integer $fee_paid
 * @property integer $fee_amount
 * @property-read \Cartimatic\Store\StoreDispute $dispute
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaim whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaim whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaim whereOwnerType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaim whereOwnerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaim whereReason($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaim whereDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaim whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaim whereArbitratorId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaim whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaim whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaim whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaim whereBankAccountId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaim whereFavourOfSeller($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaim whereFavourOfBuyer($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaim whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaim whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaim whereAttachment($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaim whereFeePaid($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaim whereFeeAmount($value)
 */
	class StoreClaim extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreClaimFeeTransaction
 *
 * @property integer $id
 * @property integer $claim_id
 * @property string $transaction_code
 * @property string $type
 * @property string $currency
 * @property string $state
 * @property string $response_object
 * @property boolean $gateway_id
 * @property float $amount
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaimFeeTransaction whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaimFeeTransaction whereClaimId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaimFeeTransaction whereTransactionCode($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaimFeeTransaction whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaimFeeTransaction whereCurrency($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaimFeeTransaction whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaimFeeTransaction whereResponseObject($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaimFeeTransaction whereGatewayId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaimFeeTransaction whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaimFeeTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreClaimFeeTransaction whereUpdatedAt($value)
 */
	class StoreClaimFeeTransaction extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreDeliveryAddress
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $country_id
 * @property string $first_name
 * @property string $last_name
 * @property string $st_address_1
 * @property string $st_address_2
 * @property string $city
 * @property string $state
 * @property string $zip_code
 * @property string $phone_number
 * @property string $email
 * @property string $is_deleted
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDeliveryAddress whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDeliveryAddress whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDeliveryAddress whereCountryId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDeliveryAddress whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDeliveryAddress whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDeliveryAddress whereStAddress1($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDeliveryAddress whereStAddress2($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDeliveryAddress whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDeliveryAddress whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDeliveryAddress whereZipCode($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDeliveryAddress wherePhoneNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDeliveryAddress whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDeliveryAddress whereIsDeleted($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDeliveryAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDeliveryAddress whereUpdatedAt($value)
 */
	class StoreDeliveryAddress extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreDispute
 *
 * @property integer $id
 * @property string $reference_id
 * @property integer $owner_id
 * @property integer $order_id
 * @property string $is_received
 * @property string $claim_request
 * @property float $claimed_amount
 * @property integer $reason
 * @property string $detail
 * @property boolean $status
 * @property integer $conv_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartimatic\Store\RefundRequestAttachment[] $attachments
 * @property-read \Cartimatic\Store\StoreOrder $order
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDispute whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDispute whereReferenceId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDispute whereOwnerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDispute whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDispute whereIsReceived($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDispute whereClaimRequest($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDispute whereClaimedAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDispute whereReason($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDispute whereDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDispute whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDispute whereConvId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDispute whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDispute whereUpdatedAt($value)
 */
	class StoreDispute extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreDrawer
 *
 * @property integer $id
 * @property integer $pos_id
 * @property integer $pos_drawer_id
 * @property integer $store_id
 * @property float $opening_balance
 * @property float $closing_balance
 * @property string $status
 * @property boolean $is_sync
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDrawer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDrawer wherePosId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDrawer wherePosDrawerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDrawer whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDrawer whereOpeningBalance($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDrawer whereClosingBalance($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDrawer whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDrawer whereIsSync($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDrawer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreDrawer whereUpdatedAt($value)
 */
	class StoreDrawer extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreEmployeeRoles
 *
 * @property integer $id
 * @property integer $store_id
 * @property string $name
 * @property string $slug
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreEmployeeRoles whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreEmployeeRoles whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreEmployeeRoles whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreEmployeeRoles whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreEmployeeRoles whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreEmployeeRoles whereUpdatedAt($value)
 */
	class StoreEmployeeRoles extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreOrder
 *
 * @property integer $id
 * @property string $order_number
 * @property integer $drawer_id
 * @property integer $customer_id
 * @property integer $seller_id
 * @property integer $delivery_address_id
 * @property string $payment_type
 * @property integer $status
 * @property string $is_deleted
 * @property float $total_price
 * @property float $cash_price
 * @property float $card_price
 * @property float $total_affiliate_amount
 * @property float $total_shiping_cost
 * @property float $total_discount
 * @property integer $total_quantity
 * @property integer $conv_id
 * @property \Carbon\Carbon $created_at
 * @property string $approved_date
 * @property string $shiping_date
 * @property integer $pos_id
 * @property string $customer_name
 * @property integer $pos_order_id
 * @property string $received_date
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @property-read \App\User $customer
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartimatic\Store\StoreOrderItems[] $orderItems
 * @property-read \Cartimatic\Store\StoreOrderTransaction $storeOrderTransaction
 * @property-read \Cartimatic\Store\DeliveryCourier $delivery
 * @property-read \Cartimatic\Store\StoreOrderTransaction $transaction
 * @property-read \Cartimatic\POS\Http\Models\POS $pos
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder whereOrderNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder whereDrawerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder whereSellerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder whereDeliveryAddressId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder wherePaymentType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder whereIsDeleted($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder whereTotalPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder whereCashPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder whereCardPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder whereTotalAffiliateAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder whereTotalShipingCost($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder whereTotalDiscount($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder whereTotalQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder whereConvId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder whereApprovedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder whereShipingDate($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder wherePosId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder whereCustomerName($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder wherePosOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder whereReceivedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrder whereUpdatedAt($value)
 */
	class StoreOrder extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreOrderItemAttribute
 *
 * @property integer $id
 * @property integer $store_order_item_id
 * @property integer $store_product_attribute_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderItemAttribute whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderItemAttribute whereStoreOrderItemId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderItemAttribute whereStoreProductAttributeId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderItemAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderItemAttribute whereUpdatedAt($value)
 */
	class StoreOrderItemAttribute extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreOrderItems
 *
 * @property integer $id
 * @property float $product_price
 * @property float $product_discount
 * @property integer $quantity
 * @property integer $product_id
 * @property integer $affiliate_item_id
 * @property float $affiliate_reward_amount
 * @property integer $product_keeping_id
 * @property integer $order_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderItems whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderItems whereProductPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderItems whereProductDiscount($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderItems whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderItems whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderItems whereAffiliateItemId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderItems whereAffiliateRewardAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderItems whereProductKeepingId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderItems whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderItems whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderItems whereUpdatedAt($value)
 */
	class StoreOrderItems extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreOrderStatusLog
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $ip
 * @property integer $status_changed_from
 * @property integer $status_changed_to
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderStatusLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderStatusLog whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderStatusLog whereIp($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderStatusLog whereStatusChangedFrom($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderStatusLog whereStatusChangedTo($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderStatusLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderStatusLog whereUpdatedAt($value)
 */
	class StoreOrderStatusLog extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreOrderTransaction
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $order_id
 * @property integer $gateway_id
 * @property string $timestamp
 * @property string $type
 * @property string $state
 * @property string $gateway_transaction_id
 * @property string $gateway_parent_transaction_id
 * @property string $gateway_order_id
 * @property float $amount
 * @property float $total_amount
 * @property string $currency
 * @property mixed $response_object
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Cartimatic\Store\StoreOrder $storeOrder
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderTransaction whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderTransaction whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderTransaction whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderTransaction whereGatewayId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderTransaction whereTimestamp($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderTransaction whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderTransaction whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderTransaction whereGatewayTransactionId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderTransaction whereGatewayParentTransactionId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderTransaction whereGatewayOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderTransaction whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderTransaction whereTotalAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderTransaction whereCurrency($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderTransaction whereResponseObject($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreOrderTransaction whereUpdatedAt($value)
 */
	class StoreOrderTransaction extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreProduct
 *
 * @property integer $id
 * @property string $custom_id
 * @property string $barcode_id
 * @property float $cost_price
 * @property string $slug
 * @property string $title
 * @property string $overview
 * @property float $price
 * @property string $description
 * @property boolean $is_featured
 * @property integer $affiliate
 * @property integer $affiliate_reward
 * @property float $discount
 * @property float $length
 * @property float $weight
 * @property float $width
 * @property float $height
 * @property integer $quantity
 * @property integer $sold
 * @property integer $owner_id
 * @property integer $category_id
 * @property integer $shipping_cost
 * @property integer $sub_category_id
 * @property integer $is_published
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Cartimatic\Store\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartimatic\Store\StoreProductAttribute[] $attributes
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartimatic\Store\StoreProductKeeping[] $productKeeping
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereCustomId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereBarcodeId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereCostPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereOverview($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereIsFeatured($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereAffiliate($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereAffiliateReward($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereDiscount($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereLength($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereWeight($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereWidth($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereHeight($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereSold($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereOwnerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereShippingCost($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereSubCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereIsPublished($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProduct whereDeletedAt($value)
 */
	class StoreProduct extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreProductAttribute
 *
 * @property integer $id
 * @property integer $store_attribute_id
 * @property integer $product_category_attribute_id
 * @property integer $product_category_attribute_value_id
 * @property integer $product_id
 * @property \Carbon\Carbon $created_at
 * @property integer $is_deleted
 * @property \Carbon\Carbon $updated_at
 * @property-read \Cartimatic\Admin\Http\StoreCategoryAttribute $defaults
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartimatic\Admin\Http\StoreAttributeValue[] $attributeValues
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartimatic\Store\StoreProductAttributeValue[] $productAttribute
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductAttribute whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductAttribute whereStoreAttributeId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductAttribute whereProductCategoryAttributeId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductAttribute whereProductCategoryAttributeValueId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductAttribute whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductAttribute whereIsDeleted($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductAttribute whereUpdatedAt($value)
 */
	class StoreProductAttribute extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreProductAttributeValue
 *
 * @property integer $id
 * @property integer $store_product_attribute_id
 * @property integer $store_attribute_value_id
 * @property string $product_attribute_photo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Cartimatic\Admin\Http\StoreAttributeValue $attributeValues
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductAttributeValue whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductAttributeValue whereStoreProductAttributeId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductAttributeValue whereStoreAttributeValueId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductAttributeValue whereProductAttributePhoto($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductAttributeValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductAttributeValue whereUpdatedAt($value)
 */
	class StoreProductAttributeValue extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreProductCategoryAttributeValues
 *
 */
	class StoreProductCategoryAttributeValues extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreProductFeature
 *
 * @property integer $id
 * @property integer $key_feature_type
 * @property integer $pr_id
 * @property string $title
 * @property string $detail
 * @property integer $is_deleted
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductFeature whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductFeature whereKeyFeatureType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductFeature wherePrId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductFeature whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductFeature whereDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductFeature whereIsDeleted($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductFeature whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductFeature whereUpdatedAt($value)
 */
	class StoreProductFeature extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreProductImage
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $image_path
 * @property integer $sort_order
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductImage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductImage whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductImage whereImagePath($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductImage whereSortOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductImage whereUpdatedAt($value)
 */
	class StoreProductImage extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreProductKeeping
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $custom_product_id
 * @property string $barcode
 * @property integer $master_attribute_1
 * @property integer $master_attribute_1_value
 * @property integer $master_attribute_2
 * @property integer $master_attribute_2_value
 * @property float $cost_price
 * @property float $price
 * @property integer $discount
 * @property integer $quantity
 * @property integer $stock_alert_quantity
 * @property string $color
 * @property string $size
 * @property string $package
 * @property string $labelcolor
 * @property string $labelsize
 * @property string $labelpackage
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Cartimatic\Admin\Http\StoreAttribute $master1
 * @property-read \Cartimatic\Admin\Http\StoreAttributeValue $value1
 * @property-read \Cartimatic\Admin\Http\StoreAttribute $master2
 * @property-read \Cartimatic\Admin\Http\StoreAttributeValue $value2
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeeping whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeeping whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeeping whereCustomProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeeping whereBarcode($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeeping whereMasterAttribute1($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeeping whereMasterAttribute1Value($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeeping whereMasterAttribute2($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeeping whereMasterAttribute2Value($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeeping whereCostPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeeping wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeeping whereDiscount($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeeping whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeeping whereStockAlertQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeeping whereColor($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeeping whereSize($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeeping wherePackage($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeeping whereLabelcolor($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeeping whereLabelsize($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeeping whereLabelpackage($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeeping whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeeping whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeeping whereDeletedAt($value)
 */
	class StoreProductKeeping extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreProductKeepingLog
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $product_keeping_id
 * @property integer $store_product_keeping_id For POS. Reference for product keepings
 * @property string $object_type Object tye i.e POS or store.
 * @property integer $object_id Id of object
 * @property integer $quantity
 * @property string $transaction_type Product addition is credit and product subtration debit
 * @property string $type Sale, or add product quantity or sent to POS
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeepingLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeepingLog whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeepingLog whereProductKeepingId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeepingLog whereStoreProductKeepingId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeepingLog whereObjectType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeepingLog whereObjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeepingLog whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeepingLog whereTransactionType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeepingLog whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeepingLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductKeepingLog whereUpdatedAt($value)
 */
	class StoreProductKeepingLog extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreProductReview
 *
 * @property integer $id
 * @property string $description
 * @property integer $owner_id
 * @property integer $product_id
 * @property integer $rating
 * @property string $is_revised
 * @property string $is_revise_request
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductReview whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductReview whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductReview whereOwnerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductReview whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductReview whereRating($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductReview whereIsRevised($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductReview whereIsReviseRequest($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductReview whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductReview whereUpdatedAt($value)
 */
	class StoreProductReview extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreProductSearch
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $product_name
 * @property string $description
 * @property integer $owner_id
 * @property integer $counter
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductSearch whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductSearch whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductSearch whereProductName($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductSearch whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductSearch whereOwnerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductSearch whereCounter($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductSearch whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductSearch whereUpdatedAt($value)
 */
	class StoreProductSearch extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreProductStat
 *
 * @property integer $id
 * @property string $stat_type
 * @property integer $user_id
 * @property string $user_type
 * @property integer $user_age
 * @property string $user_gender
 * @property integer $user_region
 * @property string $user_ip
 * @property integer $product_owner_id
 * @property integer $product_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductStat whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductStat whereStatType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductStat whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductStat whereUserType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductStat whereUserAge($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductStat whereUserGender($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductStat whereUserRegion($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductStat whereUserIp($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductStat whereProductOwnerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductStat whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductStat whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreProductStat whereUpdatedAt($value)
 */
	class StoreProductStat extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreRequest
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $detail
 * @property boolean $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreRequest whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreRequest whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreRequest whereDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreRequest whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreRequest whereUpdatedAt($value)
 */
	class StoreRequest extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreReversal
 *
 * @property integer $id
 * @property float $sum
 * @property float $amount
 * @property \Carbon\Carbon $created_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreReversal whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreReversal whereSum($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreReversal whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreReversal whereCreatedAt($value)
 */
	class StoreReversal extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreShippingCost
 *
 * @property integer $id
 * @property integer $region_id
 * @property string $status
 * @property float $shipping_cost
 * @property integer $product_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreShippingCost whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreShippingCost whereRegionId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreShippingCost whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreShippingCost whereShippingCost($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreShippingCost whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreShippingCost whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreShippingCost whereUpdatedAt($value)
 */
	class StoreShippingCost extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreShippingCountry
 *
 * @property integer $id
 * @property integer $region_id
 * @property integer $product_id
 * @property integer $country_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreShippingCountry whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreShippingCountry whereRegionId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreShippingCountry whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreShippingCountry whereCountryId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreShippingCountry whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreShippingCountry whereUpdatedAt($value)
 */
	class StoreShippingCountry extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreShippingRegion
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreShippingRegion whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreShippingRegion whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreShippingRegion whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreShippingRegion whereUpdatedAt($value)
 */
	class StoreShippingRegion extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreStorageFiles
 *
 * @property integer $file_id
 * @property integer $parent_file_id
 * @property string $type
 * @property string $parent_type
 * @property integer $parent_id
 * @property integer $user_id
 * @property string $storage_path
 * @property string $extension
 * @property string $name
 * @property string $mime_type
 * @property string $mime_major
 * @property integer $size
 * @property string $hash
 * @property boolean $is_temp
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreStorageFiles whereFileId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreStorageFiles whereParentFileId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreStorageFiles whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreStorageFiles whereParentType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreStorageFiles whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreStorageFiles whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreStorageFiles whereStoragePath($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreStorageFiles whereExtension($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreStorageFiles whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreStorageFiles whereMimeType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreStorageFiles whereMimeMajor($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreStorageFiles whereSize($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreStorageFiles whereHash($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreStorageFiles whereIsTemp($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreStorageFiles whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreStorageFiles whereUpdatedAt($value)
 */
	class StoreStorageFiles extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreTransaction
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $type
 * @property string $parent_type
 * @property integer $parent_id
 * @property string $object_type
 * @property integer $object_id
 * @property float $amount
 * @property string $currency
 * @property string $transaction_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreTransaction whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreTransaction whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreTransaction whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreTransaction whereParentType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreTransaction whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreTransaction whereObjectType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreTransaction whereObjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreTransaction whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreTransaction whereCurrency($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreTransaction whereTransactionType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreTransaction whereUpdatedAt($value)
 */
	class StoreTransaction extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreWithdrawal
 *
 * @property integer $id
 * @property string $type
 * @property integer $seller_id
 * @property string $deposited_to
 * @property string $witdrawal_type
 * @property float $amount
 * @property integer $fee_percentage
 * @property boolean $is_completed
 * @property boolean $is_cancelled
 * @property string $status
 * @property integer $withdrawal_method_id
 * @property string $deposit_slip_number
 * @property integer $deposit_attachment_id
 * @property \Carbon\Carbon $created_at
 * @property string $deposit_date
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $seller
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreWithdrawal whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreWithdrawal whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreWithdrawal whereSellerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreWithdrawal whereDepositedTo($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreWithdrawal whereWitdrawalType($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreWithdrawal whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreWithdrawal whereFeePercentage($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreWithdrawal whereIsCompleted($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreWithdrawal whereIsCancelled($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreWithdrawal whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreWithdrawal whereWithdrawalMethodId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreWithdrawal whereDepositSlipNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreWithdrawal whereDepositAttachmentId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreWithdrawal whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreWithdrawal whereDepositDate($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreWithdrawal whereUpdatedAt($value)
 */
	class StoreWithdrawal extends \Eloquent {}
}

namespace Cartimatic\Store{
/**
 * Cartimatic\Store\StoreWithdrawalMethod
 *
 * @property integer $id
 * @property integer $seller_id
 * @property string $method
 * @property boolean $is_default
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreWithdrawalMethod whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreWithdrawalMethod whereSellerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreWithdrawalMethod whereMethod($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreWithdrawalMethod whereIsDefault($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreWithdrawalMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cartimatic\Store\StoreWithdrawalMethod whereUpdatedAt($value)
 */
	class StoreWithdrawalMethod extends \Eloquent {}
}

