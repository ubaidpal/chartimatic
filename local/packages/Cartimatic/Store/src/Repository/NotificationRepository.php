<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 22-Jul-16 11:17 AM
 * File Name    : NotificationRepository.php
 */

namespace Cartimatic\Store\Repository;

use App\Facades\UrlFilter;
use App\Http\Requests\Request;
use App\User;
use Cartimatic\POS\Http\Models\POS;
use Cartimatic\Store\Notification;
use Hashids\Hashids;

class NotificationRepository
{
    function model() {
        // TODO: Implement model() method.
        return 'App\Notification';
    }

    private function is_api() {
        return \URLFilter::filter();
    }

    public function getNotifications($user_id, $userDetail) {
        $this->updatedNotificationStatus($user_id, 'read', 1);
        $notifications = Notification::whereResourceId($user_id)->orderBy('id', 'DESC')->paginate(12);
        if(count($notifications) > 0) {
            return ['strings' => $this->generateNotificationData($notifications, $userDetail), 'notifications' => $notifications];
        }

    }

    private function generateNotificationData($notifications, $userDetail) {
        $notificationStrings = [];
        foreach ($notifications as $notification) {
            $data = $this->getObjectData($notification->object_type, $notification->object_id, $notification->id, $userDetail);

            $notificationStrings[] = $this->generateNotificationString($data, $notification);

        }
        return $notificationStrings;
        /*echo '<tt><pre>';
        print_r($notificationStrings);
        die;*/
    }

    private function getNotificationString($type) {
        return \Config::get('constant_notifications.NOTIFICATION_STRING.' . $type);
    }

    private function getObjectData($object_type, $object_id, $notificationId, $userDetail) {
        switch ($object_type) {
            /** @noinspection PhpMissingBreakStatementInspection */
            case \Config::get('constant_notifications.OBJECT_TYPES.ORDER.NAME'):

                $objectUrl   = url('store/admin/report/sales');
                $objectData = [
                        'objectUrl'    => $objectUrl,
                        'objectType'   => $object_type,
                        'objectId'     => $object_id,
                        'objectName'   => 'Orders',
                        'generatedUrl' => $this->generateUrl('Orders', $objectUrl, $notificationId),
                    ];

                    return $objectData;
                    break;
            /** @noinspection PhpMissingBreakStatementInspection */
            case \Config::get('constant_notifications.OBJECT_TYPES.PUSHED.NAME'):
                $object = POS::find($object_id);
                    $objectUrl   = url('admin/store/pos/manage-inventory/'.$object_id);
                    $objectName  = $object->pos_name;
                    $objectData = [
                        'objectUrl'    => $objectUrl,
                        'objectType'   => $object_type,
                        'objectId'     => $object->id,
                        'objectName'   => 'pushed',
                        'generatedUrl' => $this->generateUrl('pushed', $objectUrl, $notificationId),
                    ];

                    return $objectData;
                    break;
            case \Config::get('constant_notifications.OBJECT_TYPES.RETURN.NAME'):
                $objectUrl   = url('store/admin/report/lost');
                $objectData = [
                    'objectUrl'    => $objectUrl,
                    'objectType'   => $object_type,
                    'objectId'     => $object_id,
                    'objectName'   => 'Return',
                    'generatedUrl' => $this->generateUrl('Returned', $objectUrl, $notificationId),
                ];

                return $objectData;
                break;
            case \Config::get('constant_notifications.OBJECT_TYPES.DAMAGE.NAME'):
                $objectUrl   = url('store/admin/report/lost');
                $objectData = [
                    'objectUrl'    => $objectUrl,
                    'objectType'   => $object_type,
                    'objectId'     => $object_id,
                    'objectName'   => 'Damage',
                    'generatedUrl' => $this->generateUrl('Damaged', $objectUrl, $notificationId),
                ];

                return $objectData;
                break;
            default:
                return '';
                break;
        }
    }

    public function encode($id, $hash) {
        return Hashids::connection($hash)->encode($id);
    }

    public function deCode($id, $hash) {
        return Hashids::connection($hash)->decode($id)[ 0 ];
    }

    private function generateNotificationString($data, $notification) {
        $string       = $this->getNotificationString($notification->type);

        $resourceData = POS::find($notification->subject_id);
        if(!$this->is_api()) {
            $subjectName = "<strong>$resourceData->pos_name</strong>";
        } else {
            $subjectName = $resourceData->pos_name;
        }

        if($this->is_api()) {
            $notificationString = str_replace('$resource', '', $string);

        } else {
            if(!empty($data[ 'objectName' ])) {

                $string = str_replace('$object', $data[ 'generatedUrl' ], $string);
            }
            $notificationString = str_replace('$resource', $subjectName, $string);
        }

        return [
            'string'          => $notificationString,
            'url'             => $data[ 'objectUrl' ],
            'object'          => [
                'name' => $data[ 'objectName' ],
                'type' => $data[ 'objectType' ],
                'id'   => $data[ 'objectId' ]
            ],
            'notification_id' => $notification->id,
            'is_clicked'      => $notification->clicked,
            'is_read'         => $notification->read,
            'date'            => $notification->created_at,
        ];

    }

    private function generateUrl($objectName, $objectUrl, $notificationId) {
        $url = base64_encode($objectUrl);
        $url = route('read-notification', [$url, $notificationId]);
        return "<a href='$url'>$objectName</a>";
    }

    public function markRead($id, $userId) {
        $notification = Notification::find($id);
        if($notification->resource_id == $userId) {
            $notification->read = 1;
            $notification->save();
            return TRUE;
        }
        return FALSE;
    }

    public function getNotificationCount($userId) {
        return Notification::whereResourceId($userId)->whereRead(0)->whereClicked(0)->count();
    }

    private function updatedNotificationStatus($user_id, $type, $status) {
        $data = [
            $type => $status
        ];

        Notification::whereResourceId($user_id)->update($data);
    }
}
