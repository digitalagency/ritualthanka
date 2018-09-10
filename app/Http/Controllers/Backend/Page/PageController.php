<?php

namespace App\Http\Controllers\Backend\page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Page\Page;
use App\Models\Post\Postmeta;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $pages = Page::where('post_type','page')->get();
        return view('backend.page.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request);
        $formInput = new Page;

        if (Page::where('title', '=', $request['title'])->where('post_type', '=', 'page')->exists()) {
            return back()->withFlashDanger(__('alerts.backend.page.existed'));
        }

        $formInput->title = $request['title'];
        $formInput->name = $request['title'];
        $formInput->clean_url = $request['slug'];
        $formInput->post_type = 'page';
        $formInput->content = $request['description'];

        if($request['excerpt']!="")
            $formInput->excerpt = $request['excerpt'];

        $formInput->image = $request['image'];
        $formInput->status = $request['status'];

        $formInput->save();

        $this->addAttributes('keywords', $request['keywords'], $formInput->id);
        $this->addAttributes('metadesc', $request['metadesc'], $formInput->id);

        return redirect()->route('admin.page.index')->withFlashSuccess(__('alerts.backend.page.created'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pageInfo = Page::find($id);
        return view('backend.page.show',compact('pageInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageInfo = Page::find($id);
        $postmeta = Postmeta::where('postid', $id)->get();
       // return view('backend.page.edit',compact('pageInfo'))->withFlashSuccess(__('alerts.backend.page.updated'));
        return view('backend.page.edit')->with('pageInfo', $pageInfo)
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
        $page = Page::findorfail($id);

        if (Page::where('title', '=', $request['title'])->where('post_type', '=', 'page')->where('id', '!=', $id)->exists()) {
            return back()->withFlashDanger(__('alerts.backend.page.existed'));
        }

        $page->title = $request['title'];
        $page->name = $request['title'];
        $page->clean_url = $request['slug'];
        //$formInput->post_type = 'page';
        $page->content = $request['description'];
        if($request['excerpt']!="")
            $page->excerpt = $request['excerpt'];

        $page->image = $request['image'];
        $page->status = $request['status'];
        //dd($page);

        $page->save();

        $this->addAttributes('keywords', $request['keywords'], $page->id);
        $this->addAttributes('metadesc', $request['metadesc'], $page->id);

        return back()->withFlashSuccess(__('alerts.backend.page.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Page::where('id',$id)->delete();
        return redirect()->route('admin.page.index')->withFlashSuccess(__('alerts.backend.page.deleted'));
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
