<footer id="footer">

    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <?php
                $footer_navs = get_theme_footer_nav($theme_id);
                ?>
                @if(!$footer_navs->isEmpty())

                @foreach($footer_navs as $nav)
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>{{$nav->value  }}</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <?php
                            $footer_nav_items = get_theme_options($theme_id,'footer-nav-item-name',[],true,['parent_id' => $nav->id])
                            ?>
                            @if(!empty($footer_nav_items))
                                @foreach($footer_nav_items as $option)
                                    <?php
                                    $theme_option = get_theme_option_by_parent_id($theme_id,$option->id);
                                    ?>
                                    <li>
                                        @if($theme_option->key == 'page' && $theme_option->value == -1)
                                        <a href="{{url('contact-us')}}">Contact Us</a>
                                        @else
                                        <a @if($theme_option->key) target="_blank" @endif href="@if($theme_option->key == 'link') {{$theme_option->value}} @elseif($theme_option->key == 'page') {{url('pages/'.$theme_option->value)}} @endif">{{$option->value}}</a>
                                        @endif
                                    </li>
                                @endforeach
                            @endif

                        </ul>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Service</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Online Help</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Order Status</a></li>
                            <li><a href="#">Change Location</a></li>
                            <li><a href="#">FAQ’s</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Quock Shop</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">T-Shirt</a></li>
                            <li><a href="#">Mens</a></li>
                            <li><a href="#">Womens</a></li>
                            <li><a href="#">Gift Cards</a></li>
                            <li><a href="#">Shoes</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Policies</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privecy Policy</a></li>
                            <li><a href="#">Refund Policy</a></li>
                            <li><a href="#">Billing System</a></li>
                            <li><a href="#">Ticket System</a></li>
                        </ul>
                    </div>
                </div>
                @endif

                <div class="col-sm-3 col-sm-offset-1 pull-right">
                    <div class="single-widget">
                        <h2>About Shopper</h2>
                        <form action="#" class="searchform">
                            <input type="text" placeholder="Your email address" />
                            <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                            <p>Get the most recent updates from <br />our site and be updated your self...</p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2013 Cartimatic . All rights reserved.</p>
                <!--<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>-->
            </div>
        </div>
    </div>

</footer>