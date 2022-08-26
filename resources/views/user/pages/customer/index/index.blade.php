@extends('user.layouts.master')
@section('title', 'Müşteriler')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('user.pages.customer.index.modals.create')
    @include('user.pages.customer.index.modals.importWithExcel')
    @include('user.pages.customer.index.modals.edit')
    @include('user.pages.customer.index.modals.delete')

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
                    <i class="fas fa-plus-circle text-success"></i><span class="ml-4">Müşteri Oluştur</span>
                </div>
            </div>
        </a>
        <a onclick="importWithExcel()" class="dropdown-item cursor-pointer">
            <div class="row">
                <div class="col-xl-12">
                    <i class="fas fa-file-excel text-success"></i><span class="ml-4">Excel İle İçe Aktar</span>
                </div>
            </div>
        </a>
        <div id="EditingContexts">
            <hr>
            <a onclick="show()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-eye text-info"></i><span class="ml-4">İncele</span>
                    </div>
                </div>
            </a>
            <hr>
            <a onclick="edit()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-pen text-primary"></i><span class="ml-4">Düzenle</span>
                    </div>
                </div>
            </a>
            <a onclick="drop()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-trash-alt text-danger"></i><span class="ml-4">Sil</span>
                    </div>
                </div>
            </a>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('user.pages.customer.index.components.style')
@stop

@section('page-script')
    @include('user.pages.customer.index.components.script')
@stop
