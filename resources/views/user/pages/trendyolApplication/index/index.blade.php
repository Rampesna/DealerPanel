@extends('user.layouts.master')
@section('title', 'Trendyol Başvuruları')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('user.pages.trendyolApplication.index.components.contextMenu')

    @include('user.pages.trendyolApplication.index.modals.updateStatus')

    <input type="hidden" id="selected_id">
    <div class="row">
        <div class="col-xl-12">
            <div id="corporates"></div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('user.pages.trendyolApplication.index.components.style')
@stop

@section('page-script')
    @include('user.pages.trendyolApplication.index.components.script')
@stop
