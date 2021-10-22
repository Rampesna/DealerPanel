<div class="subheader subheader-solid" id="kt_subheader">
    <div class="container-fluid align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <ul class="nav nav-tabs nav-tabs-line mb-n4">

            <li class="nav-item">
                <a class="nav-link @if(@$tab == 'index') active @endif" href="{{ route('user.customer.show', ['id' => $id, 'tab' => 'index']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Müşteri Bilgileri</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(@$tab == 'service') active @endif" href="{{ route('user.customer.show', ['id' => $id, 'tab' => 'service']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Hizmetler</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(@$tab == 'contract') active @endif" href="{{ route('user.customer.show', ['id' => $id, 'tab' => 'contract']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Sözleşmeler</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(@$tab == 'credit') active @endif" href="{{ route('user.customer.show', ['id' => $id, 'tab' => 'credit']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Kontör Raporu</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(@$tab == 'finance') active @endif" href="{{ route('user.customer.show', ['id' => $id, 'tab' => 'finance']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Finans Raporu</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(@$tab == 'supportRequest') active @endif" href="{{ route('user.customer.show', ['id' => $id, 'tab' => 'supportRequest']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Destek Talepleri</span>
                </a>
            </li>

        </ul>
    </div>
</div>
