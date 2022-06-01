<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
        <img src="{{getLogoSetting()}}" style="width:50px;height: 50px">
        <span class="brand-text font-weight-light">{{$setting[strtolower('name')]??""}}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar User panel (optional) -->
    {{--<div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{getImag($user->avatar,'User')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" style="pointer-events: none; cursor: default;" class="d-block">{{$user->fullname}}</a>
        </div>
    </div>--}}
    <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @permission('user-index')
                    <li class="nav-item">
                        <a href="{{route('user.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>{{$custom[strtolower('user')]??"lang not found"}}</p>
                        </a>
                    </li>
                @endpermission
                @permission('core-data')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                {{$custom[strtolower('system_data')]??"lang not found"}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @permission('category-index')
                                <li class="nav-item">
                                    <a href="{{route('category.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{$custom[strtolower('category')]??"lang not found"}}</p>
                                    </a>
                                </li>
                            @endpermission
                            @permission('tag-index')
                                <li class="nav-item">
                                    <a href="{{route('tag.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{$custom[strtolower('tag')]??"lang not found"}}</p>
                                    </a>
                                </li>
                            @endpermission
                            @permission('location-list')
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-circle"></i>
                                        <p>
                                            {{$custom[strtolower('location')]??"lang not found"}}
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @permission('country-index')
                                        <li class="nav-item">
                                            <a href="{{route('country.index')}}" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>{{$custom[strtolower('country')]??"lang not found"}}</p>
                                            </a>
                                        </li>
                                        @endpermission
                                        @permission('city-index')
                                            <li class="nav-item">
                                                <a href="{{route('city.index')}}" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>{{$custom[strtolower('city')]??"lang not found"}}</p>
                                                </a>
                                            </li>
                                        @endpermission
                                        @permission('state-index')
                                            <li class="nav-item">
                                                <a href="{{route('state.index')}}" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>{{$custom[strtolower('state')]??"lang not found"}}</p>
                                                </a>
                                            </li>
                                        @endpermission
                                    </ul>
                                </li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission
                @permission('acl')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            {{$custom[strtolower('acl')]??"lang not found"}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @permission('role-index')
                        <li class="nav-item">
                            <a href="{{route('role.index')}}" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>{{$custom[strtolower('role')]??"lang not found"}}</p>
                            </a>
                        </li>
                        @endpermission
                        @permission('permission-index')
                        <li class="nav-item">
                            <a href="{{route('permission.index')}}" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>{{$custom[strtolower('permission')]??"lang not found"}}</p>
                            </a>
                        </li>
                        @endpermission
                    </ul>
                </li>
                @endpermission
                @permission('property-index')
                <li class="nav-item">
                    <a href="{{route('property.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>{{$custom[strtolower('property')]??"lang not found"}}</p>
                    </a>
                </li>
                @endpermission
                @permission('trash-list')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                {{$custom[strtolower('trash')]??"lang not found"}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @permission('user-trash')
                                <li class="nav-item">
                                    <a href="{{route('user.trash')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{$custom[strtolower('user')]??"lang not found"}}</p>
                                    </a>
                                </li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission
                @permission('setting')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                {{$custom[strtolower('Setting')]??"lang not found"}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @permission('contact-us-index')
                                <li class="nav-item">
                                    <a href="{{route('contact_us.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{$custom[strtolower('contact_us')]??"lang not found"}}</p>
                                    </a>
                                </li>
                            @endpermission
                            @permission('page-index')
                                <li class="nav-item">
                                    <a href="{{route('page.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{$custom[strtolower('page')]??"lang not found"}}</p>
                                    </a>
                                </li>
                            @endpermission
                            @permission('home-slider-index')
                            <li class="nav-item">
                                <a href="{{route('home_slider.index')}}" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>{{$custom[strtolower('home_slider')]??"lang not found"}}</p>
                                </a>
                            </li>
                            @endpermission
                            @permission('translation-list')
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-circle"></i>
                                        <p>
                                            {{$custom[strtolower('translation')]??"lang not found"}}
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @permission('language-index')
                                            <li class="nav-item">
                                                <a href="{{route('language.index')}}" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>{{$custom[strtolower('language')]??"lang not found"}}</p>
                                                </a>
                                            </li>
                                        @endpermission
                                        @permission('custom-translation-index')
                                            <li class="nav-item">
                                                <a href="{{route('custom_translation.index')}}" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>{{$custom[strtolower('customTranslation')]??"lang not found"}}</p>
                                                </a>
                                            </li>
                                        @endpermission
                                    </ul>
                                </li>
                            @endpermission
                            @permission('log-index')
                                <li class="nav-item">
                                    <a href="{{route('log.index')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{$custom[strtolower('log')]??"lang not found"}}</p>
                                    </a>
                                </li>
                            @endpermission
                            @permission('setting-edit')
                                <li class="nav-item">
                                    <a href="{{route('setting.edit')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{$custom[strtolower('Setting')]??"lang not found"}}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('setting.home')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>{{$custom[strtolower('home_setting')]??"lang not found"}}</p>
                                    </a>
                                </li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
@yield('main-sidebar')
