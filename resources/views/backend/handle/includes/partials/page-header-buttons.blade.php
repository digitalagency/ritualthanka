<div class="pull-right mb-10 hidden-sm hidden-xs">
    {{ link_to_route('admin.handle.handleIndex', trans('menus.backend.handle.handle'), [], ['class' => 'btn btn-primary btn-xs']) }}
    {{ link_to_route('admin.handle.handleCreate', trans('menus.backend.handle.add'), [], ['class' => 'btn btn-success btn-xs']) }}
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('menus.backend.handle.main') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" role="menu">
            <li>{{ link_to_route('admin.handle.handleIndex', trans('menus.backend.handle.handle')) }}</li>
            <li>{{ link_to_route('admin.handle.handleCreate', trans('menus.backend.handle.add')) }}</li>
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>