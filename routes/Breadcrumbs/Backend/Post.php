<?php
//product
Breadcrumbs::register('admin.product.prodIndex', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.product.main'), url('admin/product'));
});

Breadcrumbs::register('admin.product.prodCreate', function ($breadcrumbs) {
    //$breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->parent('admin.product.prodIndex');
    $breadcrumbs->push(__('labels.backend.product.add_product'), route('admin.product.prodCreate'));
});


Breadcrumbs::register('admin.product.category', function ($breadcrumbs) {
    //$breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->parent('admin.product.prodIndex');
    $breadcrumbs->push(__('labels.backend.product.category'), url('admin.product.category'));
});


//post

Breadcrumbs::register('admin.post.postIndex', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.post.main'), url('admin/post'));
});

Breadcrumbs::register('admin.post.postCreate', function ($breadcrumbs) {
    //$breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->parent('admin.post.postIndex');
    $breadcrumbs->push(__('labels.backend.post.add'), route('admin.post.postCreate'));
});

Breadcrumbs::register('admin.post.postcat', function ($breadcrumbs) {
    //$breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->parent('admin.post.postIndex');
    $breadcrumbs->push(__('labels.backend.post.category'), url('admin.post.postcat'));
});


//banner
Breadcrumbs::register('admin.banner.bannerIndex', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.banner.main'), url('admin/banner'));
});

Breadcrumbs::register('admin.banner.bannerCreate', function ($breadcrumbs) {
    //$breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->parent('admin.banner.bannerIndex');
    $breadcrumbs->push(__('labels.backend.banner.add_banner'), route('admin.banner.bannerCreate'));
});

Breadcrumbs::register('admin.banner.bannercat', function ($breadcrumbs) {
    //$breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->parent('admin.banner.bannerIndex');
    $breadcrumbs->push(__('labels.backend.banner.category'), url('admin.banner.bannercat'));
});


//brocade
Breadcrumbs::register('admin.brocade.brocadeIndex', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.brocade.main'), url('admin/brocade'));
});

Breadcrumbs::register('admin.brocade.brocadeCreate', function ($breadcrumbs) {
    //$breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->parent('admin.brocade.brocadeIndex');
    $breadcrumbs->push(__('labels.backend.brocade.add_brocade'), route('admin.brocade.brocadeCreate'));
});

Breadcrumbs::register('admin.brocade.brocadecat', function ($breadcrumbs) {
    //$breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->parent('admin.brocade.brocadeIndex');
    $breadcrumbs->push(__('labels.backend.brocade.category'), url('admin.brocade.brocadecat'));
});


//handle
Breadcrumbs::register('admin.handle.handleIndex', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.handle.main'), url('admin/handle'));
});

Breadcrumbs::register('admin.handle.handleCreate', function ($breadcrumbs) {
    //$breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->parent('admin.handle.handleIndex');
    $breadcrumbs->push(__('labels.backend.handle.add_handle'), route('admin.handle.handleCreate'));
});

//handle
Breadcrumbs::register('admin.news-events.newsIndex', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.news.main'), url('admin/news-events'));
});

Breadcrumbs::register('admin.news-events.newsCreate', function ($breadcrumbs) {
    //$breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->parent('admin.news-events.newsIndex');
    $breadcrumbs->push(__('labels.backend.news.add_post'), route('admin.news-events.newsCreate'));
});

//options

Breadcrumbs::register('admin.exchange.exchange', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    //$breadcrumbs->parent('admin.product.prodIndex');
    $breadcrumbs->push(__('labels.backend.option.exchange.management'), url('admin.exchange.exchange'));
});

Breadcrumbs::register('admin.buyers.buyerIndex', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    //$breadcrumbs->parent('admin.product.prodIndex');
    $breadcrumbs->push(__('labels.backend.option.buyers.management'), url('admin.buyers.buyerIndex'));
});

Breadcrumbs::register('admin.orders.ordersIndex', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    //$breadcrumbs->parent('admin.product.prodIndex');
    $breadcrumbs->push(__('labels.backend.option.orders.management'), url('admin.orders.ordersIndex'));
});