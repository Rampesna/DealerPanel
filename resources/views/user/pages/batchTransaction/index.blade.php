@extends('user.layouts.master')
@section('title', 'Toplu İşlemler')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    <div class="row">
        <div class="col-xl-4">
            <div class="form-group">
                <label style="width: 100%">
                    <input type="text" class="form-control" placeholder="Arayın...">
                </label>
            </div>
        </div>
        <div class="col-xl-2">
            <div class="form-group">
                <button class="btn btn-success btn-block">Tümünü Seç</button>
            </div>
        </div>
        <div class="col-xl-2">
            <div class="form-group">
                <button class="btn btn-dark-75 btn-block">Seçimleri Kaldır</button>
            </div>
        </div>
    </div>
    <hr class="mt-n5">
    <div class="row" id="customers"></div>

@endsection

@section('page-styles')
    @include('user.pages.batchTransaction.components.style')
@stop

@section('page-script')
    @include('user.pages.batchTransaction.components.script')
@stop
