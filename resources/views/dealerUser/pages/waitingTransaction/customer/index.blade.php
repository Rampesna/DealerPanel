@extends('dealerUser.layouts.master')
@section('title', 'Onay Bekleyen Müşteriler')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('dealerUser.pages.waitingTransaction.layouts.subheader')

    <input type="hidden" id="id_edit">
    <input type="hidden" id="encrypted_id_edit">
    <div class="row mt-15">
        <div class="col-xl-12">
            <div class="card" id="customersCard">
                <div class="card-body">
                    <table class="table" id="customers">
                        <thead>
                        <tr>
                            <th>Vergi Numarası</th>
                            <th>Ünvan</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Vergi Numarası</th>
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
    @include('dealerUser.pages.waitingTransaction.customer.components.style')
@stop

@section('page-script')
    @include('dealerUser.pages.waitingTransaction.customer.components.script')
@stop
