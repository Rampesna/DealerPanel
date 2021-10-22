@extends('dealerUser.layouts.master')
@section('title', 'Finans Yönetimi')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('dealerUser.pages.finance.modals.create')

    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header pt-4 pb-3 text-center">
                    <h6>Toplam Borç</h6>
                </div>
                <div class="card-body text-center pt-5 pb-4">
                    <h3 class="text-danger" id="outgoingSpan">--</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header pt-4 pb-3 text-center">
                    <h6>Toplam Ödeme</h6>
                </div>
                <div class="card-body text-center pt-5 pb-4">
                    <h3 class="text-success" id="incomingSpan">--</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header pt-4 pb-3 text-center">
                    <h6>Bakiye</h6>
                </div>
                <div class="card-body text-center pt-5 pb-4">
                    <h3 class="text-warning" id="balanceSpan">--</h3>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xl-12">
            <div class="card" id="receiptsCard">
                <div class="card-body">
                    <table class="table" id="receipts">
                        <thead>
                        <tr>
                            <th>İşlem Tarihi</th>
                            <th>Bağlı Hizmet</th>
                            <th>Tutar</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>İşlem Tarihi</th>
                            <th>Bağlı Hizmet</th>
                            <th>Tutar</th>
                            <th>İşlem</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('dealerUser.pages.finance.components.style')
@stop

@section('page-script')
    @include('dealerUser.pages.finance.components.script')
@stop
