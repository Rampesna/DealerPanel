<div class="subheader subheader-solid" id="kt_subheader">
    <div class="container-fluid align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <ul class="nav nav-tabs nav-tabs-line mb-n4">

            <li class="nav-item">
                <a class="nav-link @if(@$tab == 'index') active @endif" href="{{ route('dealerUser.customer.show', ['id' => $id, 'tab' => 'index']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Müşteri Bilgileri</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(@$tab == 'service') active @endif" href="{{ route('dealerUser.customer.show', ['id' => $id, 'tab' => 'service']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Hizmetler</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(@$tab == 'ticket') active @endif" href="{{ route('dealerUser.customer.show', ['id' => $id, 'tab' => 'ticket']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Destek Talepleri</span>
                </a>
            </li>

        </ul>
    </div>
</div>
