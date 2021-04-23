<?php
if (isset($category)) {
    if (!is_object($category)) {
        $category = getCategoryId($category);
    }
}

if(isset($category->id)){
$count = 0; $breadCrumbsCats = getBreadCrumbsBySubCategoryId($category->id);
$breadCrumbsCats = array_reverse($breadCrumbsCats);
?>
@if($category->category_parent_id == 0)
    <h1>{{$breadCrumbsCats[0]['name']}}</h1>
@endif
<ol class="breadcrumb m0">
    <li><a href="{{url('/')}}">Home</a></li>
    <!--<li><a href="{{url('all-categories')}}">All Categories</a></li>-->
    @foreach($breadCrumbsCats as $breadCrumbsCat)
        @if($breadCrumbsCat['id'] == $category->id)
            <li class="active">{{$category->name}}</li>
        @else
            <li><a href="{{url('category/'.$breadCrumbsCat['slug'])}}">{{$breadCrumbsCat['name']}}</a></li>
        @endif
        <?php $count++; ?>
    @endforeach
    <?php  } ?>

</ol>
