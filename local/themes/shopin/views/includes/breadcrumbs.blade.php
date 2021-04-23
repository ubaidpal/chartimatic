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
    @foreach($breadCrumbsCats as $breadCrumbsCat)
        @if($breadCrumbsCat['id'] == $category->id)
        <div class="container">
            <div class="banner-top" style="background: url('<?php echo asset($category->category_image); ?>') no-repeat;">
                <div class="container">
                    <h1><?php echo $category->name; ?></h1>
                    <em></em>
                    <h2><a href="{{url('/')}}">Home</a><label>/</label><?php echo $category->name; ?></h2>
                </div>
            </div>
        </div>
        @endif
        <?php $count++; ?>
    @endforeach
    <?php  } ?>
