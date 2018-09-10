<?php

namespace App\Http\Controllers\Backend\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\Post\PostCatController;
use Illuminate\Support\Facades\DB;

use App\Models\Post\Post;
use App\Models\Post\Postcat;
use App\Models\Post\Postmeta;
use App\Models\Cat_relation;
use App\Models\Exchange_rate;
use App\Models\Stock;
use App\Models\Order;

use App\Models\Access\Role\Role;
use App\Models\Access\User\User;
use App\Models\Buyers_allocation;


class PostController extends Controller
{

    /*
     * post category list and add form
     */
    public function category($id=''){
        $postcat = Postcat::where('type', '=', 'category')
                                ->orderBy('id', 'ASC')->get();

        if($id!="")
        {
            $editcat = Postcat::where('id', $id)->first();
            return view('backend.products.add-category')->with('postcat', $postcat)
                                                        ->with('editcat', $editcat)
                                                        ->with('categoryType', 'category');
        }


        return view('backend.products.add-category')->with('postcat', $postcat)
                                    ->with('categoryType', 'category');
    }

    /*
     * store and update the product category
     */
    public function catstore(Request $request){


        if($request['catid']!="")
            $postcat = Postcat::where('id', $request['catid'])->first();
        else
        $postcat = new Postcat;

        $postcat->name = $request['title'];
        $postcat->slug = $request['slug'];
        $postcat->parent = $request['subcat'];
        if(!empty($request['categoryType']))
            $postcat->type = $request['categoryType'];
        else
        $postcat->type = 'category';
        $postcat->description = $request['description'];
        $postcat->image = $request['image'];

        //dd($postcat);
        if($request['catid']!="")
        {
            $postcat->update();
            return redirect('/admin/product/category/'.$request['catid'])->withFlashSuccess(__('alerts.backend.category.updated'));
        }
        else{
            $postcat->save();
            return redirect('/admin/product/category')->withFlashSuccess(__('alerts.backend.category.created'));
        }

    }

    /*
     * delete the category and
     * child category
     */
    public function catdestroy($id)
    {
        //dd($id);
        Postcat::where('parent',$id)->delete();
        Postcat::where('id',$id)->delete();
        return redirect('/admin/product/category')->withFlashSuccess(__('alerts.backend.category.deleted'));
    }

    /*
     * Product list
     */

    public function prodIndex(){
        $products = Post::where('post_type','product')->get();
        return view('backend.products.list-product',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function prodCreate(){
        $catCtrl = new PostCatController();
        $ddlCat  = $catCtrl->getCategoryList('category','li');
        $articles = Post::where('post_type','article')->get();
        $pc = 'new';
        return view('backend.products.prod-create')->with('ddlCat', $ddlCat)
                                                    ->with('articles', $articles)
                                                    ->with('pc',$pc);
    }

    public function storeProduct(Request $request){
        //dd($request);
        //for post

        $user = Auth::user();

        if($request['postid']!=""){
            $posts = Post::where('id', $request['postid'])->first();
            if (Post::where('title', '=', $request['title'])->where('post_type', '=', 'product')->where('id', '!=', $request['postid'])->exists()) {
                return back()->withFlashDanger(__('alerts.backend.page.existed'));
            }
        }
        else{
            $posts = new Post();
            if (Post::where('title', '=', $request['title'])->where('post_type', '=', 'product')->exists()) {
                return back()->withFlashDanger(__('alerts.backend.page.existed'));
            }
        }


        $posts->userid = $user->id;
        $posts->title = $request['title'];
        $posts->name = $request['title'];
        $posts->clean_url = $request['slug'];

        if($request['description']!="")
            $posts->content = $request['description'];
        if($request['excerpt']!="")
            $posts->excerpt = $request['excerpt'];

        $posts->status = $request['status'];
        $posts->image = $request['image'];
        $posts->post_type = $request['post_type'];


        if($request['postid']!="")
            $posts->update();
        else
        $posts->save();

        //for meta values
        $optNameList = explode(",", $request['optionNumber']);
        $optionNames = $request['optName'];
        $options=array();
        $icount = 0;

        foreach($optNameList as $onl)
        {
            $options[] = array('name' => $optionNames[$icount],
                                'options' => $request['optValue'.$onl],
                                'prices' => $request['optPrice'.$onl]);
            $icount++;
        }

        //for stock
        if($request['pc']=='new'){
            $stock = new Stock;

            $stock->postid = $posts->id;
            $stock->org_stock = $request['org_stock'];
            $stock->in_stock = $request['org_stock'];
            $stock->sold_stock = 0;
            $stock->cost_price = $request['cost_price'];
            $stock->selling_price = $request['selling_price'];
            $stock->bought_date = $request['bought_date'];

            $stock->save();
        }


        if(!empty($request['category']))
            $this->addCategoryRelation($request['category'], $posts->id);

        $this->addAttributes('options', serialize($options), $posts->id);
        $this->addAttributes('code', $request['code'], $posts->id);
        $this->addAttributes('weight', $request['weight'], $posts->id);
        $this->addAttributes('size', $request['size'], $posts->id);
        $this->addAttributes('material', $request['material'], $posts->id);
        $this->addAttributes('price', $request['price'], $posts->id);
        $this->addAttributes('keywords', $request['keywords'], $posts->id);
        $this->addAttributes('metadesc', $request['metadesc'], $posts->id);
        $this->addAttributes('related_article',serialize($request['related_article']), $posts->id);

        //display options
        $this->addAttributes('antique_thanka',$request['antique_thanka'], $posts->id);
        $this->addAttributes('popular_thanka',$request['popular_thanka'], $posts->id);
        $this->addAttributes('feature_thanka',$request['feature_thanka'], $posts->id);
        $this->addAttributes('on_sale',$request['on_sale'], $posts->id);
        //display options

        if($request['imagespath']!="")
            $this->addAttributes('images', serialize($request['imagespath']), $posts->id);

        if($request['postid']!="")
            return back()->withFlashSuccess(__('alerts.backend.product.updated'));
        else
            return redirect('/admin/product')->withFlashSuccess(__('alerts.backend.product.created'));
    }


    /*
     * Edit the product
     */
    public function editProduct($id){
        $sel=array();
        $catCtrl = new PostCatController();
        //$postcat = Postcat::where('parent','=', '0')->orderBy('catorder', 'ASC')->get();
        $post = Post::where('id', $id)->first();
        $postmeta = Postmeta::where('postid', $id)->get();
        $catrel = Cat_relation::where('postid','=', $id)->get();

        if($catrel->isNotEmpty())
        {
            foreach($catrel as $cr)
            {
                $sel[]=$cr->catid;
            }
        }

        $ddlCat = $catCtrl->getCategoryList('category','li', $sel);
        $articles = Post::where('post_type','article')->get();
        $pc = 'edit';
        //echo $categories;exit;
        return view('backend.products.prod-create')->with('post', $post)
                                                    ->with('articles', $articles)
                                                    ->with('postmeta', $postmeta)
                                                    ->with('pc',$pc)
                                                    ->with('ddlCat', $ddlCat);
    }

    /*
     * Delete Product, meta values and category relationships
     */
    public function deleteProduct($id){
        //dd($id);
        Postmeta::where('postid', $id)->delete();
        Cat_relation::where('postid', $id)->delete();
        Post::destroy($id);

        return redirect('/admin/product')->withFlashSuccess(__('alerts.backend.product.deleted'));
    }

    /*
     * to insert meta key and meta values for post
     */
    public function addAttributes($metaKey, $metaValue, $postid)
    {
        if($metaValue=="")
            $metaValue="";
        //{
        $hasAtt = Postmeta::where('postid', $postid)
            ->where('meta_key', '=', $metaKey)->first();
        if(!empty($hasAtt))
            $postMeta = Postmeta::where('postid', $postid)
                ->where('meta_key', '=', $metaKey)->first();
        else
            $postMeta = new Postmeta();
        $postMeta->postid = $postid;
        $postMeta->meta_key = $metaKey;
        $postMeta->meta_value = $metaValue;
        if(!empty($hasAtt))
            $postMeta->update();
        else
            $postMeta->save();


    }


    /*
     * to insert categories' relation with post
     */
    public function addCategoryRelation($categories, $postid)
    {
        //print_r($categories);exit;
        if(!empty($categories))
        {
            $cr = new Cat_relation();
            $cr->where('postid', $postid)->delete();

            foreach($categories as $c)
            {
                $crs = new Cat_relation();
                $crs->postid = $postid;
                $crs->catid = $c;
                $crs->save();
            }
        }
    }


    /*
     * for post category
     */
    public function postcat($id=''){
        $postcat = Postcat::where('type', '=', 'post_category')
                            ->orderBy('id', 'ASC')->get();

        if($id!="")
        {
            $editcat = Postcat::where('id', $id)->first();
            return view('backend.posts.add-category')->with('postcat', $postcat)
                                                        ->with('editcat', $editcat)
                                                        ->with('categoryType', 'post_category');
        }


        return view('backend.posts.add-category')->with('postcat', $postcat)
                                                    ->with('categoryType', 'post_category');
    }

    /*
     * store and update the post category
     */
    public function postcatstore(Request $request){


        if($request['catid']!="")
            $postcat = Postcat::where('id', $request['catid'])->first();
        else
            $postcat = new Postcat;

        $postcat->name = $request['title'];
        $postcat->slug = $request['slug'];
        $postcat->parent = $request['subcat'];
        if(!empty($request['categoryType']))
            $postcat->type = $request['categoryType'];
        else
            $postcat->type = 'post_category';
        $postcat->image = $request['image'];

        //dd($postcat);
        if($request['catid']!="")
        {
            $postcat->update();
            return redirect('/admin/post/category/'.$request['catid'])->withFlashSuccess(__('alerts.backend.category.updated'));
        }
        else{
            $postcat->save();
            return redirect('/admin/post/category')->withFlashSuccess(__('alerts.backend.category.created'));
        }

    }

    /*
     * delete the Post category and
     * child category
     */
    public function postcatdestroy($id)
    {
        //dd($id);
        Postcat::where('parent',$id)->delete();
        Postcat::where('id',$id)->delete();
        return redirect('/admin/post/category')->withFlashSuccess(__('alerts.backend.category.deleted'));
    }


    /*
     * Post list
     */

    public function postIndex(){
        $posts = Post::where('post_type','posts')->get();
        return view('backend.posts.list-post',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCreate(){
        $catCtrl = new PostCatController();
        $ddlCat  = $catCtrl->getCategoryList('post_category','li');

        return view('backend.posts.post-create')->with('ddlCat', $ddlCat);
    }
    /*
     * store post
     */
    public function storePost(Request $request){
        //dd($request);
        //for post

        $user = Auth::user();

        if($request['postid']!=""){
            $posts = Post::where('id', $request['postid'])->first();
            if (Post::where('title', '=', $request['title'])->where('post_type', '=', 'posts')->where('id', '!=', $request['postid'])->exists()) {
                return back()->withFlashDanger(__('alerts.backend.page.existed'));
            }
        }
        else{
            $posts = new Post();
            if (Post::where('title', '=', $request['title'])->where('post_type', '=', 'posts')->exists()) {
                return back()->withFlashDanger(__('alerts.backend.page.existed'));
            }
        }


        $posts->userid = $user->id;
        $posts->title = $request['title'];
        $posts->name = $request['title'];
        $posts->clean_url = $request['slug'];

        if($request['description']!="")
            $posts->content = $request['description'];
        if($request['excerpt']!="")
            $posts->excerpt = $request['excerpt'];

        $posts->status = $request['status'];
        $posts->image = $request['image'];
        $posts->post_type = $request['post_type'];


        if($request['postid']!="")
            $posts->update();
        else
            $posts->save();

        //for meta values


        if(!empty($request['category']))
            $this->addCategoryRelation($request['category'], $posts->id);


        $this->addAttributes('keywords', $request['keywords'], $posts->id);
        $this->addAttributes('metadesc', $request['metadesc'], $posts->id);

        if($request['imagespath']!="")
            $this->addAttributes('images', serialize($request['imagespath']), $posts->id);

        if($request['postid']!="")
            return back()->withFlashSuccess(__('alerts.backend.product.updated'));
        else
            return redirect('/admin/post')->withFlashSuccess(__('alerts.backend.product.created'));
    }



    /*
     * Edit the post
     */
    public function editPost($id){
        $sel=array();
        $catCtrl = new PostCatController();
        //$postcat = Postcat::where('parent','=', '0')->orderBy('catorder', 'ASC')->get();
        $post = Post::where('id', $id)->first();
        $postmeta = Postmeta::where('postid', $id)->get();
        $catrel = Cat_relation::where('postid','=', $id)->get();

        if($catrel->isNotEmpty())
        {
            foreach($catrel as $cr)
            {
                $sel[]=$cr->catid;
            }
        }

        $ddlCat = $catCtrl->getCategoryList('post_category','li', $sel);

        //echo $categories;exit;
        return view('backend.posts.post-create')->with('post', $post)
                                                ->with('postmeta', $postmeta)
                                                ->with('ddlCat', $ddlCat);
    }

    /*
     * Delete post, meta values and category relationships
     */
    public function deletePost($id){
        //dd($id);
        Postmeta::where('postid', $id)->delete();
        Cat_relation::where('postid', $id)->delete();
        Post::destroy($id);

        return redirect('/admin/post')->withFlashSuccess(__('alerts.backend.post.deleted'));
    }



    /*
     * post category list and add form
     */
    public function exchange($id=''){

        $postcat = Exchange_rate::all();

        if($id!="")
        {
            $editcat = Exchange_rate::where('id', $id)->first();
            return view('backend.options.exchange-rate')->with('postcat', $postcat)
                                    ->with('editcat', $editcat);

        }

        return view('backend.options.exchange-rate')->with('postcat', $postcat)
                                     ->with('categoryType', 'category');
    }

    /*
     * Store exchange rate
     */
    public function ratestore(Request $request){

        //dd($request);
        if($request['countryid']!="")
            $postcat = Exchange_rate::where('id', $request['countryid'])->first();


        $postcat->rate = $request['rate'];

        //dd($postcat);
        if($request['countryid']!="")
        {
            $postcat->update();
            return redirect('/admin/exchange/'.$request['countryid'])->withFlashSuccess(__('alerts.backend.category.updated'));
        }
    }


    /*
     * Banner section start
     */
    public function bannercat($id=''){
        $postcat = Postcat::where('type', '=', 'banner_category')
                                ->orderBy('id', 'ASC')->get();

        if($id!="")
        {
            $editcat = Postcat::where('id', $id)->first();
            return view('backend.banner.add-category')->with('postcat', $postcat)
                ->with('editcat', $editcat)
                ->with('categoryType', 'banner_category');
        }
        return view('backend.banner.add-category')->with('postcat', $postcat)
                            ->with('categoryType', 'banner_category');
    }

    public function bannercatstore(Request $request){

        if($request['catid']!="")
            $postcat = Postcat::where('id', $request['catid'])->first();
        else
            $postcat = new Postcat;

        $postcat->name = $request['title'];
        $postcat->slug = $request['slug'];
        $postcat->parent = $request['subcat'];
        if(!empty($request['categoryType']))
            $postcat->type = $request['categoryType'];
        else
            $postcat->type = 'banner_category';
        $postcat->image = $request['image'];

        //dd($postcat);
        if($request['catid']!="")
        {
            $postcat->update();
            return redirect('/admin/banner/category/'.$request['catid'])->withFlashSuccess(__('alerts.backend.category.updated'));
        }
        else{
            $postcat->save();
            return redirect('/admin/banner/category')->withFlashSuccess(__('alerts.backend.category.created'));
        }
    }

    public function bannercatdestroy($id)
    {
        //dd($id);
        Postcat::where('parent',$id)->delete();
        Postcat::where('id',$id)->delete();
        return redirect('/admin/banner/category')->withFlashSuccess(__('alerts.backend.category.deleted'));
    }


    public function bannerIndex(){
        $posts = Post::where('post_type','banner')->get();
        return view('backend.banner.list-banner',compact('posts'));
    }

    public function bannerCreate(){
        $catCtrl = new PostCatController();
        $ddlCat  = $catCtrl->getCategoryList('banner_category','li');

        return view('backend.banner.banner-create')->with('ddlCat', $ddlCat);
    }

    public function storeBanner(Request $request){

        $user = Auth::user();

        if($request['postid']!=""){
            $posts = Post::where('id', $request['postid'])->first();
            if (Post::where('title', '=', $request['title'])->where('post_type', '=', 'banner')->where('id', '!=', $request['postid'])->exists()) {
                return back()->withFlashDanger(__('alerts.backend.banner.existed'));
            }
        }
        else{
            $posts = new Post();
            if (Post::where('title', '=', $request['title'])->where('post_type', '=', 'banner')->exists()) {
                return back()->withFlashDanger(__('alerts.backend.banner.existed'));
            }
        }

        $posts->userid = $user->id;
        $posts->title = $request['title'];
        $posts->name = $request['title'];
        $posts->clean_url = $request['slug'];

        $posts->status = $request['status'];
        $posts->image = $request['image'];
        $posts->post_type = $request['post_type'];

        if($request['postid']!="")
            $posts->update();
        else
            $posts->save();

        //for meta values


        if(!empty($request['category']))
            $this->addCategoryRelation($request['category'], $posts->id);
        else
            $this->addCategoryRelation(array(0), $posts->id);

        if($request['postid']!="")
            return back()->withFlashSuccess(__('alerts.backend.banner.updated'));
        else
            return redirect('/admin/banner')->withFlashSuccess(__('alerts.backend.banner.created'));
    }

    public function editBanner($id){
        $sel=array();
        $catCtrl = new PostCatController();
        //$postcat = Postcat::where('parent','=', '0')->orderBy('catorder', 'ASC')->get();
        $post = Post::where('id', $id)->first();
        $postmeta = Postmeta::where('postid', $id)->get();
        $catrel = Cat_relation::where('postid','=', $id)->get();

        if($catrel->isNotEmpty())
        {
            foreach($catrel as $cr)
            {
                $sel[]=$cr->catid;
            }
        }

        $ddlCat = $catCtrl->getCategoryList('banner_category','li', $sel);

        //echo $categories;exit;
        return view('backend.banner.banner-create')->with('post', $post)
            ->with('postmeta', $postmeta)
            ->with('ddlCat', $ddlCat);
    }

    public function deleteBanner($id){
        //dd($id);
        Postmeta::where('postid', $id)->delete();
        Cat_relation::where('postid', $id)->delete();
        Post::destroy($id);
        return redirect('/admin/banner')->withFlashSuccess(__('alerts.backend.post.deleted'));
    }

    /*
     * Banner section end
     */

    /*
     * Brocade section start
     */
     public  function brocadecat($id = ""){
            $postcat = Postcat::where('type', '=', 'brocade_category')
                ->orderBy('id', 'ASC')->get();

            if($id!="")
            {
                $editcat = Postcat::where('id', $id)->first();
                return view('backend.brocade.add-category')->with('postcat', $postcat)
                                                            ->with('editcat', $editcat)
                                                            ->with('categoryType', 'brocade_category');
            }
            return view('backend.brocade.add-category')->with('postcat', $postcat)
                ->with('categoryType', 'brocade_category');
        }

    public function brocadecatstore(Request $request){

        if($request['catid']!="")
            $postcat = Postcat::where('id', $request['catid'])->first();
        else
            $postcat = new Postcat;

        $postcat->name = $request['title'];
        $postcat->slug = $request['slug'];
        $postcat->parent = 0;
        if(!empty($request['categoryType']))
            $postcat->type = $request['categoryType'];
        else
            $postcat->type = 'brocade_category';
        $postcat->image = $request['image'];

        //dd($postcat);
        if($request['catid']!="")
        {
            $postcat->update();
            return redirect('/admin/brocade/category/'.$request['catid'])->withFlashSuccess(__('alerts.backend.category.updated'));
        }
        else{
            $postcat->save();
            return redirect('/admin/brocade/category')->withFlashSuccess(__('alerts.backend.category.created'));
        }
    }

    public function brocadecatdestroy($id)
    {
        //dd($id);
        Postcat::where('parent',$id)->delete();
        Postcat::where('id',$id)->delete();
        return redirect('/admin/brocade/category')->withFlashSuccess(__('alerts.backend.category.deleted'));
    }

    public function brocadeIndex(){
        $posts = Post::where('post_type','brocade')->get();
        return view('backend.brocade.list-brocade',compact('posts'));
    }

    public function brocadeCreate(){
        $catCtrl = new PostCatController();
        $ddlCat  = $catCtrl->getCategoryList('brocade_category','li');

        return view('backend.brocade.brocade-create')->with('ddlCat', $ddlCat);
    }

    public function storeBrocade(Request $request){

        $user = Auth::user();

        if($request['postid']!=""){
            $posts = Post::where('id', $request['postid'])->first();
            if (Post::where('title', '=', $request['title'])->where('post_type', '=', 'brocade')->where('id', '!=', $request['postid'])->exists()) {
                return back()->withFlashDanger(__('alerts.backend.brocade.existed'));
            }
        }
        else{
            $posts = new Post();
            if (Post::where('title', '=', $request['title'])->where('post_type', '=', 'brocade')->exists()) {
                return back()->withFlashDanger(__('alerts.backend.brocade.existed'));
            }
        }

        //dd($request);
        $posts->userid = $user->id;
        $posts->title = $request['title'];
        $posts->name = $request['title'];
        $posts->clean_url = $request['slug'];

        $posts->status = $request['status'];
        $posts->image = $request['image'];
        $posts->post_type = $request['post_type'];


        if($request['postid']!="")
            $posts->update();
        else
            $posts->save();

        //for meta values


        if(!empty($request['category']))
            $this->addCategoryRelation($request['category'], $posts->id);
        $this->addAttributes('price', $request['price'], $posts->id);

        if($request['postid']!="")
            return back()->withFlashSuccess(__('alerts.backend.banner.updated'));
        else
            return redirect('/admin/brocade')->withFlashSuccess(__('alerts.backend.brocade.created'));
    }

    public function editBrocade($id){
        $sel=array();
        $catCtrl = new PostCatController();
        //$postcat = Postcat::where('parent','=', '0')->orderBy('catorder', 'ASC')->get();
        $post = Post::where('id', $id)->first();
        $postmeta = Postmeta::where('postid', $id)->get();
        $catrel = Cat_relation::where('postid','=', $id)->get();

        if($catrel->isNotEmpty())
        {
            foreach($catrel as $cr)
            {
                $sel[]=$cr->catid;
            }
        }

        $ddlCat = $catCtrl->getCategoryList('brocade_category','li', $sel);

        //echo $categories;exit;
        return view('backend.brocade.brocade-create')->with('post', $post)
            ->with('postmeta', $postmeta)
            ->with('ddlCat', $ddlCat);
    }

    public function deleteBrocade($id){
        //dd($id);
        Postmeta::where('postid', $id)->delete();
        Cat_relation::where('postid', $id)->delete();
        Post::destroy($id);
        return redirect('/admin/brocade')->withFlashSuccess(__('alerts.backend.brocade.deleted'));
    }

    /*
     * Brocade section end
     */

    /*
     * Handle section star
     */
    public function handleIndex(){
        $posts = Post::where('post_type','handle')->get();
        return view('backend.handle.list-handle',compact('posts'));
    }

    public function handleCreate(){

        return view('backend.handle.handle-create');
    }

    public function storeHandle(Request $request){

        $user = Auth::user();

        if($request['postid']!=""){
            $posts = Post::where('id', $request['postid'])->first();
            if (Post::where('title', '=', $request['title'])->where('post_type', '=', 'brocade')->where('id', '!=', $request['postid'])->exists()) {
                return back()->withFlashDanger(__('alerts.backend.brocade.existed'));
            }
        }
        else{
            $posts = new Post();
            if (Post::where('title', '=', $request['title'])->where('post_type', '=', 'brocade')->exists()) {
                return back()->withFlashDanger(__('alerts.backend.brocade.existed'));
            }
        }

        $posts->userid = $user->id;
        $posts->title = $request['title'];
        $posts->name = $request['title'];
        $posts->clean_url = $request['slug'];

        $posts->status = $request['status'];
        $posts->image = $request['image'];
        $posts->post_type = $request['post_type'];


        if($request['postid']!="")
            $posts->update();
        else
            $posts->save();

        //for meta values


        $this->addAttributes('price', $request['price'], $posts->id);

        if($request['postid']!="")
            return back()->withFlashSuccess(__('alerts.backend.handle.updated'));
        else
            return redirect('/admin/handle')->withFlashSuccess(__('alerts.backend.handle.created'));
    }

    public function editHandle($id){

        $post = Post::where('id', $id)->first();
        $postmeta = Postmeta::where('postid', $id)->get();

        //echo $categories;exit;
        return view('backend.handle.handle-create')->with('post', $post)
            ->with('postmeta', $postmeta);
    }

    public function deleteHandle($id){
        //dd($id);
        Postmeta::where('postid', $id)->delete();
        Post::destroy($id);
        return redirect('/admin/handle')->withFlashSuccess(__('alerts.backend.handle.deleted'));
    }
    /*
     * Handle section end
     */


    /*
     * News and events start
     */
    public function newsIndex(){
        $posts = Post::where('post_type','news')->get();
        return view('backend.news-event.list-news',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newsCreate(){
        return view('backend.news-event.news-create');
    }
    /*
     * store post
     */
    public function storeNews(Request $request){
        //dd($request);
        //for post

        $user = Auth::user();

        if($request['postid']!=""){
            $posts = Post::where('id', $request['postid'])->first();
            /*if (Post::where('title', '=', $request['title'])->where('post_type', '=', 'posts')->where('id', '!=', $request['postid'])->exists()) {
                return back()->withFlashDanger(__('alerts.backend.page.existed'));
            }*/
        }
        else{
            $posts = new Post();
           /* if (Post::where('title', '=', $request['title'])->where('post_type', '=', 'posts')->exists()) {
                return back()->withFlashDanger(__('alerts.backend.page.existed'));
            }*/
        }


        $posts->userid = $user->id;
        $posts->title = $request['title'];
        $posts->name = $request['title'];
        $posts->clean_url = $request['slug'];

        if($request['description']!="")
            $posts->content = $request['description'];
        if($request['excerpt']!="")
            $posts->excerpt = $request['excerpt'];

        $posts->status = $request['status'];
        $posts->image = $request['image'];
        $posts->post_type = $request['post_type'];


        if($request['postid']!="")
            $posts->update();
        else
            $posts->save();

        //for meta values

        $this->addAttributes('keywords', $request['keywords'], $posts->id);
        $this->addAttributes('metadesc', $request['metadesc'], $posts->id);
        $this->addAttributes('time', $request['time'], $posts->id);
        $this->addAttributes('datefrom', $request['datefrom'], $posts->id);
        $this->addAttributes('dateto', $request['dateto'], $posts->id);

        if($request['imagespath']!="")
            $this->addAttributes('images', serialize($request['imagespath']), $posts->id);

        if($request['postid']!="")
            return back()->withFlashSuccess(__('alerts.backend.news.updated'));
        else
            return redirect('/admin/news-events')->withFlashSuccess(__('alerts.backend.news.created'));
    }


    /*
     * Edit the post
     */
    public function editNews($id){

        $post = Post::where('id', $id)->first();
        $postmeta = Postmeta::where('postid', $id)->get();


        //echo $categories;exit;
        return view('backend.news-event.news-create')->with('post', $post)
            ->with('postmeta', $postmeta);
    }

    /*
     * Delete post, meta values and category relationships
     */
    public function deleteNews($id){
        //dd($id);
        Postmeta::where('postid', $id)->delete();
        Post::destroy($id);

        return redirect('/admin/post')->withFlashSuccess(__('alerts.backend.news.deleted'));
    }

    /*
     * News and events end
     */

    /*
     * Buyers discount allocation starts
     */

    public function buyerIndex($id=''){
            $buyers = User::whereHas('roles', function($q){$q->where('name', 'User');})->get();


            if($id!="")
            {
                $editbuy = Buyers_allocation::where('userid', $id)->first();
                $editbuyer = User::where('id',$id)->first();
                return view('backend.options.buyers-allocation')->with('buyers', $buyers)
                                                                ->with('editbuy', $editbuy)
                                                                ->with('userid',$id)
                                                                ->with('editbuyer',$editbuyer);
            }

            return view('backend.options.buyers-allocation')->with('buyers', $buyers);

        }

    public function disstore(Request $request){

        //dd($request);
        $hasAtt = Buyers_allocation::where('userid', $request['userid'])->first();

        if(!empty($hasAtt))
            $postMeta = Buyers_allocation::where('userid', $request['userid'])->first();
        else
            $postMeta = new Buyers_allocation();


        $postMeta->userid = $request['userid'];
        $postMeta->allocation = $request['allocation'];

        if(!empty($hasAtt))
            $postMeta->update();
        else
            $postMeta->save();

        return redirect('/admin/buyers/'.$request['userid'])->withFlashSuccess(__('alerts.backend.buyers_allo.updated'));

    }

    public static function disc_allo($id){

        $hasAtt = Buyers_allocation::where('userid', $id)->first();
        if(!empty($hasAtt))
            return $allo = $hasAtt->allocation;

    }
    /*
     * Buyers discount allocation end
     */

    /*
     * Order Display and listing
     */
    public function ordersIndex($id=''){

        $orders = DB::table('users')
                    ->join('orders','orders.user_id','=','users.id')
                    ->select('users.first_name','users.last_name','orders.*')
                    ->orderBy('created_at', 'DESC')
                    ->get();
        $orders->transform(function($order,$key){
                    $order->cart = unserialize($order->cart);
                    return $order;
                });
//        dd($orders);
        if($id!="")
        {
            $catCtrl = new Order();
            //$postcat = Postcat::where('parent','=', '0')->orderBy('catorder', 'ASC')->get();
            $orders = Order::where('id', $id)->first();
            $buyer = User::where('id',$orders->user_id)->first();


            return view('backend.options.order-detail')->with('orders', $orders)->with('buyer', $buyer);
        }

        return view('backend.options.order-list')->with('orders', $orders);

    }

    public function ordersByuser($id){

        $buyer = User::where('id',$id)->first();

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


        return view('backend.options.order-byuser')->with('buyer',$buyer)->with('orders', $orders);
    }

    public function ordersedit(Request $request){
        if($request['orderid']!=""){
            $order = Order::where('id', $request['orderid'])->first();
        }

        $order->status = $request['status'];

        $order->update();
        return back()->withFlashSuccess(__('alerts.backend.order.updated'));
    }

     /*
     * Order Display and listing
     */


    /*
     * stock management for products start
     */
        public function listStock($id){
            $productDetail = Post::where('id', $id)->first();
            $stocks = Stock::where('postid', '=', $id)
                        ->orderBy('bought_date', 'ASC')->get();
            return view('backend.products.add-stock')->with('productDetail', $productDetail)
                                                     ->with('stocks', $stocks);
        }

        public function stockstore(Request $request){

            $stock = new Stock;

            $stock->postid = $request['postid'];
            $stock->org_stock = $request['org_stock'];
            $stock->in_stock = $request['org_stock'];
            $stock->sold_stock = 0;
            $stock->cost_price = $request['cost_price'];
            $stock->selling_price = $request['selling_price'];
            $stock->bought_date = $request['bought_date'];

            $stock->save();
            return redirect('/admin/product/stock/'.$request['postid'])->withFlashSuccess(__('alerts.backend.category.created'));

        }
    /*
     * stock management for products end
     */


    public function getcatproducts(Request $request){
        $catId = $request['catid'];

        $catproducts = DB::table('posts')
            ->join('cat_relations', 'cat_relations.postid', '=', 'posts.id')
            ->join('postcats', 'postcats.id', '=', 'cat_relations.catid')
            ->where('postcats.id', '=', $catId)
            ->select('posts.*')
            ->get();?>
        <tr class="relatedproducts">
        <td colspan="3">
        <table class="table table-condensed table-hover">
        <tr>
            <th>Product Name</th>
            <th>Product Status</th>
            <th></th>
        </tr>
        <?php if(!$catproducts->isEmpty()){?>
               <?php  foreach($catproducts as $product){?>
                    <tr>
                        <td><?php echo $product->title?></td>
                        <td>
                            <?php
                            if ($product->status == 1)
                                echo 'Publish';
                            else
                                echo     'Unpublish';
                            ?>
                        </td>
                        <td>
                            <a href="edit/<?php echo $product->id;?>" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                            <a href="stock/<?php echo $product->id;?>" class="btn btn-xs btn-primary"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="View Stock"></i></a>
                        </td>
                    </tr>
               <?php   }
                }
                else{
                    echo '<tr><td colspan="3">No Products Found</td></tr>';
                }?>
        </table>
        </td>
        </tr>
    <?php }
}
