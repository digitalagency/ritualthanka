@extends('frontend.layouts.app')

@section('title', app_name() . ' | Checkout ')

@section('content')
    <section class="breadcrumb-block padding-top">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                    <li class="breadcrumb-item current-menu-item"><a href="">Checkout</a></li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="cartblock padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6 offset-md-4 offset-sm-3">
                    <h1>Checkout</h1>
                    <h4>Your Total: ${{$total}}</h4>

                    <div id="charge-error" role="alert" class="alert alert-danger {{!Session::has('error')?'hidden':''}}">
                        {{Session::has('error')}}
                    </div>

                    <form action="{{route('frontend.storecheckout')}}" method="post" id="checkout-form">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" id="fullname" name="fullname" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" id="address" name="address" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="card-name">Card Holder Name</label>
                                    <input type="text" id="card-name" name="card-name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="card-number">Credit Card Number</label>
                                    <input type="text" id="card-number" name="card-number" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12">
                                <div class="row">
                                    <div class="col-xs-6 col-md-6">
                                        <div class="form-group">
                                            <label for="card-expiry-month">Expiry Month</label>
                                            <input type="text" id="card-expiry-month" name="card-expiry-month" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-6">
                                        <div class="form-group">
                                            <label for="card-expiry-year">Expiry Year</label>
                                            <input type="text" id="card-expiry-year" name="card-expiry-year" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="card-number">CVC</label>
                                    <input type="text" id="cvc" name="cvc" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('after-scripts')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script>
        Stripe.setPublishableKey('pk_test_zME7Ov00FBVn01CcpHfI2PXR');


        var $form = $('#checkout-form');

        $form.submit(function(event) {
            $('#charge-error').addClass('hidden');
            $form.find('button').prop('disabled', true);
            Stripe.card.createToken({
                number: $('#card-number').val(),
                cvc: $('#card-cvc').val(),
                exp_month: $('#card-expiry-month').val(),
                exp_year: $('#card-expiry-year').val(),
                name: $('#card-name').val()
            }, stripeResponseHandler);
            return false;
        });

        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('#charge-error').removeClass('hidden');
                $('#charge-error').text(response.error.message);
                $form.find('button').prop('disabled', false);
            } else {
                var token = response.id;
                $form.append($('<input type="hidden" name="stripeToken" />').val(token));

                // Submit the form:
                $form.get(0).submit();
            }
        }
    </script>
@endsection