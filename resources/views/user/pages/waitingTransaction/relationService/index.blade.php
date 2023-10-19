@extends('user.layouts.master')
@section('title', 'Onay Bekleyen Hizmetler')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('user.pages.waitingTransaction.layouts.subheader')

    @include('user.pages.waitingTransaction.relationService.modals.accept')
    @include('user.pages.waitingTransaction.relationService.modals.reject')

    <input type="hidden" id="id_edit">
    <input type="hidden" id="encrypted_id_edit">
    <div class="row mt-15">
        <div class="col-xl-12">
            <div class="card" id="relationServicesCard">
                <div class="card-body">
                    <table class="table" id="relationServices">
                        <thead>
                        <tr>
                            <th>Bağlantı Türü</th>
                            <th>Bağlantı</th>
                            <th>Adet</th>
                            <th>Hizmet</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Bağlantı Türü</th>
                            <th>Bağlantı</th>
                            <th>Adet</th>
                            <th>Hizmet</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="context-menu" style="width: 300px">
        <div id="EditingContexts">
            <a onclick="accept()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-check-circle text-success"></i><span class="ml-4">Onayla</span>
                    </div>
                </div>
            </a>
            <a onclick="reject()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-times-circle text-danger"></i><span class="ml-4">Reddet</span>
                    </div>
                </div>
            </a>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('user.pages.waitingTransaction.relationService.components.style')
@stop

@section('page-script')
    @include('user.pages.waitingTransaction.relationService.components.script')
@stop
