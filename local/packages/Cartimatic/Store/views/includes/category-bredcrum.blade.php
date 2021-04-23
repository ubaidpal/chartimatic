{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 08-Sep-16 12:18 PM
    * File Name    : 

--}}
<?php $bred = getBreadCrumbsBySubCategoryId($categoryID);
$bred = array_reverse($bred);
$numItems = count($bred);
$i = 0;
?>

@foreach($bred as $cat)
    {{$cat['name'] }} @if(++$i !== $numItems) > @endif
@endforeach
