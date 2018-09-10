@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.product.management'))

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
    <h1>
        {{ trans('labels.backend.product.management') }}
        <small>Stock Management</small>
    </h1>
@endsection

@section('content')
    <div class="content-wrap">
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $productDetail->title }}</h3>
                    </div>
                    <!-- /.box-header -->


                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="article-table" class="table table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Original Stock</th>
                                        <th>In Stock</th>
                                        <th>Sold Stock</th>
                                        <th>Cost Price</th>
                                        <th>Selling Price</th>
                                        <th>Bought Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(!empty($stocks))
                                    <?php $i = 1;
                                    $org_stock = 0;
                                    $in_stock = 0;
                                    $sold_stock = 0;
                                    ?>
                                    @forelse ($stocks as $stock)
                                        <?php
                                            $org_stock = $org_stock+$stock->org_stock;
                                            $in_stock = $in_stock+$stock->in_stock;
                                            $sold_stock = $sold_stock+$stock->sold_stock;
                                        ?>
                                        <tr>
                                            <td>{!! $i !!}</td>
                                            <td>{!! $stock->org_stock !!}</td>
                                            <td>{!! $stock->in_stock !!}</td>
                                            <td>{!! $stock->sold_stock !!}</td>
                                            <td>{!! $stock->cost_price !!}</td>
                                            <td>{!! $stock->selling_price !!}</td>
                                            <td>{!! $stock->bought_date !!}</td>
                                        </tr>
                                        <?php $i++;?>
                                    @empty
                                        <tr>
                                            <td colspan="4">Stocks not available</td>
                                        </tr>
                                    @endforelse
                                    <tr>
                                        <td>Total</td>
                                        <td>{!! $org_stock !!}</td>
                                        <td>{!! $in_stock !!}</td>
                                        <td>{!! $sold_stock !!}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                {{ Form::open(['route' => 'admin.product.stockstore', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}
                    <div class="box box-success">
                        <div class="box-header with-border">
                                <h3 class="box-title">Add Stocks for:  {!! $productDetail->title  !!}</h3>
                        </div>

                        <div class="box-body">
                            <input type="hidden" name="postid" value="{{ $productDetail->id }}">


                            <div class="form-group">
                                {{ Form::label('org_stock', 'Stock', ['class' => 'col-lg-12 lft-align control-label']) }}

                                <div class="col-lg-12">
                                    {{ Form::number('org_stock', '' , ['class' => 'form-control', 'min' => '0', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Stock']) }}
                                </div>
                                <!--col-lg-12-->
                            </div>

                            <div class="form-group">
                                {{ Form::label('cost_price', 'Cost Price', ['class' => 'col-lg-12 lft-align control-label']) }}

                                <div class="col-lg-12">
                                    {{ Form::number('cost_price', '' , ['class' => 'form-control', 'min' => '0', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Cost Price']) }}
                                </div>
                                <!--col-lg-12-->
                            </div>

                            <div class="form-group">
                                {{ Form::label('selling_price', 'Selling Price', ['class' => 'col-lg-12 lft-align control-label']) }}

                                <div class="col-lg-12">
                                    {{ Form::number('selling_price', '' , ['class' => 'form-control', 'min' => '0', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Selling Price']) }}
                                </div>
                                <!--col-lg-12-->
                            </div>

                            <div class="form-group">
                                {{ Form::label('bought_date', 'Bought Date', ['class' => 'col-lg-12 lft-align control-label']) }}

                                <div class="col-lg-12">
                                    {{ Form::text('bought_date', '' , ['class' => 'form-control', 'id'=>'bought_date', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Bought Date']) }}
                                </div>
                                <!--col-lg-12-->
                            </div>

                            <div class="box-footer">
                                <div class="pull-right">

                                        {{ Form::submit('Add Stock', ['class' => 'btn btn-success']) }}


                                </div>
                            </div>

                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection

