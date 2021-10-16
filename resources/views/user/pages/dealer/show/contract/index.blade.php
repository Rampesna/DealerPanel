@extends('user.layouts.master')
@section('title', 'Sözleşmeler')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('user.pages.dealer.show.layouts.subheader')

    @include('user.pages.dealer.show.contract.modals.create')
    @include('user.pages.dealer.show.contract.modals.edit')
    @include('user.pages.dealer.show.contract.modals.delete')

    <input type="hidden" id="id_edit">
    <input type="hidden" id="encrypted_id_edit">
    <div class="row mt-15">
        <div class="col-xl-12">
            <div class="card" id="contractsCard">
                <div class="card-body">
                    <table class="table" id="contracts">
                        <thead>
                        <tr>
                            <th>Sözleşme Numarası</th>
                            <th>Başlangıç</th>
                            <th>Bitiş</th>
                            <th>Durum</th>
                            <th>Açıklamalar</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Sözleşme Numarası</th>
                            <th>Başlangıç</th>
                            <th>Bitiş</th>
                            <th>Durum</th>
                            <th>Açıklamalar</th>
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
                    <i class="fas fa-plus-circle text-success"></i><span class="ml-4">Yeni Sözleşme Oluştur</span>
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
    @include('user.pages.dealer.show.contract.components.style')
@stop

@section('page-script')
    @include('user.pages.dealer.show.contract.components.script')
@stop
