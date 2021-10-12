<div class="subheader subheader-solid" id="kt_subheader">
    <div class="container-fluid align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <ul class="nav nav-tabs nav-tabs-line mb-n4">

            <li class="nav-item">
                <a class="nav-link @if(@$tab == 'customer') active @endif" href="{{ route('dealerUser.waitingTransaction.show', ['tab' => 'customer']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Müşteri</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(@$tab == 'credit') active @endif" href="{{ route('dealerUser.waitingTransaction.show', ['tab' => 'credit']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Kontör</span>
                </a>
            </li>

        </ul>
    </div>
</div>
