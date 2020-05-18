<main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
    <div class="main-navbar sticky-top bg-white">
        <!-- Main Navbar -->
        <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0" style="box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.15)">
            <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
                <div class="input-group input-group-seamless ml-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                        </div>
                    </div>
                    <input class="navbar-search form-control" type="hidden" placeholder="Search for something..."
                        aria-label="Search">
                </div>
            </form>

            {{-- <form action="language" method="post">
            <select name="locale" id="" style="border:none;" onchange="this.form.submit()">
                <option value="en">English </option>
                <option value="ja">Japanese</option>
            </select>
                @csrf
        </form> --}}
            <ul class="navbar-nav border-left flex-row ">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-nowrap px-3" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(App::isLocale('ja'))
                        <span class="flag-icon flag-icon-jp"></span> 日本語
                        @elseif(App::isLocale('en'))
                        <span class="flag-icon flag-icon-us"></span> English
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-small" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo(\Config::get('app.url').'/language/en');?>"><span
                                class="flag-icon flag-icon-us"></span> English</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo(\Config::get('app.url').'/language/ja');?>"><span
                                class="flag-icon flag-icon-jp"></span> 日本語</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        @if(Auth::user()->image)
                        <img class="user-avatar rounded-circle mr-2"
                            src="{{config('app.url').'storage/app'.config('const.USER_UPLOAD_IMAGES_PATH').Auth::user()->image}}"
                            alt="User Avatar">
                        @endif
                        <span class="d-none d-md-inline-block">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-small" style="margin-left: -60px;">
                        @can('personal_profile_view')
                        <a class="dropdown-item"
                            href="<?php echo(\Config::get('app.url').'user_update/553456382u6hsdgh')?>">
                            <i class="material-icons">&#xE7FD;</i> {{__('messages.profile_text')}}
                        </a>
                        @endcan
                        @can('personal_password_change')
                        <button class="dropdown-item pc" id="{{Auth::user()->id}}">
                            <i class="material-icons">vertical_split</i> {{__('messages.password_change_text')}}
                        </button>
                        @endcan
                        <!-- <a class="dropdown-item" href="add-new-post.html">
                    <i class="material-icons">note_add</i> Add New Post
                </a> -->
                        <div class="dropdown-divider"></div>
                        <!-- <a class="dropdown-item text-danger" href="#">
                <i class="material-icons text-danger">&#xE879;</i> Logout </a> -->
                        <a class="dropdown-item text-danger" href="<?php echo(\Config::get('app.url').'logout');?>"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <i class="material-icons text-danger">&#xE879;</i>
                            {{ __('messages.logout_text') }}
                        </a>
                        <form id="logout-form" action="<?php echo(\Config::get('app.url').'logout');?>" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
            <nav class="nav">
                <a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left"
                    data-toggle="collapse" data-target=".header-navbar" aria-expanded="false"
                    aria-controls="header-navbar">
                    <i class="material-icons">&#xE5D2;</i>
                </a>
            </nav>
        </nav>
    </div>
    <!-- / .main-navbar -->


    