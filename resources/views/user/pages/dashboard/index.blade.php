@extends('user.layouts.master')
@section('title', 'Kontrol Paneli')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')



@endsection

@section('page-styles')
    @include('user.pages.dashboard.components.style')
@stop

@section('page-script')
    @include('user.pages.dashboard.components.script')
@stop
