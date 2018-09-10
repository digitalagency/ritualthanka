@extends('frontend.layouts.app')

@section('title', app_name() . ' | View Cart ')

@section('content')
    <section class="breadcrumb-block padding-top">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                    <li class="breadcrumb-item current-menu-item"><a href="">View Cart</a></li>
                </ol>
            </nav>
        </div>
    </section>


    <section class="cartblock padding">
        <div class="container">
            @if(Session::has('success'))
                <div class="row">
                    <div class="col-sm-6 col-md-12 col-md-offset-4 col-sm-offset-3">
                        <div id="charge-message" class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-list">
                            <thead>
                            <tr>
                                <th class="product-pic">Product</th>
                                <th>Product Name</th>
                                <th>Unit Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(Session::has('cart'))
                                @forelse($products as $product)
                                    <tr>
                                        <td class="product-pic"><img src="{{URL::to($product['item']['image'])}}" class="img-responsive"></td>
                                        <td>{{$product['item']['title']}}</td>
                                        <td>{{number_format((float)$product['item']['price'], 2, '.', '')}}</td>
                                        <td class="product-details">
                                            {{$product['item']['qty']}}
                                           {{-- <div class="quantity">
                                                <input type="number" min="1" max="9" step="1" value="{{$product['item']['qty']}}"><div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>
                                            </div>--}}
                                        </td>
                                        <td>{{$product['price']}}</td>
                                        <td class="product-remove">
                                            <a href="{{route('frontend.getRemoveItem',['id'=>$product['item']['id']])}}" title="Remove this item"><i class="fa fa-close"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No Items added</td>
                                    </tr>
                                @endforelse
                            @else
                                <tr>
                                    <td colspan="7">No Items Added</td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="continue d-flex justify-content-between">
                        <a class="con-tinue" href="#">Continue Shoping</a>
                        <div class="continue-left d-flex">
                            <a href="#" class="c_art">Clear Shoping Cart</a>
                            <form class="cart-update">
                                <button type="submit" class="button update-btn">Update cart</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- table-cart-total -->
                <div class="col-sm-6 ml-auto cart-totals">
                    <div class="table-cart features-title">
                        <h2>Cart Totals</h2>
                        <table class="table table-bordered">
                            <tr>
                                <th>Subtotal</th>
                                <td>
                                    @if(Session::has('cart') && (Session::get('cart')->totalQty != 0))
                                        $ {{$totalPrice}}
                                    @else
                                        $0
                                    @endif
                                </td>
                            </tr>
                            {{--<tr>
                                <th>Taxable Amount 13%</th>
                                <td>259.74 $</td>
                            </tr>
                            <tr class="total-order">
                                <th>Order Total</th>
                                <td>2257.74 $</td>
                            </tr>--}}
                        </table>
                        <div class="proceed clearfix">
                            <a href="{{route('frontend.checkout')}}" class="btn btn-primary">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection