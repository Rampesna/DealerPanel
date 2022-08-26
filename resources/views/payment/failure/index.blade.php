@extends('payment.layouts.master')
@section('title', 'Ödeme Başarısız')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')



@endsection

@section('page-styles')
    @include('payment.failure.components.style')
@stop

@section('page-script')
    @include('payment.failure.components.script')
@stop
