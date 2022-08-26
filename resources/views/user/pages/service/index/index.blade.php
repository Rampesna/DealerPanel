@extends('user.layouts.master')
@section('title', 'Hizmetler')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('user.pages.service.index.modals.create')
    @include('user.pages.service.index.modals.edit')
    @include('user.pages.service.index.modals.delete')

    <input type="hidden" id="id_edit">
    <input type="hidden" id="encrypted_id_edit">
    <div class="row">
        <div class="col-xl-12">
            <div class="card" id="servicesCard">
                <div class="card-body">
                    <table class="table" id="services">
                        <thead>
                        <tr>
                            <th>Paket Adı</th>
                            <th>Paketteki Kontör Sayısı</th>
                            <th>Paket Fiyatı</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Paket Adı</th>
                            <th>Paketteki Kontör Sayısı</th>
                            <th>Paket Fiyatı</th>
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
                    <i class="fas fa-plus-circle text-success"></i><span class="ml-4">Oluştur</span>
                </div>
            </div>
        </a>
        <div id="EditingContexts">
            <hr>
            <a onclick="edit()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-pen text-primary"></i><span class="ml-4">Düzenle</span>
                    </div>
                </div>
            </a>
            <a onclick="drop()" class="dropdown-item cursor-pointer" id="DeleteContext">
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
    @include('user.pages.service.index.components.style')
@stop

@section('page-script')
    @include('user.pages.service.index.components.script')
@stop
