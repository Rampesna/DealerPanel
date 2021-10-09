<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
    <div id="kt_header" class="header header-fixed">
        <div class="container-fluid d-flex align-items-stretch justify-content-between">
            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">

            </div>
            <div class="topbar">
                <div class="topbar-item">
                    <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                        <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hoşgeldiniz,</span>
                        <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ $authenticated->name }}</span>
                        <span class="symbol symbol-35 symbol-light-success">
                            <span class="symbol-label font-size-h5 font-weight-bold">{{ substr($authenticated->name,0,1) }}</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-fluid loaded" style="margin-top: -50px;">
            @yield('content')
        </div>
    </div>

    @include('dealerUser.layouts.footer')
    @include('dealerUser.layouts.rightbar')
</div>
