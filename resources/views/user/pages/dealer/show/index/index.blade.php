@extends('user.layouts.master')
@section('title', 'Bayi Bilgileri')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('user.pages.dealer.show.layouts.subheader')

    @include('user.pages.dealer.show.index.modals.create')
    @include('user.pages.dealer.show.index.modals.edit')
    @include('user.pages.dealer.show.index.modals.delete')

    <input type="hidden" id="dealer_id_edit">
    <div class="row mt-15">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header pt-4 pb-3">
                    <h6>Bayi Hiyerarşisi</h6>
                </div>
                <div class="card-body">
                    <div id="jsTree"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="context-menu" style="width: 300px">
        <div id="CompanyContexts">
            <a onclick="edit()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="far fa-dot-circle text-primary"></i><span class="ml-4">Düzenle</span>
                    </div>
                </div>
            </a>
            <hr>
            <a onclick="create()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-plus-circle text-success"></i><span class="ml-4">Alt Bayi Ekle</span>
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
    @include('user.pages.dealer.show.index.components.style')
@stop

@section('page-script')
    @include('user.pages.dealer.show.index.components.script')
@stop
