<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Session;
use App\Models\Post\Post;
use App\Models\Post\Postcat;
use App\Models\Post\Postmeta;
use App\Models\Cat_relation;
use App\Models\Exchange_rate;
use App\Models\Order;

use App\Models\Stock;
use App\Models\Cart;

use Stripe\Charge;
use Stripe\Stripe;

use Illuminate\Support\Facades\Auth;
use App\Models\Buyers_allocation;

class ProductController extends Controller
{
    //

    public function category($slug = ""){
        $catproducts = DB::table('posts')
            ->join('cat_relations', 'cat_relations.postid', '=', 'posts.id')
            ->join('postcats', 'postcats.id', '=', 'cat_relations.catid')
            ->where('postcats.slug', '=', $slug)
            ->select('posts.*')
            ->paginate(12);

        $category = Postcat::where('slug', $slug)->first();
        return view('frontend.productarchive')->with('category', $category)
                                              ->with('catproducts', $catproducts);

    }

    /*
     * single product page with brocade and handle
     *
     * related to the product
     *
     */

    public function product($slug = ""){
        $product = Post::where('clean_url', $slug)->first();

        $prodId = $product->id;

        $prodmeta = Postmeta::where('postid', $prodId)->get();

        $brodaces = Post::where('post_type', '=', 'brocade')->get();

        $handles = Post::where('post_type','handle')->get();

        $stocks = Stock::where('postid',$prodId)->get();
        $totalstock = 0;
        foreach($stocks as $stock)
        {
            $totalstock = $totalstock+$stock->in_stock;
        }
        //$totalstock;

        if($user = Auth::user()){
            $user->id;
            $allocation = Buyers_allocation::where('userid', $user->id)->first();
            return view('frontend.productsingle')->with('product',$product)
                                                ->with('prodmeta',$prodmeta)
                                                ->with('totalstock',$totalstock)
                                                ->with('brodaces',$brodaces)
                                                ->with('handles',$handles)
                                                ->with('allocation',$allocation);
        }
        return view('frontend.productsingle')->with('product',$product)
                                             ->with('prodmeta',$prodmeta)
                                             ->with('totalstock',$totalstock)
                                             ->with('brodaces',$brodaces)
                                             ->with('handles',$handles);
    }

    /*
     *
     * get all related articles for the product
     *
     * it is called from the single page itself
     *
     */
    public static function get_all_article($aid){
        $articles = Post::where('id',$aid)->get();
        $output = '';
        $output .= '<div class="dis_item">';
        foreach ($articles as $article){
           $output .= '<h6 class="fa-2">'.$article->title.'</h6>';
           $output .= $article->content;

        }
        $output .=' </div>';

        echo $output;
    }

    /*
     * location is where thankas are shown
     *
     * add location = single for single page only,
     *
     * for other pages add location = list
     */
    public static function getthankaprice($id,$location){
        $countrycode = 'US';
        $output = '';
        $editcat = Exchange_rate::where('country_code', $countrycode)->first();
        $prodprice = Postmeta::where('postid', $id)
                                ->where('meta_key', '=', 'price')
                                ->first();
        $rate = $editcat->rate;
        $stockcount = Stock::where('postid',$id)
                            ->count();
        $latestprice = Stock::where('postid',$id)
                            ->orderBy('bought_date', 'DESC')
                            ->first();


//        $orgfile = $prodprice->meta_value;
        if($user = Auth::user()){
            $user->id;
            if($user->id != 1){
                $allocation = Buyers_allocation::where('userid', $user->id)->first();
                $discount =  $allocation->allocation;
            }
            else{$discount = '';}
        }
        else{
            $discount = '';
        }
        if($stockcount>0){
            $orgfile = $latestprice->selling_price;
            if($location=='list'){
                $price = ($orgfile/$rate);
                $newprice = number_format((float)$price, 2, '.', '');
                $output = '<span> $'.$newprice.'</span>';

            }
            elseif($location=='single'){
                $price = ($orgfile/$rate);
                $newprice = number_format((float)$price, 2, '.', '');
                if($discount!=''){
                    $discprice =$newprice-($newprice*$discount/100);
                    $newdisc = number_format((float)$discprice, 2, '.', '');
                    $output.= '<em> $'.$newprice.'</em>';
                    $output.= '<span> $'.$newdisc.'</span>';
                    $output.= '<input type="hidden" id="price" data-orgprice="'.$discprice.'" name="price" value="'.$discprice.'">';
                }
                else{
                    $output .= '<span> $'.$newprice.'</span>';
                    $output.= '<input type="hidden" id="price" data-orgprice="'.$newprice.'" name="price" value="'.$newprice.'">';
                }
            }
        }
        else{
            $output = 'N/A';
        }

        echo $output;
    }


    /*
     * add to cart system
     */
    public function addtocart(Request $request){
        $product = Post::find($request->product_id);

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $product->price = $request['price'];
        $product->qty = $request['qty'];
        $product->brocade = $request['brocade'];
        $product->handle = $request['handle'];
        $cart->add($product,$product->id);
        //dd($cart);
        $request->session()->put('cart',$cart);

        return back();
    }

    public function viewCart(){
        if(!Session::has('cart')){
            return view('frontend.cartpage');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        //dd($oldCart);
        return view('frontend.cartpage',['products'=>$cart->items,'totalPrice'=>$cart->totalPrice]);
    }

    public function checkout(){

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('frontend.checkout',['total'=>$total]);

    }

    public function storecheckout(Request $request){
        if (!Session::has('cart')) {
            return redirect()->route('frontend.view-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $items = $cart->items;


        Stripe::setApiKey('sk_test_yagkVUrwvkXkEVIobNrn5Diw');
        try {
            $charge = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "usd",
                "source" => $request->input('stripeToken'), // obtained with Stripe.js
                "description" => "Test Charge"
            ));
            $order = new Order();
            $order->cart = serialize($cart);
            $order->address = $request->input('address');
            $order->name = $request->input('fullname');
            $order->payment_id = $charge->id;
            $order->status = 'pending';

            $this->reducestock($items);

            Auth::user()->orders()->save($order);

        } catch (\Exception $e) {
            //dd($e->getMessage());
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }
        echo 'success';

        Session::forget('cart');
        return redirect()->route('frontend.viewCart')->with('success', 'Successfully purchased products!');
    }

    public function brocadehandle(Request $request){
        $bid = $request->brocade;
        $hid = $request->handle;
        $price = $request->price;
        $output = '';
        $bprice = $hprice = 0;

        $countrycode = 'US';
        $output = '';
        $editcat = Exchange_rate::where('country_code', $countrycode)->first();
        $rate = $editcat->rate;


        if(!empty($bid)){
            $brodaces = Post::where('id',$bid)->first();
            $brocademeta = Postmeta::where('postid', $bid)->get();
            foreach($brocademeta as $bm){
                if($bm->meta_key=='price')
                   $bprice = $bm->meta_value/$rate;
            }
            $output .='<div style="background-image: url('.url($brodaces->image).')"></div>';
            //$output .= 'brocade = '.$brodaces->image;
        }

        if(!empty($hid)){
            $handles = Post::where('id',$hid)->first();
            $handlesmeta = Postmeta::where('postid', $hid)->get();
            foreach($handlesmeta as $hm){
                if($hm->meta_key=='price')
                    $hprice = $hm->meta_value/$rate;
            }

            $output .= ' handle='.$handles->image;
        }

        $totalPrice = $price+$bprice+$hprice;
        $totalPrice = number_format((float)$totalPrice, 2, '.', '');

        echo $totalPrice;
        echo $output;

    }


    public function orders(){
       // $orders = Auth::user()->orders;
        if($user = Auth::user()) {
           $id = $user->id;
        }else{
            $id = 0;
        }
        $orders = DB::table('orders')
            ->join('users','users.id','=','orders.user_id')
            ->where('users.id','=',$id)
            ->select('users.first_name','users.last_name','orders.*')
            ->orderBy('created_at', 'DESC')
            ->get();


        $orders->transform(function($order,$key){
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('frontend.vieworder')->with('orders',$orders);
    }

    public function getRemoveItem($id){
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);

        $cart->removeItem($id);

        Session::put('cart',$cart);
        return redirect()->route('frontend.viewCart');

    }


    public function featuredProduct(){

        $fthankas = DB::table('posts')
            ->join('postmetas','postmetas.postid','=','posts.id')
            ->where('postmetas.meta_key','=','feature_thanka')
            ->where('postmetas.meta_value','=',1)
            ->select('posts.*')
            ->orderBy('posts.id','ASC')
            ->paginate(12);

        return view('frontend.productfeatured')->with('title', 'Featured Thangkas')
                                                ->with('catproducts', $fthankas);

    }


    public function popularProduct(){

        $pthankas = DB::table('posts')
            ->join('postmetas','postmetas.postid','=','posts.id')
            ->where('postmetas.meta_key','=','popular_thanka')
            ->where('postmetas.meta_value','=',1)
            ->select('posts.*')
            ->orderBy('posts.id','ASC')
            ->paginate(12);

        return view('frontend.productfeatured')->with('title', 'Popular Thangkas')
                                                ->with('catproducts', $pthankas);

    }

    public function oldProduct(){

        $athankas = DB::table('posts')
            ->join('postmetas','postmetas.postid','=','posts.id')
            ->where('postmetas.meta_key','=','antique_thanka')
            ->where('postmetas.meta_value','=',1)
            ->select('posts.*')
            ->orderBy('posts.id','ASC')
            ->paginate(12);

        return view('frontend.productfeatured')->with('title', 'Old Thangkas')
            ->with('catproducts', $athankas);

    }

    public function saleProduct(){

        $onsales = DB::table('posts')
            ->join('postmetas','postmetas.postid','=','posts.id')
            ->where('postmetas.meta_key','=','on_sale')
            ->where('postmetas.meta_value','=',1)
            ->select('posts.*')
            ->orderBy('posts.id','ASC')
            ->paginate(12);

        return view('frontend.productfeatured')->with('title', 'On Sale')
                                ->with('catproducts', $onsales);

    }

    /*
     * to reduce stock after successful order placement
     *
     */
    public function reducestock($items){

        foreach($items as $key=>$item){
            $id = $key;
           echo $oqty  = $item['qty'];
           //echo $oqty  = 11;
            echo '<hr>';

               $stocks = Stock::where('postid',$id)->where('in_stock','!=',0)->get();
                $substock = $oqty;

                foreach($stocks as $stock){

                    $in_stock = $stock->in_stock;

                    if($in_stock>$substock){
                            $sub = $in_stock - $substock;
                        $sold_stock = $substock;
                            $substock = 0;

                        $instock = $sub;
                    }
                    if($in_stock<$substock){
                           $sub = $substock - $in_stock;
                           $substock = $sub;
                           $sold_stock = $in_stock;
                           $instock = 0;
                    }

                    echo '<br>sold stock ='.$sold_stock;
                    echo '<br>new in stock = '.$instock;

                    echo '<hr>';

                    $posts = Stock::where('id', $stock->id)->first();

                    $posts->in_stock = $instock;
                    $posts->sold_stock = $sold_stock;
                    $posts->update();

                }

        }

    }
}
