<?php

namespace App\Http\Controllers\Backend\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Article\Article;
use App\Models\Post\Postmeta;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $articles = Article::where('post_type','article')->get();
        return view('backend.article.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $formInput = new Article;

        if (Article::where('title', '=', $request['title'])->where('post_type', '=', 'article')->exists()) {
            return back()->withFlashDanger(__('alerts.backend.article.existed'));
        }
        $user = Auth::user();
        $formInput->userid = $user->id;
        $formInput->title = $request['title'];
        $formInput->name = $request['title'];
        $formInput->clean_url = $request['slug'];
        $formInput->post_type = 'article';
        $formInput->content = $request['description'];

        if($request['excerpt']!="")
            $formInput->excerpt = $request['excerpt'];

        $formInput->image = $request['image'];
        $formInput->status = $request['status'];

        $formInput->save();

        $this->addAttributes('keywords', $request['keywords'], $formInput->id);
        $this->addAttributes('metadesc', $request['metadesc'], $formInput->id);

        return redirect()->route('admin.article.index')->withFlashSuccess(__('alerts.backend.article.created'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articleInfo = Article::find($id);

        return view('backend.article.show',compact('articleInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articleInfo = Article::find($id);
        $postmeta = Postmeta::where('postid', $id)->get();
        //return view('backend.article.edit',compact('articleInfo'))->withFlashSuccess(__('alerts.backend.article.updated'));
        return view('backend.article.edit')->with('articleInfo', $articleInfo)
                                            ->with('postmeta', $postmeta);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        $article = Article::findorfail($id);

        if (Article::where('title', '=', $request['title'])->where('post_type', '=', 'article')->where('id', '!=', $id)->exists()) {
            return back()->withFlashDanger(__('alerts.backend.article.existed'));
        }

        $article->title = $request['title'];
        $article->name = $request['title'];
        $article->clean_url = $request['slug'];
        //$formInput->post_type = 'article';
        $article->content = $request['description'];

        if($request['excerpt']!="")
            $article->excerpt = $request['excerpt'];

        $article->image = $request['image'];
        $article->status = $request['status'];

        $article->save();
        $this->addAttributes('keywords', $request['keywords'], $article->id);
        $this->addAttributes('metadesc', $request['metadesc'], $article->id);

        return back()->withFlashSuccess(__('alerts.backend.article.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::where('id',$id)->delete();
        return redirect()->route('admin.article.index')->withFlashSuccess(__('alerts.backend.article.deleted'));
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
}
