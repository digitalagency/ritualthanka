@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.option.orders.management'))

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
    <h1>
        {{ trans('labels.backend.option.orders.management') }}
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.option.orders.management') }}</h3>

        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="article-table" class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>{{ trans('labels.backend.option.orders.table.buyer') }}</th>
                        <th>{{ trans('labels.backend.option.orders.table.product') }}</th>
                        <th>{{ trans('labels.backend.option.orders.table.id') }}</th>
                        <th>{{ trans('labels.backend.option.orders.table.address') }}</th>
                        <th>{{ trans('labels.backend.option.orders.table.buyer_name') }}</th>
                        <th>{{ trans('labels.backend.option.orders.table.created_at') }}</th>
                        <th>{{ trans('labels.backend.option.orders.table.status') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($orders))
                        @forelse ($orders as $order)
                            <tr>
                                <td>
                                    <a href="/admin/orders/byuser/{{$order->user_id}}">
                                        {{$order->first_name.' '.$order->last_name}}
                                    </a>
                                </td>
                                <td>
                                    @foreach($order->cart->items as $item)
                                    <ul class="cartlist">
                                        <li><span>Item name :</span> {{$item['item']['title']}}</li>
                                        <li><span>Item Quantity:</span> {{$item['qty']}}</li>
                                        <li><span>Item Price:</span> $ {{$item['price']}}</li>
                                    </ul>
                                    @endforeach
                                    <div class="totalprice"> <span>Total Price:</span> $ {{$order->cart->totalPrice}}</div>
                                </td>
                                <td>{{$order->payment_id}}</td>
                                <td>{{$order->address}}</td>
                                <td>{{$order->name}}</td>
                                <td>
                                    <?php
                                    $date = strtotime($order->created_at);
                                    echo date('Y-m-d',$date);
                                    ?>
                                </td>
                                <td>
                                    <span class="orderdetail  {{$order->status}}">
                                        @if($order->status=='pending')
                                            Pending
                                        @elseif($order->status=='success')
                                            Success
                                        @elseif($order->status=='queue')
                                            On Queue
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <a href="/admin/orders/{{$order->id}}" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">No Orders available</td>
                            </tr>
                        @endforelse
                    @endif
                    </tbody>
                </table>
            </div>
        </div><!-- /.box-body -->
    </div>
@endsection