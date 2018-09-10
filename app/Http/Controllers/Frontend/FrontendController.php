<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\Models\Post\Post;
use App\Models\Post\Postcat;
use App\Models\Post\Postmeta;
use App\Models\Cat_relation;
use App\Models\Exchange_rate;

use App\Models\Access\User\User;

use Illuminate\Support\Facades\View;

/**
 * Class FrontendController.
 */
class FrontendController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $homebanner = DB::table('posts')
            ->join('cat_relations', 'cat_relations.postid', '=', 'posts.id')
            ->join('postcats', 'postcats.id', '=', 'cat_relations.catid')
            ->where('postcats.slug', '=', 'home-banner')
            ->select('posts.*')
            ->get();

        $postcats = Postcat::where('type', '=', 'category')
                    ->orderBy('id', 'ASC')->get();

        $fthankas = DB::table('posts')
                    ->join('postmetas','postmetas.postid','=','posts.id')
                    ->where('postmetas.meta_key','=','feature_thanka')
                    ->where('postmetas.meta_value','=',1)
                    ->select('posts.*')
                    ->orderBy('posts.id','ASC')
                    ->limit(4)
                    ->get();

        $pthankas = DB::table('posts')
            ->join('postmetas','postmetas.postid','=','posts.id')
            ->where('postmetas.meta_key','=','popular_thanka')
            ->where('postmetas.meta_value','=',1)
            ->select('posts.*')
            ->orderBy('posts.id','ASC')
            ->limit(4)
            ->get();

        $athankas = DB::table('posts')
            ->join('postmetas','postmetas.postid','=','posts.id')
            ->where('postmetas.meta_key','=','antique_thanka')
            ->where('postmetas.meta_value','=',1)
            ->select('posts.*')
            ->orderBy('posts.id','ASC')
            ->limit(4)
            ->get();

        $onsales = DB::table('posts')
            ->join('postmetas','postmetas.postid','=','posts.id')
            ->where('postmetas.meta_key','=','on_sale')
            ->where('postmetas.meta_value','=',1)
            ->select('posts.*')
            ->orderBy('posts.id','ASC')
            ->limit(4)
            ->get();

        $latests = Post::where('post_type','=','product')
                        ->orderBy('created_at','desc')
                        ->limit(2)
                        ->get();

        $articles  = Post::where('post_type','=','article')
                            ->where('status','=','1')
                            ->orderBy('created_at','desc')
                            ->limit(4)
                            ->get();

        $news  = Post::where('post_type','=','news')
                        ->where('status','=','1')
                        ->orderBy('created_at','desc')
                        ->limit(3)
                        ->get();
        return view('frontend.index')->with('homebanner', $homebanner)
                                     ->with('postcats', $postcats)
                                     ->with('fthankas', $fthankas)
                                     ->with('pthankas', $pthankas)
                                     ->with('athankas', $athankas)
                                     ->with('onsales', $onsales)
                                     ->with('latests', $latests)
                                     ->with('articles', $articles)
                                     ->with('news', $news);

    }


    public function about()
    {
        return view('frontend.about');
    }

    public static function getAuthorName($id){
        //echo $id;
        $user = User::find($id);
        echo $user->first_name;
    }

    public function newsevents($slug=""){
        return view('frontend.components.newsblock.single-news');
    }
    /**
     * @return \Illuminate\View\View
     */
    public function macros()
    {
        return view('frontend.macros');
    }

}
