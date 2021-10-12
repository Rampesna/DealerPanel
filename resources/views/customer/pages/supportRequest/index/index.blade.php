@extends('customer.layouts.master')
@section('title', 'Destek Taleplerim')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('customer.pages.supportRequest.index.modals.create')

    <input type="hidden" id="id_edit">
    <input type="hidden" id="encrypted_id_edit">
    <div class="row">
        <div class="col-xl-12">
            <div class="card" id="supportRequestsCard">
                <div class="card-body">
                    <table class="table" id="supportRequests">
                        <thead>
                        <tr>
                            <th>Talep Başlığı</th>
                            <th>Kategori</th>
                            <th>Öncelik</th>
                            <th>Durum</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Talep Başlığı</th>
                            <th>Kategori</th>
                            <th>Öncelik</th>
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
                    <i class="fas fa-plus-circle text-success"></i><span class="ml-4">Yeni Oluştur</span>
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
        </div>
    </div>

@endsection

@section('page-styles')
    @include('customer.pages.supportRequest.index.components.style')
@stop

@section('page-script')
    @include('customer.pages.supportRequest.index.components.script')
@stop
