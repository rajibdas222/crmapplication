<!-- Main Sidebar -->
<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
            <a class="navbar-brand w-100 mr-0" id="sidebar-header" href="<?php echo(\Config::get('app.url').'home');?>"
                style="line-height: 25px;">
                <div class="d-table m-auto">
                    <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25%;"
                        src="<?php echo(\Config::get('app.url'))?>public/backend/images/logo/jacos_logo.png"
                        alt="Jacos Dashboard">
                    <span class="d-none d-md-inline ml-1">{{__('messages.heading')}}</span>
                </div>
            </a>
            <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                <i class="material-icons">&#xE5C4;</i>
            </a>
        </nav>
    </div>
    <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
        <div class="input-group input-group-seamless ml-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <input class="navbar-search form-control" type="text" placeholder="Search for something..."
                aria-label="Search">
        </div>
    </form>
    <div class="nav-wrapper">
        <ul class="nav flex-column">
            @can('dashboard_menu')
            <li class="nav-item">
                <a class="nav-link <?= (!empty($active) && $active=='dashboard')? 'active':'' ?>"
                    href="<?php echo(\Config::get('app.url').'home');?>">
                    <i class="material-icons">home</i>
                    <span>{{__('messages.dashboard_text')}}</span>
                </a>
            </li>
            @endcan
            @can('all_menu_show')
            @can('role_menu')
            <li class="nav-item">
                <a href="<?php echo(\Config::get('app.url').'role');?>"
                    class="nav-link <?= (!empty($active) && $active=='role')? 'active':'' ?>">
                    <i class="material-icons">person</i>
                    <span>{{__('messages.role_management')}}</span>
                </a>
            </li>
            @endcan
            @can('permission_menu')
            <li class="nav-item">
                <a href="<?php echo(\Config::get('app.url').'permission');?>"
                    class="nav-link <?= (!empty($active) && $active=='permission')? 'active':'' ?>">
                    <i class="material-icons">account_balance</i>
                    <span>{{__('messages.permission_management')}} </span>
                </a>
            </li>
            @endcan
            @can('assign_role_to_user_menu')
            <li class="nav-item">
                <a href="<?php echo(\Config::get('app.url').'assign_role_model');?>"
                    class="nav-link <?= (!empty($active) && $active=='assign_role_model')? 'active':'' ?>">
                    <i class="material-icons">all_inclusive</i>
                    <span>{{__('messages.assign_role_to_user')}}</span>
                </a>
            </li>
            @endcan
            @can('assign_permission_to_user_menu')
            <li class="nav-item">
                <a href="<?php echo(\Config::get('app.url').'assign_permission_model');?>"
                    class="nav-link <?= (!empty($active) && $active=='assign_permission_model')? 'active':'' ?>">
                    <i class="material-icons">enhanced_encryption</i>
                    <span>{{__('messages.assign_permission_to_user')}}</span>
                </a>
            </li>
            @endcan
            @can('manage_user_menu')
            <li class="nav-item">
                <a href="<?php echo(\Config::get('app.url').'user_list');?>"
                    class="nav-link <?= (!empty($active) && $active=='user_list')? 'active':'' ?>">
                    <i class="material-icons">person</i>
                    <span>{{__('messages.manage_users')}}</span>
                </a>
            </li>
            @endcan
            @endcan
        </ul>
    </div>
</aside>