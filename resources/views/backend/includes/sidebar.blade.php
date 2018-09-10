<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{url('/img/backend/rituallogo.png')}}" class="img-circle" alt="User Image" />
            </div><!--pull-left-->
            <div class="pull-left info">
                <p>{{ access()->user()->full_name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('strings.backend.general.status.online') }}</a>
            </div><!--pull-left-->
        </div><!--user-panel-->

        <!-- search form (Optional) -->
        {{--{{ Form::open(['route' => 'admin.search.index', 'method' => 'get', 'class' => 'sidebar-form']) }}
        <div class="input-group">
            {{ Form::text('q', Request::get('q'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('strings.backend.general.search_placeholder')]) }}

            <span class="input-group-btn">
                    <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span><!--input-group-btn-->
        </div><!--input-group-->
    {{ Form::close() }}--}}
    <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.sidebar.general') }}</li>

            <li class="{{ active_class(Active::checkUriPattern('admin/dashboard')) }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ trans('menus.backend.sidebar.dashboard') }}</span>
                </a>
            </li>

            <li class="header">{{ trans('menus.backend.sidebar.system') }}</li>

            {{--@role(1)
            <li class="{{ active_class(Active::checkUriPattern('admin/access/*')) }} treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>{{ trans('menus.backend.access.title') }}</span>

                    @if ($pending_approval > 0)
                        <span class="label label-danger pull-right">{{ $pending_approval }}</span>
                    @else
                        <i class="fa fa-angle-left pull-right"></i>
                    @endif
                </a>

                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/access/*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/access/*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/access/user*')) }}">
                        <a href="{{ route('admin.access.user.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('labels.backend.access.users.management') }}</span>

                            @if ($pending_approval > 0)
                                <span class="label label-danger pull-right">{{ $pending_approval }}</span>
                            @endif
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/access/role*')) }}">
                        <a href="{{ route('admin.access.role.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('labels.backend.access.roles.management') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endauth

            <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>{{ trans('menus.backend.log-viewer.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('log-viewer::dashboard') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.log-viewer.dashboard') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer/logs')) }}">
                        <a href="{{ route('log-viewer::logs.list') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.log-viewer.logs') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            --}}{{--Article--}}{{--
            <li class="{{ active_class(Active::checkUriPattern('admin/article*')) }} treeview">
                <a href="#">
                    <i class="fa fa-pencil"></i>
                    <span>{{ trans('menus.backend.article.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/article*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/article*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/article')) }}">
                        <a href="{{ route('admin.article.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.article.all') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/article/create')) }}">
                        <a href="{{ route('admin.article.create') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.article.add') }}</span>
                        </a>
                    </li>
                </ul>
            </li>--}}

            {{--Page--}}
            <li class="{{ active_class(Active::checkUriPattern('admin/page*')) }} treeview">
                <a href="#">
                    <i class="fa fa-file-text"></i>
                    <span>{{ trans('menus.backend.page.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/page*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/page*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/page')) }}">
                        <a href="{{ route('admin.page.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.page.all') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/page/create')) }}">
                        <a href="{{ route('admin.page.create') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.page.add') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{--Product--}}
            <li class="{{ active_class(Active::checkUriPattern('admin/product*')) }} treeview">
                <a href="#">
                    <i class="fa fa-cart-plus"></i>
                    <span>{{ trans('menus.backend.product.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/product*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/product*'), 'display: block;') }}">


                    <li class="{{ active_class(Active::checkUriPattern('admin/product')) }}">
                        <a href="{{ route('admin.product.prodIndex') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.product.product') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/product/create')) }}">
                        <a href="{{ route('admin.product.prodCreate') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.product.add') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/product/category*')) }}">
                        <a href="/admin/product/category">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.product.category') }}</span>
                        </a>
                    </li>


                </ul>
            </li>

            {{--News - Events--}}
            <li class="{{ active_class(Active::checkUriPattern('admin/news-events*')) }} treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>{{ trans('menus.backend.news.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/news-events*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/news-events*'), 'display: block;') }}">


                    <li class="{{ active_class(Active::checkUriPattern('admin/news-events')) }}">
                        <a href="{{ route('admin.news-events.newsIndex') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.news.post') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/news-events/create')) }}">
                        <a href="{{ route('admin.news-events.newsCreate') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.news.add') }}</span>
                        </a>
                    </li>


                </ul>
            </li>

            {{--Banners--}}
            <li class=" {{ active_class(Active::checkUriPattern('admin/banner*')) }} treeview">
                <a href="#">
                    <i class="fa fa-picture-o"></i>
                    <span>{{ trans('menus.backend.banner.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/banner*'), 'menu-open') }}" style="display: none;  {{ active_class(Active::checkUriPattern('admin/banner*'), 'display: block;') }}">

                    <li class="{{ active_class(Active::checkUriPattern('admin/banner')) }}">
                        <a href="{{ route('admin.banner.bannerIndex') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.banner.banner') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/banner/create')) }}">
                        <a href="{{ route('admin.banner.bannerCreate') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.banner.add') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/banner/category*')) }}">
                        <a href="/admin/banner/category">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.banner.category') }}</span>
                        </a>
                    </li>

                </ul>
            </li>


            {{--Brocade--}}
            <li class=" {{ active_class(Active::checkUriPattern('admin/brocade*')) }} treeview">
                <a href="#">
                    <i class="fa fa-picture-o"></i>
                    <span>{{ trans('menus.backend.brocade.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/brocade*'), 'menu-open') }}" style="display: none;  {{ active_class(Active::checkUriPattern('admin/brocade*'), 'display: block;') }}">

                    <li class="{{ active_class(Active::checkUriPattern('admin/brocade')) }}">
                        <a href="{{ route('admin.brocade.brocadeIndex') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.brocade.brocade') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/brocade/create')) }}">
                        <a href="{{ route('admin.brocade.brocadeCreate') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.brocade.add') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/brocade/category*')) }}">
                        <a href="/admin/brocade/category">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.brocade.category') }}</span>
                        </a>
                    </li>

                </ul>
            </li>

            {{--Handle--}}
            <li class=" {{ active_class(Active::checkUriPattern('admin/handle*')) }} treeview">
                <a href="#">
                    <i class="fa fa-picture-o"></i>
                    <span>{{ trans('menus.backend.handle.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/handle*'), 'menu-open') }}" style="display: none;  {{ active_class(Active::checkUriPattern('admin/handle*'), 'display: block;') }}">

                    <li class="{{ active_class(Active::checkUriPattern('admin/handle')) }}">
                        <a href="{{ route('admin.handle.handleIndex') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.handle.handle') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/handle/create')) }}">
                        <a href="{{ route('admin.handle.handleCreate') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.handle.add') }}</span>
                        </a>
                    </li>


                </ul>
            </li>

            {{--Options--}}
            <li class=" {{ active_class(Active::checkUriPattern('admin/exchange*')) }} {{ active_class(Active::checkUriPattern('admin/buyers*')) }} treeview">
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span>{{ trans('menus.backend.option.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/exchange*'), 'menu-open') }}{{ active_class(Active::checkUriPattern('admin/buyers*'), 'menu-open') }}{{ active_class(Active::checkUriPattern('admin/orders*'), 'menu-open') }}" style="display: none;  {{ active_class(Active::checkUriPattern('admin/exchange*'), 'display: block;') }}{{ active_class(Active::checkUriPattern('admin/buyers*'), 'display: block;') }}{{ active_class(Active::checkUriPattern('admin/orders*'), 'display: block;') }}">

                    <li class="{{ active_class(Active::checkUriPattern('admin/exchange*')) }}">
                        <a href="/admin/exchange">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.option.exchange') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/buyers*')) }}">
                        <a href="/admin/buyers">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.option.buyers') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/orders*')) }}">
                        <a href="/admin/orders">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.option.orders') }}</span>
                        </a>
                    </li>

                </ul>
            </li>



        </ul><!-- /.sidebar-menu -->
    </section><!-- /.sidebar -->
</aside>