<div class="footer-block light-bg padding-top">
    <div class="container">
        <div class="footer_top">
            <div class="row">
                @if(!empty($postCat))
                <div class="col-md-6">
                    <div class="widget foot_menu">
                        <h4 class="fa-3">Our Categories</h4>
                        <ul class="category_list">
                            @foreach($postCat as $cat)
                                <li><a href="{{ route('frontend.category',$cat->slug) }}">{{$cat->name}}</a></li>
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
                @endif
                <div class="col-md-3 col-sm-6">
                    <div class="widget foot_menu">
                        <h4 class="fa-3">Company</h4>
                        <ul class="foot_nav">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">FAQS</a></li>
                            <li><a href="#">Wholesale</a></li>
                            <li><a href="#">Articles</a></li>
                            <li><a href="#">Conditions</a></li>
                            <li><a href="#">Return Policy</a></li>
                            <li><a href="#">Shipping</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="widget foot_address">
                        <h4 class="fa-3">Get In Touch</h4>
                        <ul class="addfess_list">
                            <li>Tridevi Marg, Thamel, Kathmandu, Nepal</li>
                            <li>Phone: <a href="callto:+977-01-4251400"> +977014251400</a></li>
                            <li>Email: <a href="mailto:info@ritualthanka.com"> info@ritualthanka.com</a></li>
                        </ul>
                        <ul class="foot_social">
                            <li><a href="https://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://www.pinterest.com"><i class="fa fa-pinterest"></i></a></li>
                            <li><a href="https://www.googleplus.com"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="https://www.facebook.com"><i class="fa fa-facebook"></i></a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="payment">
                        <ul>
                            <li>Accepted Payment : </li>
                            <li><img class="img-responsive" src="{{url('frontend/images/mastercard.png')}}" alt="Mastercard"></li>
                            <li><img class="img-responsive" src="{{url('frontend/images/visacard.png')}}" alt="Visacard"></li>
                            <li><img class="img-responsive" src="{{url('frontend/images/banktransfer.png')}}" alt="banktransfer"></li>
                            <li><img class="img-responsive" src="{{url('frontend/images/wiretransfer.png')}}" alt="wiretransfer"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom d-sm-flex justify-content-sm-between">
            <p>Copyright &copy; Ritual Thanka 2018</p>
            <a href="#">Powered by <img src="{{url('frontend/images/dac.png')}}" alt="DAC"> DAC</a>
        </div>
    </div>
</div>

<a href="#" class="scrollToTop" title="Back To Top" style="display: block;"><i class="fa fa-arrow-up"></i></a>