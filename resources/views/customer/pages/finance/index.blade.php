@extends('customer.layouts.master')
@section('title', 'Finans Yönetimi')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header pt-4 pb-3">
                    <h5>Finansal Veriler</h5>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('customer.pages.finance.components.style')
@stop

@section('page-script')
    @include('customer.pages.finance.components.script')
@stop
