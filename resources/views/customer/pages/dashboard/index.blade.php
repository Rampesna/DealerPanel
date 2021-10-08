@extends('customer.layouts.master')
@section('title', 'Kontrol Paneli')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    Müşteri Paneli

@endsection

@section('page-styles')
    @include('customer.pages.dashboard.components.style')
@stop

@section('page-script')
    @include('customer.pages.dashboard.components.script')
@stop
