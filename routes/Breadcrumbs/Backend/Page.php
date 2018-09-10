<?php

Breadcrumbs::register('admin.page.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.page.main'), url('admin/page'));
});

Breadcrumbs::register('admin.page.create', function ($breadcrumbs) {
    //$breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->parent('admin.page.index');
    $breadcrumbs->push(__('labels.backend.page.add'), route('admin.page.create'));
});


Breadcrumbs::register('admin.page.page.show', function ($breadcrumbs) {
    //$breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->parent('admin.page.index');
    $breadcrumbs->push(__('labels.backend.page.show'), route('admin.page.create'));
});

Breadcrumbs::register('admin.page.page.edit', function ($breadcrumbs) {
    //$breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->parent('admin.page.index');
    $breadcrumbs->push(__('labels.backend.page.edit'), route('admin.page.create'));
});
