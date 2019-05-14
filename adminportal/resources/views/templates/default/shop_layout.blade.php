<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description??'' }}">
    <meta name="keyword" content="{{ $keyword??'' }}">
    <meta property="fb:app_id" content="{{ $configsGlobal['site_fb_appID'] }}"/>
    <title>{{$title??''}}</title>
    <meta property="og:image" content="{{ !empty($og_image)?$og_image:asset('images/org.jpg') }}"/>
    <meta property="og:url" content="{{ \Request::fullUrl() }}"/>
    <meta property="og:type" content="Website"/>
    <meta property="og:title" content="{{ $title??'' }}"/>
    <meta property="og:description" content="{{ $description??'' }}"/>
    @isset ($layouts['meta'])
        @foreach ( $layouts['meta']  as $element)
            {!! $element->html !!}
        @endforeach
    @endisset
    <link href="{{ asset($theme_asset.'/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset($theme_asset.'/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset($theme_asset.'/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{ asset($theme_asset.'/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset($theme_asset.'/css/main.css')}}" rel="stylesheet">
    <link href="{{ asset($theme_asset.'/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{ asset($theme_asset.'/js/html5shiv.js')}}"></script>
    <script src="{{ asset($theme_asset.'/js/respond.min.js')}}"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{ asset($theme_asset.'/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="{{ asset($theme_asset.'/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="{{ asset($theme_asset.'/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="{{ asset($theme_asset.'/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed"
          href="{{ asset($theme_asset.'/images/ico/apple-touch-icon-57-precomposed.png')}}">
    <style type="text/css">
        .new-price {
            color: #FE980F;
            font-size: 20px;
            padding: 10px;
            font-weight: bold;
        }

        .old-price {
            text-decoration: line-through;
            color: #a95d5d;
            font-size: 17px;
            padding: 10px;
        }

        .locale .dropdown-menu {
            min-width: auto !important;
        }

        .locale button {
            min-height: 30px !important;
        }
    </style>
    @isset ($layouts['header'])
        @foreach ( $layouts['header']  as $element)
            {!! $element->html !!}
        @endforeach
    @endisset
</head><!--/head-->
<body>
@isset ($layouts['top'])
    @foreach ( $layouts['top']  as $element)
        {!! $element->html !!}
    @endforeach
@endisset
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> {{ $configsGlobal['phone'] }}</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> {{ $configsGlobal['email'] }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group pull-right">
                        <div class="btn-group locale">
                            @if (count($languages)>1)
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                        data-toggle="dropdown"><img
                                            src="{{ asset($path_file.'/'.$languages[app()->getLocale()]['icon']) }}"
                                            style="height: 25px;">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach ($languages as $key => $language)
                                        <li><a href="{{ url('locale/'.$key) }}"><img
                                                        src="{{ asset($path_file.'/'.$language['icon']) }}"
                                                        style="height: 25px;"></a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        @if (count($currencies)>1)
                            <div class="btn-group locale">
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                        data-toggle="dropdown">
                                    {{ \Helper::getCurrency()['name'] }}
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach ($currencies as $key => $currency)
                                        <li><a href="{{ url('currency/'.$currency->code) }}">{{ $currency->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{ route('home') }}"><img style="width: 150px;" src="{{ asset($logo) }}" alt=""/></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ route('profile') }}"><i
                                            class="fa fa-user"></i> {{ trans('language.account') }}</a></li>
                            <li><a href="{{ route('wishlist') }}"><span style="border-radius: 3px;padding: 5px;"
                                                                        class="label_top label-warning shopping-wishlist"
                                                                        id="count_wishlist">{{ Cart::instance('wishlist')->count() }}</span><i
                                            class="fa fa-star"></i> {{ trans('language.wishlist') }}</a></li>
                            <li><a href="{{ route('compare') }}"><span style="border-radius: 3px;padding: 5px;"
                                                                       class="label_top label-warning shopping-compare"
                                                                       id="count_compare">{{ Cart::instance('compare')->count() }}</span><i
                                            class="fa fa-crosshairs"></i> {{ trans('language.compare') }}</a></li>
                            <li><a href="{{ route('cart') }}"><span style="border-radius: 3px;padding: 5px;"
                                                                    class="label_top label-warning shopping-cart"
                                                                    id="count_cart">{{ Cart::instance('default')->count() }}</span><i
                                            class="fa fa-shopping-cart"></i> {{ trans('language.cart_title') }}</a></li>
                            @guest
                                <li><a href="{{ route('login') }}"><i
                                                class="fa fa-lock"></i> {{ trans('language.login') }}</a></li>
                                @else
                                    <li><a href="{{ route('logout') }}" rel="nofollow" onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();"><i
                                                    class="fa fa-power-off"></i> {{ trans('language.logout') }}</a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                    @endguest

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{ route('home') }}" class="active">{{ trans('language.home') }}</a></li>
                            <li class="dropdown"><a href="#">{{ trans('language.shop') }}<i
                                            class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="{{ route('products') }}">{{ trans('language.all_product') }}</a></li>
                                    <li><a href="{{ route('compare') }}">{{ trans('language.compare') }}</a></li>
                                    <li><a href="{{ route('cart') }}">{{ trans('language.cart_title') }}</a></li>
                                    <li><a href="{{ route('login') }}">{{ trans('language.login') }}</a></li>
                                </ul>
                            </li>
                            @if (!empty($configs['News']))
                                <li><a href="{{ route('news') }}">{{ trans('language.blog') }}</a></li>
                            @endif

                            @if (!empty($configs['Content']))
                                <li class="dropdown"><a href="#">{{ trans('language.cms_category') }}<i
                                                class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @php
                                            $cmsCategories = (new \App\Modules\Cms\Models\CmsCategory)->where('status',1)->get();
                                        @endphp
                                        @foreach ($cmsCategories as $cmsCategory)
                                            <li><a href="{{ $cmsCategory->getUrl() }}">{{ $cmsCategory->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif

                            <li><a href="{{ route('pages',['key'=>'about']) }}">{{ trans('language.about') }}</a></li>
                            <li><a href="{{ route('contact') }}">{{ trans('language.contact') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <form id="searchbox" method="get" action="{{ route('search') }}">
                            <div class="input-group">
                                <input type="text" class="form-control"
                                       placeholder="{{ trans('language.search_form.keyword') }}..." name="keyword">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->

@yield('banner')


@if(Session::has('message'))
    <div class="alert alert-success">{!! Session::get('message') !!}</div>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger">{!! Session::get('error') !!}</div>
@endif

@if ($configs['site_status'])
    @yield('notice')
    <section>
        <div class="container">
            <div class="row">
                @yield('breadcrumb')
                @section('main')
                    <div class="col-sm-3">
                        <div class="left-sidebar">
                            <h2>{{ trans('language.category') }}</h2>
                            <div class="panel-group category-products" id="accordian">
                                <!--category-productsr-->
                                @foreach ($categories as $key =>  $category)
                                    @if (count($category->getChildrens($category->id))>0)
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordian"
                                                       href="#{{ $key }}">
                                                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                                        {{ $category->name }}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="{{ $key }}" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <ul>
                                                        @foreach ($category->getChildrens($category->id) as $cateChild)
                                                            <li>
                                                                <a href="{{ $cateChild->getUrl() }}">{{ $cateChild->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title"><a
                                                            href="{{ $category->getUrl() }}">{{ $category->name }}</a>
                                                </h4>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div><!--/category-products-->

                            <div class="brands_products"><!--brands_products-->
                                <h2>{{ trans('language.brands') }}</h2>
                                <div class="brands-name">
                                    <ul class="nav nav-pills nav-stacked">
                                        @foreach ($brands as $brand)
                                            <li><a href="{{ $brand->getUrl() }}"> <span
                                                            class="pull-right">({{ $brand->products()->count() }}
                                                        )</span>{{ $brand->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div><!--/brands_products-->

                            <div class="shipping text-center"><!--shipping-->
                                <img src="{{ asset($theme_asset.'/images/home/shipping.jpg') }}" alt=""/>
                            </div><!--/shipping-->

                        </div>
                    </div>
                @show

                <div class="col-sm-9 padding-right">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>

@else
    <section>
        <div class="container">
            <div class="row">
                <div id="columns" class="container" style="color:red;text-align: center;">
                    <img src="{{ asset('images/maintenance.png') }}"><br>
                    <h3><i class="fas fa-exclamation"></i>{{ trans('language.maintenance') }}</h3>
                    <!-- /.col -->
                </div>
            </div>
        </div>
    </section>
@endif

@isset ($layouts['footer'])
    @foreach ( $layouts['footer']  as $element)
        {!! $element->html !!}
    @endforeach
@endisset
<footer id="footer"><!--Footer-->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="companyinfo">
                        <h2>S-CART</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="{{ asset($theme_asset.'/images/home/iframe1.png') }}" alt=""/>
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="{{ asset($theme_asset.'/images/home/iframe2.png') }}" alt=""/>
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="{{ asset($theme_asset.'/images/home/iframe3.png') }}" alt=""/>
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="{{ asset($theme_asset.'/images/home/iframe4.png') }}" alt=""/>
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="address">
                        <img src="{{ asset($theme_asset.'/images/home/map.png') }}" alt=""/>
                        <p>{{ $configsGlobal['address'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="single-widget">
                        <h2>Service</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Online Help</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Order Status</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="single-widget">
                        <h2>Policies</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privecy Policy</a></li>
                            <li><a href="#">Refund Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="single-widget">
                        <h2>{{ trans('language.about') }}</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Address: {{ $configsGlobal['address'] }}</a></li>
                            <li><a href="#">Hotline: {{ $configsGlobal['long_phone'] }}</a></li>
                            <li><a href="#">Email: {{ $configsGlobal['email'] }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="single-widget">
                        <h2>{{ trans('language.subscribe.title') }}</h2>
                        <form action="{{ route('subscribe') }}" method="post" class="searchform">
                            @csrf

                            <input type="email" name="subscribe_email" required="required"
                                   placeholder="{{ trans('language.subscribe.subscribe_email') }}">
                            <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i>
                            </button>
                            <p>{{ trans('language.subscribe.subscribe_des') }}</p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2018 <a
                            href="{{ config('scart.homepage') }}">{{ config('scart.name') }} {{ config('scart.version') }}</a>
                    Inc. All rights reserved.</p>
                <p class="pull-right">Hosted by <span><a target="_blank"
                                                         href="http://giaiphap247.com">GiaiPhap247</a></span></p>
            </div>
        </div>
    </div>
</footer><!--/Footer-->


<script src="{{ asset($theme_asset.'/js/jquery.js')}}"></script>
<script src="{{ asset($theme_asset.'/js/jquery-ui.min.js')}}"></script>
<script src="{{ asset($theme_asset.'/js/bootstrap.min.js')}}"></script>
<script src="{{ asset($theme_asset.'/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{ asset($theme_asset.'/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{ asset($theme_asset.'/js/main.js')}}"></script>


@stack('scripts')

<script type="text/javascript">
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }

    $('#shipping').change(function () {
        $('#total').html(formatNumber(parseInt({{ Cart::subtotal() }}) + parseInt($('#shipping').val())));
    });
</script>

<script type="text/javascript">
    function addToCart(id, instance = null) {
        if (instance == null || instance == '') {
            var cart = $('.shopping-cart');
        } else {
            var cart = $('.shopping-' + instance);
        }
        var imgtodrag = $('.product-box-' + id).find("img").eq(0);
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                    top: imgtodrag.offset().top,
                    left: imgtodrag.offset().left
                })
                .css({
                    'opacity': '0.5',
                    'position': 'absolute',
                    'width': '150px',
                    'z-index': '99999999'
                })
                .appendTo($('body'))
                .animate({
                    'top': cart.offset().top,
                    'left': cart.offset().left,
                    'width': 75,
                    'height': 75
                }, 1000, 'easeInOutExpo');
            // setTimeout(function () {
            //     cart.effect("shake", {times: 2}, 200);
            // }, 1500);

            imgclone.animate({
                'width': 0,
                'height': 0
            }, function () {
                $(this).detach()
            });
        }

        $.ajax({
            url: '{{ route('addToCart') }}',
            type: 'POST',
            dataType: 'json',
            data: {id: id, instance: instance, _token: '{{ csrf_token() }}'},
            success: function (data) {
                console.log(data);
                error = parseInt(data.error);
                if (error === 0) {
                    setTimeout(function () {
                        if (data.instance == 'default') {
                            $('#count_cart').html(data.count_cart);
                            $('.actions').show();
                        } else {
                            $('#count_' + data.instance).html(data.count_cart);
                        }

                    }, 1000);
                } else {
                    // alert(data.error);
                }

            }
        });

    }

</script>
@isset ($layouts['bottom'])
    @foreach ( $layouts['bottom']  as $element)
        {!! $element->html !!}
    @endforeach
@endisset
</body>
</html>
