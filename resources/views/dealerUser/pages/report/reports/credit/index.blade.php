@extends('dealerUser.layouts.master')
@section('title', 'Müşteri Kontör Raporu')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    <input type="hidden" id="id_edit">
    <input type="hidden" id="encrypted_id_edit">
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
    @include('dealerUser.pages.report.reports.credit.components.style')
@stop

@section('page-script')
    @include('dealerUser.pages.report.reports.credit.components.script')
@stop
