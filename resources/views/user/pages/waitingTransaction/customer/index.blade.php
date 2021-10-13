@extends('user.layouts.master')
@section('title', 'Onay Bekleyen Müşteriler')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('user.pages.waitingTransaction.layouts.subheader')

    @include('user.pages.waitingTransaction.customer.modals.accept')

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

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="context-menu" style="width: 300px">
        <div id="EditingContexts">
            <a onclick="accept()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-check-circle text-success"></i><span class="ml-4">Onayla</span>
                    </div>
                </div>
            </a>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('user.pages.waitingTransaction.customer.components.style')
@stop

@section('page-script')
    @include('user.pages.waitingTransaction.customer.components.script')
@stop
