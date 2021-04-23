<div class="mb20">
    <label>Website Title</label>
    <input placeholder="Website title" type="text" data-type="text" name="website-title" value="<?php get_theme_option($theme_id,'website-title',null) ?>" class="edit-input-option form-control ">
</div>
<div class="mb10">
    <label>Header Logo</label>
    <img class="header-logo" src="<?php get_theme_option($theme_id,'header-logo',getAssetPath($theme->path).'/images/home/logo-placeholder.jpg') ?>" width="<?php get_theme_option($theme_id,'header-logo-width','150') ?>">
</div>
<div class="mb20">
    <input type="file" name="options[header-logo]" class="update-img" data-key="header-logo" data-target="header-logo">
</div>
<div class="mb20">
    <label>Custom logo width (in pixels)</label>
    <input placeholder="Logo width (px)" data-type="number" type="text" name="header-logo-width" value="<?php get_theme_option($theme_id,'header-logo-width','150') ?>" class="edit-input-option form-control">
</div>
<div class="mb10">
    <label>Favicon</label>
    <img class="favicon-logo" src="<?php get_theme_option($theme_id,'favicon',null)?>" width="32" height="32"><br/><br/>
    <input type="file" name="options[favicon]" class="update-img" data-key="favicon" data-target="favicon-logo">
    <p class="next-type--note">32 x 32px .png</p>
</div>