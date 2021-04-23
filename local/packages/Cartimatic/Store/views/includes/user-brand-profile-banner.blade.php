<?php
if ($user->user_type == Config::get('constants.REGULAR_USER')) {
    $detail = $user->consumer_detail;
    $name = $user->displayname;
} else {
    $detail = $user->brand_detail;
    $name = $detail->brand_name;
}

?>
<p>This is brand profile page. </p>
