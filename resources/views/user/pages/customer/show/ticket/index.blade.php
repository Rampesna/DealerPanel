@extends('user.layouts.master')
@section('title', 'Müşteri Destek Talepleri')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('user.pages.customer.show.layouts.subheader')

    <div class="row mt-15">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    {{ $id }}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('user.pages.customer.show.ticket.components.style')
@stop

@section('page-script')
    @include('user.pages.customer.show.ticket.components.script')
@stop
