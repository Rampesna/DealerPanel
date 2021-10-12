@extends('user.layouts.master')
@section('title', 'Müşteri Destek Talepleri')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('user.pages.customer.show.layouts.subheader')

    <input type="hidden" id="id_edit">
    <input type="hidden" id="encrypted_id_edit">
    <div class="row mt-15">
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
        <div id="EditingContexts">
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
    @include('user.pages.customer.show.supportRequest.components.style')
@stop

@section('page-script')
    @include('user.pages.customer.show.supportRequest.components.script')
@stop
