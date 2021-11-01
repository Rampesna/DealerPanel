@extends('user.layouts.master')
@section('title', 'Bayi Müşterileri')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('user.pages.dealer.show.layouts.subheader')

    @include('user.pages.dealer.show.customer.modals.create')
    @include('user.pages.dealer.show.customer.modals.edit')
    @include('user.pages.dealer.show.customer.modals.delete')

    <div class="row mt-15">
        <div class="col-xl-12">
            <div class="card" id="customersCard">
                <div class="card-body">
                    <table class="table" id="customers">
                        <thead>
                        <tr>
                            <th>Vergi Numarası</th>
                            <th>Bayi</th>
                            <th>Ünvan</th>
                            <th>E-posta</th>
                            <th>GSM</th>
                            <th>Şehir</th>
                            <th>Kalan Kontör</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Vergi Numarası</th>
                            <th>Bayi</th>
                            <th>Ünvan</th>
                            <th>E-posta</th>
                            <th>GSM</th>
                            <th>Şehir</th>
                            <th>Kalan Kontör</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('user.pages.dealer.show.customer.components.style')
@stop

@section('page-script')
    @include('user.pages.dealer.show.customer.components.script')
@stop
