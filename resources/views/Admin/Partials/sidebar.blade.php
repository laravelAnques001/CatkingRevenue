<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-expand-lg border-0">

    <!-- Sidebar header -->
    <div class="sidebar-section  bg-opacity-10 border-bottom border-bottom-white border-opacity-10">
        <div class="sidebar-logo d-flex justify-content-center align-items-center">
            <a href="#" class="d-inline-flex align-items-center py-2">
                <img src="{{ asset('assets/images/icons/catking.png') }}" class="sidebar-logo-icon" alt="">
            </a>

            {{--  <div class="sidebar-resize-hide ms-auto">
                <button type="button"
                    class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex bg-primary">
                    <i class="ph-arrows-left-right"></i>
                </button>

                <button type="button"
                    class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none bg-black">
                    <i class="ph-x"></i>
                </button>
            </div>  --}}
        </div>
    </div>
    <!-- /sidebar header -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <li class="nav-item py-2">
                    <a href="#" class="nav-link {{ Route::currentRouteName() == 'ceo-revenue' ? 'active' : '' }}">
                        <i class="ph-layout"></i>
                        <span>Ceo Revenue</span>
                    </a>
                </li>
                <li class="nav-item py-2">
                    <a href="#" class="nav-link {{ Route::currentRouteName() == 'student' ? 'active' : '' }}">
                        <i class="ph-swatches"></i>
                        <span>Student Profile</span>
                    </a>
                </li>
                <li class="nav-item py-2">
                    <a href="#" class="nav-link {{ Route::currentRouteName() == 'exam' ? 'active' : '' }}">
                        <i class="ph-note-blank"></i>
                        <span>Exam Toppers</span>
                    </a>
                </li>
                <li class="nav-item py-2">
                    <a href="#" class="nav-link {{ Route::currentRouteName() == 'mentors' ? 'active' : '' }}">
                        <i class="ph-list-numbers"></i>
                        <span>Mentors/ Interview</span>
                    </a>
                </li>
                <li class="nav-item py-2">
                    <a href="#" class="nav-link {{ Route::currentRouteName() == 'faculty' ? 'active' : '' }}">
                        <i class="ph-dots-three"></i>
                        <span>Faculty & Session</span>
                    </a>
                </li>
                <li class="nav-item py-2">
                    <a href="#" class="nav-link {{ Route::currentRouteName() == 'finance' ? 'active' : '' }}">
                        <i class="ph-columns"></i>
                        <span>Finance</span>
                    </a>
                </li>
                <li class="nav-item py-2">
                    <a href="#" class="nav-link {{ Route::currentRouteName() == 'marketing' ? 'active' : '' }}">
                        <i class="ph-rows"></i>
                        <span>Marketing</span>
                    </a>
                </li>
                <li class="nav-item py-2">
                    <a href="#" class="nav-link {{ Route::currentRouteName() == 'forum' ? 'active' : '' }}">
                        <i class="ph-arrow-fat-lines-down"></i>
                        <span>Forum</span>
                    </a>
                </li>
                <li class="nav-item py-2">
                    <a href="#" class="nav-link {{ Route::currentRouteName() == 'catking' ? 'active' : '' }}">
                        <i class="ph-arrow-fat-lines-right"></i>
                        <span>CATKing One</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->
</div>
<!-- /main sidebar -->
