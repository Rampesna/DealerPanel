@extends('dealerUser.layouts.master')
@section('title', 'Bayi Kullanıcıları')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('dealerUser.pages.dealer.show.layouts.subheader')

    @include('dealerUser.pages.dealer.show.dealerUser.modals.create')
    @include('dealerUser.pages.dealer.show.dealerUser.modals.edit')
    @include('dealerUser.pages.dealer.show.dealerUser.modals.delete')

    <input type="hidden" id="id_edit">
    <input type="hidden" id="encrypted_id_edit">
    <div class="row mt-15">
        <div class="col-xl-12">
            <div class="card" id="dealerUsersCard">
                <div class="card-body">
                    <table class="table" id="dealerUsers">
                        <thead>
                        <tr>
                            <th>Ad Soyad</th>
                            <th>E-posta Adresi</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Ad Soyad</th>
                            <th>E-posta Adresi</th>
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
            <a onclick="sendPassword()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-lock text-dark-75"></i><span class="ml-4">Şifre Gönder</span>
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
    @include('dealerUser.pages.dealer.show.dealerUser.components.style')
@stop

@section('page-script')
    @include('dealerUser.pages.dealer.show.dealerUser.components.script')
@stop
