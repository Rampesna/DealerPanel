@extends('dealerUser.layouts.master')
@section('title', 'Kontrol Paneli')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    Bayi Paneli

@endsection

@section('page-styles')
    @include('dealerUser.pages.dashboard.components.style')
@stop

@section('page-script')
    @include('dealerUser.pages.dashboard.components.script')
@stop
