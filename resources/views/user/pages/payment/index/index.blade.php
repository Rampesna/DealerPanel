@extends('user.layouts.master')
@section('title', 'Onaylanan Ödemeler')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    <input type="hidden" id="selected_id">
    <div class="row">
        <div class="col-xl-12">
            <div id="payments"></div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('user.pages.payment.index.components.style')
@stop

@section('page-script')
    @include('user.pages.payment.index.components.script')
@stop
