<section class="header_text">
	<?php
	$page_id = get_theme_option($theme_id,'home-page-content-id',null,true);
	$page = getPage($page_id);

	if(!empty($page->id)){
	?>
	<p><?php echo nl2br($page->content) ?></p>
	<?php
	}
	?>
</section>