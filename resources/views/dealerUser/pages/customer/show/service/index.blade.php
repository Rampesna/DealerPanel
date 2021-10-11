@extends('dealerUser.layouts.master')
@section('title', 'Müşteri Hizmetleri')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('dealerUser.pages.customer.show.layouts.subheader')

    <div class="row mt-15">
        <div class="col-xl-12">
            <div class="card" id="servicesCard">
                <div class="card-body">
                    <table class="table" id="services">
                        <thead>
                        <tr>
                            <th>Hizmet Adı</th>
                            <th>Başlangıç</th>
                            <th>Bitiş</th>
                            <th>Tutar</th>
                            <th>Durum</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Hizmet Adı</th>
                            <th>Başlangıç</th>
                            <th>Bitiş</th>
                            <th>Tutar</th>
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
                    <i class="fas fa-plus-circle text-success"></i><span class="ml-4">Hizmet Ekle</span>
                </div>
            </div>
        </a>
        <div id="EditingContexts">
            <hr>
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
    @include('dealerUser.pages.customer.show.service.components.style')
@stop

@section('page-script')
    @include('dealerUser.pages.customer.show.service.components.script')
@stop
