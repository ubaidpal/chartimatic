<section id="slider">
    <div class="row">
        <div class="col-sm-12">
            <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                <?php
                $data_slide_to = 0;
                $active_slide = 'active';
                ?>
                <ol class="carousel-indicators">
                    @for($i = 1; $i <= 6; $i++)
                    <?php $option_img = get_theme_option($theme_id,'slider-img-'.$i.'-enable',0,true); ?>
                    @if(@$option_img == 1)
                        <li data-target="#slider-carousel" data-slide-to="{{$data_slide_to++}}" class="{{$active_slide}}"></li>
                        <?php $active_slide = ''; ?>
                    @endif
                    @endfor
                </ol>

                <div class="carousel-inner">
                    <?php $active_img = 'active'; ?>
                    @for($i = 1; $i <= 6; $i++)
                    <?php $option_img = get_theme_option($theme_id,'slider-img-'.$i.'-enable',0,true); ?>
                    @if(@$option_img == 1)
                    <div class="item {{$active_img}}">
                        <div class="col-sm-12">
                            <div>
                                <h1><?php get_theme_option($theme_id,'slider-img-'.$i.'-heading','') ?></h1>
                                <h2><?php get_theme_option($theme_id,'slider-img-'.$i.'-subheading','') ?></h2>
                                <p><?php get_theme_option($theme_id,'slider-img-'.$i.'-description','') ?></p>
                                <!--<button type="button" class="btn btn-default get">Get it now</button>-->
                            </div>
                            <?php $img_url = get_theme_option($theme_id,'slider-img-'.$i.'-link','',true); ?>
                            @if(!empty($img_url))
                            <a href="{{$img_url}}">
                            <img src="<?php get_theme_option($theme_id,'slider-img-'.$i,getAssetPath().'/images/home/slider-placeholder.jpg') ?>" class="girl img-responsive" alt="" />
                            </a>
                            @else
                            <img src="<?php get_theme_option($theme_id,'slider-img-'.$i,getAssetPath().'/images/home/slider-placeholder.jpg') ?>" class="girl img-responsive" alt="" />
                            @endif
                        </div>
                    </div>
                    <?php $active_img = ''; ?>
                    @endif
                    @endfor
                </div>

                <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>

            </div>

        </div>
    </div>
</section>