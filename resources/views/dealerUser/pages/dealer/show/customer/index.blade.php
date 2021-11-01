@extends('dealerUser.layouts.master')
@section('title', 'Bayi Müşterileri')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('dealerUser.pages.dealer.show.layouts.subheader')

    @include('dealerUser.pages.dealer.show.customer.modals.create')
    @include('dealerUser.pages.dealer.show.customer.modals.edit')
    @include('dealerUser.pages.dealer.show.customer.modals.delete')

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
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Vergi Numarası</th>
                            <th>Bayi</th>
                            <th>Ünvan</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('dealerUser.pages.dealer.show.customer.components.style')
@stop

@section('page-script')
    @include('dealerUser.pages.dealer.show.customer.components.script')
@stop
