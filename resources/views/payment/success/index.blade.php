@extends('payment.layouts.master')
@section('title', 'Ödeme Başarılı')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')



@endsection

@section('page-styles')
    @include('payment.success.components.style')
@stop

@section('page-script')
    @include('payment.success.components.script')
@stop
