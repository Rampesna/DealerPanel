@extends('user.layouts.master')
@section('title', 'Toplu İşlemler')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('user.pages.batchTransaction.modals.updateDealers')

    <div class="row">
        <div class="col-xl-2">
            <div class="form-group">
                <button class="btn btn-success btn-block" id="SelectAllButton">Tümünü Seç</button>
            </div>
        </div>
        <div class="col-xl-2">
            <div class="form-group">
                <button class="btn btn-dark-75 btn-block" id="DeSelectAllButton">Seçimleri Kaldır</button>
            </div>
        </div>
    </div>
    <hr class="mt-n5">
    <div class="row" id="customers"></div>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="context-menu" style="width: 300px">
        <a onclick="updateDealersModalTrigger()" class="dropdown-item cursor-pointer">
            <div class="row">
                <div class="col-xl-12">
                    <i class="fas fa-angle-double-right text-success"></i><span class="ml-4">Bayi Ataması Yap</span>
                </div>
            </div>
        </a>
    </div>

@endsection

@section('page-styles')
    @include('user.pages.batchTransaction.components.style')
@stop

@section('page-script')
    @include('user.pages.batchTransaction.components.script')
@stop
