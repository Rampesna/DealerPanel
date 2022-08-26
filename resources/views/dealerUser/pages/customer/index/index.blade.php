@extends('dealerUser.layouts.master')
@section('title', 'Müşteriler')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('dealerUser.pages.customer.index.modals.create')

    <input type="hidden" id="id_edit">
    <input type="hidden" id="encrypted_id_edit">
    <div class="row">
        <div class="col-xl-12">
            <div class="card" id="customersCard">
                <div class="card-body">
                    <table class="table" id="customers">
                        <thead>
                        <tr>
                            <th>VKN/TCKN</th>
                            <th>Bayi</th>
                            <th>Müşteri Adı</th>
                            <th>E-posta</th>
                            <th>GSM</th>
                            <th>Şehir</th>
                            <th>Durum</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>VKN/TCKN</th>
                            <th>Bayi</th>
                            <th>Müşteri Adı</th>
                            <th>E-posta</th>
                            <th>GSM</th>
                            <th>Şehir</th>
                            <th>Durum</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="context-menu" style="width: 300px">
        <a onclick="create()" class="dropdown-item cursor-pointer">
            <div class="row">
                <div class="col-xl-12">
                    <i class="fas fa-plus-circle text-success"></i><span class="ml-4">Müşteri Ekle</span>
                </div>
            </div>
        </a>
        <div id="EditingContexts">
            <hr>
            <a onclick="show()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-eye text-info"></i><span class="ml-4">Müşteri Detayları</span>
                    </div>
                </div>
            </a>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('dealerUser.pages.customer.index.components.style')
@stop

@section('page-script')
    @include('dealerUser.pages.customer.index.components.script')
@stop
