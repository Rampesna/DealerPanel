<div class="subheader subheader-solid" id="kt_subheader">
    <div class="container-fluid align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <ul class="nav nav-tabs nav-tabs-line mb-n4">

            <li class="nav-item">
                <a class="nav-link @if(@$tab == 'index') active @endif" href="{{ route('dealerUser.dealer.show', ['id' => $id, 'tab' => 'index']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Bayi Bilgileri</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(@$tab == 'customer') active @endif" href="{{ route('dealerUser.dealer.show', ['id' => $id, 'tab' => 'customer']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Müşteriler</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(@$tab == 'credit') active @endif" href="{{ route('dealerUser.dealer.show', ['id' => $id, 'tab' => 'credit']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Kontör Raporu</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(@$tab == 'finance') active @endif" href="{{ route('dealerUser.dealer.show', ['id' => $id, 'tab' => 'finance']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Finans Raporu</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(@$tab == 'dealerUser') active @endif" href="{{ route('dealerUser.dealer.show', ['id' => $id, 'tab' => 'dealerUser']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Bayi Kullanıcıları</span>
                </a>
            </li>

        </ul>
    </div>
</div>
