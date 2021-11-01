@extends('dealerUser.layouts.master')
@section('title', 'Bayiler')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('dealerUser.pages.dealer.index.modals.create')
    @include('dealerUser.pages.dealer.index.modals.edit')
    @include('dealerUser.pages.dealer.index.modals.delete')

    <input type="hidden" id="id_edit">
    <input type="hidden" id="encrypted_id_edit">
    <div class="row">
        <div class="col-xl-12">
            <div class="card" id="dealersCard">
                <div class="card-body">
                    <table class="table" id="dealers">
                        <thead>
                        <tr>
                            <th>Vergi Numarası</th>
                            <th>Üst Bayi</th>
                            <th>Ünvan</th>
                            <th>Durum</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Vergi Numarası</th>
                            <th>Üst Bayi</th>
                            <th>Ünvan</th>
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
                    <i class="fas fa-plus-circle text-success"></i><span class="ml-4">Alt Bayi Oluştur</span>
                </div>
            </div>
        </a>
        <div id="EditingContexts">
            <div id="ShowContext">
                <hr>
                <a onclick="show()" class="dropdown-item cursor-pointer">
                    <div class="row">
                        <div class="col-xl-12">
                            <i class="fas fa-eye text-info"></i><span class="ml-4">İncele</span>
                        </div>
                    </div>
                </a>
            </div>
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
    @include('dealerUser.pages.dealer.index.components.style')
@stop

@section('page-script')
    @include('dealerUser.pages.dealer.index.components.script')
@stop
