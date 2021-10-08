@extends('dealer.layouts.master')
@section('title', 'Kontrol Paneli')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    Bayi Paneli

@endsection

@section('page-styles')
    @include('dealer.pages.dashboard.components.style')
@stop

@section('page-script')
    @include('dealer.pages.dashboard.components.script')
@stop
