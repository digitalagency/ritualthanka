<header class="site-header fixed-top" id="header">
    <div class="top_menu widget_links">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-3 mobile_device">
                    <ul class="social">
                        <li>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-facebook-f"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 mobile_device">
                    <ul class="menu_contact">
                        <li class="contact">
                            <a href="callto:01 4322343"><i class="fa fa-phone"></i> <p>01 4322343</p></a>
                        </li>
                        <li class="contact">
                            <a href="mailto:info@thankaritual.com"><i class="fa fa-envelope"></i> <p>info@thankaritual.com</p></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-4 mobile_device ml-auto">
                    <ul class="userlanguage d-flex justify-content-end">
                        <div class="user">
                            <i class="fa fa-user"></i>
                            <ul class="user_setting">
                                @if (!$logged_in_user)
                                    <li><a href="{{ route('frontend.auth.login') }}">{{trans('navs.frontend.login')}}</a></li>
                                    @if (config('access.users.registration'))
                                        <li><a href="{{ route('frontend.auth.register') }}">{{trans('navs.frontend.register')}}</a></li>
                                    @endif

                                @else
                                    {{--<li><a href="">{{ $logged_in_user->name }}</a></li>--}}
                                    <li><a href="{{ route('frontend.user.dashboard') }}">{{trans('navs.frontend.dashboard')}}</a></li>
                                    <li><a href="{{ route('frontend.user.account') }}">{{trans('navs.frontend.user.account')}}</a></li>
                                    <li><a href="{{ route('frontend.auth.logout')}}">{{trans('navs.general.logout')}}</a></li>

                                    <li><a href="{{route('frontend.viewCart')}}">view Cart</a></li>
                                    <li><a href="{{route('frontend.checkout')}}">Checkout</a></li>

                                    {{--<li><a href="">Wishlist</a></li>--}}
                                    <li><a href="{{route('frontend.orders')}}">My Orders</a></li>
                                @endif



                            </ul>
                        </div>
                        <div class="language">
                            <select class="form-control" placeholder="Your Tour Package" required="">
                                <option>Select Language</option>
                                <option>English</option>
                                <option>Nepali</option>
                                <option>Japan</option>
                            </select>
                            <img src="{{url('frontend/images/googleicon.png')}}" alt="Googleion">
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <nav class="navbar navbar-expand-md main-menu">
            <div class="brand-logo">
                <a class="navbar-brand" href="{{ route('frontend.index') }}"><img class="img-responsive" srcset="{{url('frontend/images/logo.png')}}"></a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <div class="navbar-collapse collapse ml-auto flex-column" id="navbarsExampleDefault" style="">
                <form action="">
                    <div class="serch_form">
                        <input type="text" name="search" class="form-control" placeholder="Search Thankas ...." required="">
                        <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </div>
                </form>
                <ul class="navbar-nav">
                    @if(!empty($postCat))
                        <li class="menu-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Thangka Catagories</a>
                            <ul class="dropdown-menu">
                                <li class="menu-item">
                                    <div class="row">
                                        @foreach($postCat as $cat)
                                            <div class="col-lg-3 col-md-4 no-padding">
                                                <div class="media">
                                                    <img class="mr-3" src="{{ URL::to($cat->image) }}" alt="{{$cat->name}}" style="width:89px;height:65px; object-fit:cover" onclick="gotopage('{{ route('frontend.category',$cat->slug) }}')">
                                                    <div class="media-body">
                                                        <a href="{{ route('frontend.category',$cat->slug) }}"><h5 class="mt-0">{{$cat->name}}</h5></a>
                                                        <p>{{$cat->description}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                         @endforeach
                                    </div>
                                </li>
                            </ul>
                        </li>
                    @endif

                    <li class="menu-item current-menu-item">
                        <a class="nav-link" href="#">Shipping</a>
                    </li>
                    <li class="menu-item">
                        <a class="nav-link" href="#">Payments</a>
                    </li>
                    <li class="menu-item">
                        <a class="nav-link" href="{{ route('frontend.about') }}">About Us</a>
                    </li>
                    <li class="menu-item">
                        <a class="nav-link" href="{{ route('frontend.contact') }}">Contact Us</a>
                    </li>

                    <li class="menu-item dropdown cart">
                        @if(Session::has('cart')&& (Session::get('cart')->totalQty != 0))
                            <span class="item_number">{{Session::get('cart')->totalQty}}</span>
                        @endif

                        <a href="javascript:void(0)" class="nav-link dropdown-toggle">
                            <i class="fa fa-cart-arrow-down"></i>
                            @if(Session::has('cart') && (Session::get('cart')->totalQty != 0))
                                ${{Session::get('cart')->totalPrice}}
                            @endif
                        </a>
                        <div class="cart-header">
                            <div class="mini-cart-container">
                                <div class="body-cart">
                                    <ul class="clear-all">

                                            @if(Session::has('cart'))
                                                @foreach($cartLists as $cartlist)
                                                        <li class="clear-all">
                                                            <div class="cart-item clear-all">
                                                                <img src="{{URL::to($cartlist['item']['image'])}}" alt="{{$cartlist['item']['title']}}">
                                                                <div class="name">
                                                                    <a href="{{ route('frontend.product',$cartlist['item']['clean_url']) }}">{{$cartlist['item']['title']}}</a>
                                                                    <span>{{$cartlist['item']['qty']}} X ${{$cartlist['price']}}</span>
                                                                </div>
                                                                <a href="{{route('frontend.getRemoveItem',['id'=>$cartlist['item']['id']])}}" class="remove-product " title="Remove this item">x</a>
                                                            </div>
                                                        </li>
                                                 @endforeach
                                            @else
                                                <li class="clear-all">No Items Added</li>
                                            @endif


                                    </ul>
                                </div>
                                <div class="footer-cart clear-all">
                                    @if(Session::has('cart'))
                                        <p><strong>Total: </strong> <span class="header-cart-total">$
                                                @if( (Session::get('cart')->totalQty != 0))
                                                    {{Session::get('cart')->totalPrice}}
                                                @else
                                                    0
                                                @endif
                                            </span> <span>USD</span></p>
                                    @endif

                                    <div class="d-flex justify-content-between">
                                        <a href="{{route('frontend.viewCart')}}" class="btn btn-primary">view cart</a>
                                        <a href="{{route('frontend.checkout')}}" class="btn btn-secondary">checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>

<div class="header_height"></div>