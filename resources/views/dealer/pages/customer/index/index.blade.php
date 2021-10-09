@extends('dealer.layouts.master')
@section('title', 'Müşteriler')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card" id="customersCard">
                <div class="card-body">
                    <table class="table" id="customers">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Müşteri Adı</th>
                            <th>VKN/TCKN</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Müşteri Adı</th>
                            <th>VKN/TCKN</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('dealer.pages.customer.index.components.style')
@stop

@section('page-script')
    @include('dealer.pages.customer.index.components.script')
@stop
