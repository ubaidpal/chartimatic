<section>
    <div class="row">
        <div class="col-sm-12">
        <?php
        $page_id = get_theme_option($theme_id,'home-page-content-id',null,true);
        $page = getPage($page_id);
        ?>
        @if(!empty($page->id))
        <p>{!! nl2br($page->content) !!}</p>
        @endif
        </div>
    </div>
</section>