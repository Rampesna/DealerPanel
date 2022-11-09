@extends('user.layouts.master')
@section('title', 'Müşteri Hizmet Raporu')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    <div class="row text-center">
        <div class="col-xl-12">
            <div id="report"></div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-xl-12 text-right">
            <button class="btn btn-primary" id="DownloadExcelButton" style="display: none">Excel İndir</button>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('user.pages.log.index.components.style')
@stop

@section('page-script')
    @include('user.pages.log.index.components.script')
@stop
