<div id="sidebarMain" class="d-none">
    <aside
        class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
        <div class="navbar-vertical-container text-capitalize">
            <div class="navbar-vertical-footer-offset">
                <div class="navbar-brand-wrapper justify-content-between">
                    @php($restaurant_logo=\App\Model\BusinessSetting::where(['key'=>'logo'])->first()->value)
                    <a class="navbar-brand" href="{{route('admin.dashboard')}}" aria-label="Front">
                        <img class="navbar-brand-logo"
                             onerror="this.src='{{asset('public/assets/admin/img/160x160/img2.jpg')}}'"
                             src="{{asset('storage/app/public/restaurant/'.$restaurant_logo)}}"
                             alt="Logo">
                        <img class="navbar-brand-logo-mini"
                             onerror="this.src='{{asset('public/assets/admin/img/160x160/img2.jpg')}}'"
                             src="{{asset('storage/app/public/restaurant/'.$restaurant_logo)}}" alt="Logo">
                    </a>
                    <button type="button"
                            class="js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                </div>
                <div class="navbar-vertical-content">
                    <ul class="navbar-nav navbar-nav-lg nav-tabs">
                        <!-- Dashboards -->
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin')?'show':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="{{route('admin.dashboard')}}" title="Dashboards">
                                <i class="tio-home-vs-1-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{trans('messages.dashboard')}}
                                </span>
                            </a>
                        </li>
                        <!-- End Dashboards -->
                        @if(UserCan('view_role','admin'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/role*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:"
                                >
                                    <i class="tio-image nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.role')}}</span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/seller*')?'block':'none'}}">
                                    @if(UserCan('add_role','admin'))
                                        <li class="nav-item {{Request::is('admin/role/add-new')?'active':''}}">
                                            <a class="nav-link " href="{{route('admin.role.add-new')}}">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span
                                                    class="text-truncate">{{trans('messages.add')}} {{trans('messages.new')}}</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(UserCan('view_role','admin'))
                                        <li class="nav-item {{Request::is('admin/role/list')?'active':''}}">
                                            <a class="nav-link " href="{{route('admin.role.list')}}">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">{{trans('messages.list')}}</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if(UserCan('add_rolePer','admin'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/role-per*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('admin.rolePer.add-new')}}">
                                    <i class="tio-star nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                         {{trans('messages.role-per')}}
                                    </span>
                                </a>
                            </li>
                        @endif
                    <!-- End Pages -->
                        <!-- permissions -->
                        @if(UserCan('view_admin','admin'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/admins*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:"
                                >
                                    <i class="tio-image nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.admins')}}</span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/admins*')?'block':'none'}}">
                                    @if(UserCan('add_admin','admin'))
                                        <li class="nav-item {{Request::is('admin/admins/add-new')?'active':''}}">
                                            <a class="nav-link " href="{{route('admin.admins.add-new')}}">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span
                                                    class="text-truncate">{{trans('messages.add')}} {{trans('messages.new')}}</span>
                                            </a>
                                        </li>
                                    @endif
                                    <li class="nav-item {{Request::is('admin/admins/list')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.admins.list')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.list')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if(UserCan('view_order','admin'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/orders*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:">
                                    <i class="tio-shopping-cart nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{trans('messages.orders')}}
                                </span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/order*')?'block':'none'}}">
                                    <li class="nav-item {{Request::is('admin/orders/list/all')?'active':''}}">
                                        <a class="nav-link" href="{{route('admin.orders.list',['all'])}}" title="">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                            {{trans('messages.all')}}
                                            <span class="badge badge-info badge-pill ml-1">
                                                {{\App\Model\Order::count()}}
                                            </span>
                                        </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/orders/list/pending')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.orders.list',['pending'])}}" title="">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                            {{trans('messages.pending')}}
                                            <span class="badge badge-soft-info badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'pending'])->count()}}
                                            </span>
                                        </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/orders/list/confirmed')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.orders.list',['confirmed'])}}"
                                           title="">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                            {{trans('messages.confirmed')}}
                                                <span class="badge badge-soft-success badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'confirmed'])->count()}}
                                            </span>
                                        </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/orders/list/processing')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.orders.list',['processing'])}}"
                                           title="">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                            {{trans('messages.processing')}}
                                                <span class="badge badge-warning badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'processing'])->count()}}
                                            </span>
                                        </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/orders/list/out_for_delivery')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.orders.list',['out_for_delivery'])}}"
                                           title="">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                            {{trans('messages.out_for_delivery')}}
                                                <span class="badge badge-warning badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'out_for_delivery'])->count()}}
                                            </span>
                                        </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/orders/list/delivered')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.orders.list',['delivered'])}}"
                                           title="">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                            {{trans('messages.delivered')}}
                                                <span class="badge badge-success badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'delivered'])->count()}}
                                            </span>
                                        </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/orders/list/returned')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.orders.list',['returned'])}}"
                                           title="">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                            {{trans('messages.returned')}}
                                                <span class="badge badge-soft-danger badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'returned'])->count()}}
                                            </span>
                                        </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/orders/list/failed')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.orders.list',['failed'])}}" title="">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                            {{trans('messages.failed')}}
                                            <span class="badge badge-danger badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'failed'])->count()}}
                                            </span>
                                        </span>
                                        </a>
                                    </li>

                                    <li class="nav-item {{Request::is('admin/orders/list/canceled')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.orders.list',['canceled'])}}"
                                           title="">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">
                                            {{trans('messages.canceled')}}
                                                <span class="badge badge-soft-dark badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'canceled'])->count()}}
                                            </span>
                                        </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    <!-- End orders -->

                        <!-- Sellers -->
                        @if(UserCan('view_seller','admin'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/seller*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:"
                                >
                                    <i class="tio-image nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.seller')}}</span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/seller*')?'block':'none'}}">
                                    <li class="nav-item {{Request::is('admin/seller/add-new')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.seller.add-new')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate">{{trans('messages.add')}} {{trans('messages.new')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/seller/list')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.seller.list')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.list')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    <!-- End Sellers -->

                        <!-- Pages -->
                        @if(UserCan('view_banner','admin'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/banner*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:">
                                    <i class="tio-image nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.banner')}}</span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/banner*')?'block':'none'}}">
                                    <li class="nav-item {{Request::is('admin/banner/add-new')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.banner.add-new')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate">{{trans('messages.add')}} {{trans('messages.new')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/banner/list')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.banner.list')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.list')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if(UserCan('view_brand','admin'))
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/brand*')?'active':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                                <i class="tio-image nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.brands')}}</span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                style="display: {{Request::is('admin/brand*')?'block':'none'}}">
                                @if(UserCan('add_brand','admin'))
                                <li class="nav-item {{Request::is('admin/brand/add-new')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.brand.add-new')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span
                                            class="text-truncate">{{trans('messages.add')}} {{trans('messages.new')}}</span>
                                    </a>
                                </li>
                                @endif
                                @if(UserCan('view_brand','admin'))
                                <li class="nav-item {{Request::is('admin/brand/list')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.brand.list')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{trans('messages.list')}}</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        @if(UserCan('view_age','admin'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/Age*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:">
                                    <i class="tio-image nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.ages')}}</span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/age*')?'block':'none'}}">
                                    @if(UserCan('add_age','admin'))
                                        <li class="nav-item {{Request::is('admin/Age/add-new')?'active':''}}">
                                            <a class="nav-link " href="{{route('admin.Age.add-new')}}">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span
                                                    class="text-truncate">{{trans('messages.add')}} {{trans('messages.new')}}</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(UserCan('view_age','admin'))
                                        <li class="nav-item {{Request::is('admin/Age/list')?'active':''}}">
                                            <a class="nav-link " href="{{route('admin.Age.list')}}">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">{{trans('messages.list')}}</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>

                            </li>
                        @endif
                        @if(UserCan('view_wrapping','admin'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/wraping*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:">
                                    <i class="tio-image nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.wrapping')}}</span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/wraping*')?'block':'none'}}">
                                    @if(UserCan('add_wrapping','admin'))
                                        <li class="nav-item {{Request::is('admin/wraping/add-new')?'active':''}}">
                                            <a class="nav-link " href="{{route('admin.wraping.add-new')}}">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span
                                                    class="text-truncate">{{trans('messages.add')}} {{trans('messages.new')}}</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(UserCan('view_wrapping','admin'))
                                        <li class="nav-item {{Request::is('admin/wraping/list')?'active':''}}">
                                            <a class="nav-link " href="{{route('admin.wraping.list')}}">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">{{trans('messages.list')}}</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if(UserCan('view_cardColors','admin'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/card_colors*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:">
                                    <i class="tio-image nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.card_colors')}}</span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/card_colors*')?'block':'none'}}">
                                    @if(UserCan('add_cardColors','admin'))
                                        <li class="nav-item {{Request::is('admin/card_colors/add-new')?'active':''}}">
                                            <a class="nav-link " href="{{route('admin.card_colors.add-new')}}">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span
                                                    class="text-truncate">{{trans('messages.add')}} {{trans('messages.new')}}</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(UserCan('view_cardColors','admin'))
                                        <li class="nav-item {{Request::is('admin/card_colors/list')?'active':''}}">
                                            <a class="nav-link " href="{{route('admin.card_colors.list')}}">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">{{trans('messages.list')}}</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if(UserCan('view_product','admin'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/product*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:"
                                >
                                    <i class="tio-premium-outlined nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.products')}}</span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/product*')?'block':'none'}}">
                                    @if(UserCan('add_product','admin'))
                                        <li class="nav-item {{Request::is('admin/product/add-new')?'active':''}}">
                                            <a class="nav-link " href="{{route('admin.product.add-new')}}"
                                               title="add new product">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span
                                                    class="text-truncate">{{trans('messages.add')}} {{trans('messages.new')}}</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(UserCan('view_product','admin'))
                                        <li class="nav-item {{Request::is('admin/product/list')?'active':''}}">
                                            <a class="nav-link " href="{{route('admin.product.list')}}"
                                               title="product list">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">{{trans('messages.list')}}</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if(UserCan('view_category','admin'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/category*')?'active':''}}">
                            <li class="nav-item {{Request::is('admin/category/add')?'active':''}}">
                                <a class="nav-link " href="{{route('admin.category.add')}}"
                                   title="add new category">
                                    <i class="tio-category nav-icon"></i>
                                    <span class="text-truncate">{{trans('messages.categories')}}</span>
                                </a>
                            </li>
                        @endif
                        @if(UserCan('view_price_group','admin'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/price-group*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('admin.price-group.add-new')}}"
                                >
                                    <i class="tio-shop nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{trans('messages.price-group')}}
                                </span>
                                </a>
                            </li>
                        @endif
                        @can('view_branch')
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/branch*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('admin.branch.add-new')}}"
                                >
                                    <i class="tio-shop nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{trans('messages.branch')}}
                                </span>
                                </a>
                            </li>
                        @endcan
                        @if(UserCan('view_setTime','admin'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/timeSlot*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('admin.timeSlot.add-new')}}"
                                   title="Pages">
                                    <i class="tio-clock nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.Time Slot')}} </span>
                                </a>
                            </li>
                        @endif
                        @if(UserCan('view_customer','admin'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/customer*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="{{route('admin.customer.list')}}"
                                >
                                    <i class="tio-poi-user nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{trans('messages.customers')}}
                                </span>
                                </a>
                            </li>
                        @endif
                        @if(UserCan('view_settings','admin'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/business-settings*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:"
                                >
                                    <i class="tio-settings nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.settings')}}</span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/business-settings*')?'block':'none'}}">
                                    <li class="nav-item {{Request::is('admin/business-settings/ecom-setup')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.business-settings.ecom-setup')}}"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate">{{trans('messages.restaurant_setup')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/business-settings/location-setup')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.business-settings.location-setup')}}"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate">{{trans('messages.location_setup')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/business-settings/mail-config')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.business-settings.mail-config')}}"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate">{{trans('messages.mail_make')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/business-settings/payment-method')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.business-settings.payment-method')}}"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate">{{trans('messages.payment_methods')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/business-settings/fcm-index')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.business-settings.fcm-index')}}"
                                           title="">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate">{{trans('messages.notification_settings')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/business-settings/terms-and-conditions')?'active':''}}">
                                        <a class="nav-link "
                                           href="{{route('admin.business-settings.terms-and-conditions')}}"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.terms_and_condition')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/business-settings/privacy-policy')?'active':''}}">
                                        <a class="nav-link "
                                           href="{{route('admin.business-settings.privacy-policy')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.privacy_policy')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/business-settings/about-us')?'active':''}}">
                                        <a class="nav-link "
                                           href="{{route('admin.business-settings.about-us')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.about_us')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        <li class="nav-item">
                            <div class="nav-divider"></div>
                        </li>
                        <li class="nav-item">
                            <small class="nav-subtitle"
                                   title="Documentation">{{trans('messages.report_and_analytics')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        <!-- Pages -->
                        @if(UserCan('view_all_reports','admin'))
                            <li class="navbar-vertical-aside-has-menu {{Request::is('admin/report*')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:">
                                    <i class="tio-report-outlined nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.reports')}}</span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{Request::is('admin/report*')?'block':'none'}}">
                                    <li class="nav-item {{Request::is('admin/report/earning')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.report.earning')}}"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate">{{trans('messages.profit_report')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/report/order')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.report.order')}}"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate">{{trans('messages.order_report')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/report/driver-report')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.report.driver-report')}}"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate">{{trans('messages.driver_report')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/report/product-report')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.report.product-report')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.product_report')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{Request::is('admin/report/sale-report')?'active':''}}">
                                        <a class="nav-link " href="{{route('admin.report.sale-report')}}">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate">{{trans('messages.report_sale')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        <li class="nav-item" style="padding-top: 100px">
                            <div class="nav-divider"></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
</div>
<div id="sidebarCompact" class="d-none">
</div>
