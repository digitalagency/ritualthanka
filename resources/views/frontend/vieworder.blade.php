@extends('frontend.layouts.app')

@section('title', app_name() . ' | My Orders')

@section('meta_description', ' Ritual Thanka, Product, Category')
@section('meta_author', 'Ritual Thanka, Product, Category')

@section('content')
    <section class="breadcrumb-block padding-top">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                    <li class="breadcrumb-item current-menu-item"><a href="{{ url("/orders/") }}">My Orders</a></li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="padding orderpage">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @forelse($orders as $order)

                        <div class="panel panel-default orderlist">

                                <div class="panel-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">Order Date:
                                            <span class="orderdetail">
                                                 <?php
                                                    $date = strtotime($order->created_at);
                                                ?>
                                                {{date('Y-m-d',$date)}}
                                            </span>

                                        </li>
                                        <li class="list-group-item">Payment ID:
                                            <span class="orderdetail">
                                                {{$order->payment_id}}
                                            </span>

                                        </li>
                                        <li class="list-group-item">Status:
                                            <span class="orderdetail orderstatus {{$order->status}}">
                                                @if($order->status=='pending')
                                                    Pending
                                                @elseif($order->status=='success')
                                                    Success
                                                @elseif($order->status=='queue')
                                                    On Queue
                                                @endif
                                            </span>

                                        </li>
                                    </ul>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-list">
                                        <thead>
                                        <tr>
                                            <th width="60%">Product Name</th>
                                            <th width="20%">Quantity</th>
                                            <th width="20%">Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order->cart->items as $item)
                                            <tr>
                                                <td>{{$item['item']['title']}}</td>

                                                <td>{{$item['qty']}}</td>
                                                <td>$ {{$item['price']}}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2">Total Price:</td>
                                            <td>$ {{$order->cart->totalPrice}}</td>
                                        </tr>
                                        </tbody>

                                    </table>
                                </div>


                        </div>
                    @empty
                        <div class="panel panel-default orderlist">
                            No Order Made
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
