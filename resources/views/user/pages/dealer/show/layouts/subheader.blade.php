<div class="subheader subheader-solid" id="kt_subheader">
    <div class="container-fluid align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <ul class="nav nav-tabs nav-tabs-line mb-n4">

            <li class="nav-item">
                <a class="nav-link @if(@$tab == 'index') active @endif" href="{{ route('user.dealer.show', ['id' => $id, 'tab' => 'index']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Bayi Bilgileri</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(@$tab == 'customer') active @endif" href="{{ route('user.dealer.show', ['id' => $id, 'tab' => 'customer']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Müşteriler</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(@$tab == 'supportRequest') active @endif" href="{{ route('user.dealer.show', ['id' => $id, 'tab' => 'supportRequest']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Destek Talepleri</span>
                </a>
            </li>

        </ul>
    </div>
</div>
