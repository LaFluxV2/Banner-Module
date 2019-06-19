<?php
$banner_items = ExtensionsValley\Banners\Models\BannerModel::getAllBannersWithType($position, $category_id);
?>
<!--Start Slider-->
<section class="slider">
    <!-- START REVOLUTION SLIDER 2.3.91 -->
    <div class="fullwidthbanner-container">
        <div class="fullwidthbanner">
            <ul>
                <!-- SLIDEUP -->
                @if(sizeof($banner_items))
                    @foreach($banner_items as $banner)
                        <li data-transition="fade" data-slotamount="1" data-masterspeed="1000" data-delay="9000"
                            data-thumb="{{asset("$banner->media")}}">
                            <img src="{{asset("$banner->media")}}"
                                 data-lazyload="{{asset("$banner->media")}}"
                                 alt="darkblurbg" data-bgfit="cover" data-bgposition="left top"
                                 data-bgrepeat="no-repeat">
                            <div class="caption sfr tp-caption tp-resizeme" data-x="20" data-y="355"
                                 data-easing="easeOutExpo"
                                 data-start="3400" data-speed="1000">
                                {{--<a href="#" class="btn btn-large btn-block btn-default">Try it now!</a>--}}
                            </div>
                        </li>
                @endforeach
            @endif
            <!-- SLIDEUP -->
            </ul>
            <!--
                                <div class="tp-bannertimer"></div>
            -->
        </div>
    </div>
    <!-- END REVOLUTION SLIDER -->
</section>
<!--End Slider-->
