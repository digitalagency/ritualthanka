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
        </div>
        <div class="box-body">
            {{ Form::open(['route' => 'admin.orders.ordersedit', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}

            <input type="hidden" name="orderid" value="{{$orders->id}}">

            <div class="form-group">
                {{ Form::label('buyer', trans('labels.backend.option.orders.table.buyer'), ['class' => 'col-lg-2 lft-align control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('buyer', $buyer->first_name.' '.$buyer->last_name, ['class' => 'form-control', 'disabled'=>'disabled', 'placeholder' => trans('validation.attributes.backend.access.article.title')]) }}
                </div>
                <!--col-lg-10-->
            </div>
            <!--form control-->

            <div class="form-group">
                {{ Form::label('payment_id', trans('labels.backend.option.orders.table.id'), ['class' => 'col-lg-2 lft-align control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('payment_id', $orders->payment_id, ['class' => 'form-control', 'disabled'=>'disabled', 'placeholder' => trans('validation.attributes.backend.access.article.title')]) }}
                </div>
                <!--col-lg-10-->
            </div>
            <!--form control-->

            <div class="form-group">
                {{ Form::label('cart', trans('labels.backend.option.orders.table.product'), ['class' => 'col-lg-2 lft-align control-label']) }}

                <div class="col-lg-10">
                    <?php
                        $carts = unserialize($orders->cart);

                        $cartitems = $carts->items;
                        foreach($cartitems as $ci)
                            {?>
                                <ul class="cartlist">
                                    <li><span>Item name :</span> {{$ci['item']['title']}}</li>
                                    <li><span>Item Quantity:</span> {{$ci['qty']}}</li>
                                    <li><span>Item Price:</span> $ {{$ci['price']}}</li>
                                </ul>
                            <?php }
                            echo '<ul class="cartlist">
                                        <li><span>Total Qtuantity:</span> '.$carts->totalQty.'</li>
                                        <li><span>Total Price:</span> $ '.$carts->totalPrice.'</li>
                                  </ul>';

                    ?>

                </div>
                <!--col-lg-10-->
            </div>
            <!--form control-->

            <div class="form-group">
                {{ Form::label('address', trans('labels.backend.option.orders.table.address'), ['class' => 'col-lg-2 lft-align control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('address', $orders->address, ['class' => 'form-control', 'disabled'=>'disabled', 'placeholder' => trans('validation.attributes.backend.access.article.title')]) }}
                </div>
                <!--col-lg-10-->
            </div>
            <!--form control-->

            <div class="form-group">
                {{ Form::label('buyer_name', trans('labels.backend.option.orders.table.buyer_name'), ['class' => 'col-lg-2 lft-align control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('buyer_name', $orders->name, ['class' => 'form-control', 'disabled'=>'disabled', 'placeholder' => trans('validation.attributes.backend.access.article.title')]) }}
                </div>
                <!--col-lg-10-->
            </div>
            <!--form control-->

            <div class="form-group">
                {{ Form::label('created_at', trans('labels.backend.option.orders.table.created_at'), ['class' => 'col-lg-2 lft-align control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('created_at', $orders->created_at, ['class' => 'form-control', 'disabled'=>'disabled', 'placeholder' => trans('validation.attributes.backend.access.article.title')]) }}
                </div>
                <!--col-lg-10-->
            </div>
            <!--form control-->
            <div class="form-group">
                {{ Form::label('status', trans('labels.backend.option.orders.table.status'), ['class' => 'col-lg-2 lft-align control-label']) }}

                <div class="col-lg-10">

                    <select name="status" id="status" class="form-control">
                        <option value="pending" @if($orders->status=='pending') selected @endif>Pending</option>
                        <option value="success" @if($orders->status=='success') selected @endif>Success</option>
                        <option value="queue" @if($orders->status=='queue') selected @endif>On Queue</option>
                    </select>
                </div>
                <!--col-lg-10-->
            </div>
            <!--form control-->

            <div class="pull-right">
                {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success']) }}
            </div>

            {{ Form::close() }}
        </div>
    </div>
@endsection