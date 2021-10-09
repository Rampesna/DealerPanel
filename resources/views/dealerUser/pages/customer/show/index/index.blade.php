@extends('dealerUser.layouts.master')
@section('title', 'Müşteri Bilgileri')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('dealerUser.pages.customer.show.layouts.subheader')

    <div class="row mt-15">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('dealerUser.pages.customer.show.index.components.style')
@stop

@section('page-script')
    @include('dealerUser.pages.customer.show.index.components.script')
@stop
