@extends('dealerUser.layouts.master')
@section('title', 'Müşteri Kontör Raporu')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('dealerUser.pages.customer.show.layouts.subheader')

    @include('dealerUser.pages.customer.show.credit.modals.creditDetail')

    <div class="row mt-15">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header pt-4 pb-3 text-center">
                    <h6>Toplam Alınan Kontör</h6>
                </div>
                <div class="card-body text-center pt-5 pb-4">
                    <h3 class="text-primary" id="totalSpan">--</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header pt-4 pb-3 text-center">
                    <h6>Toplam Harcanan Kontör</h6>
                </div>
                <div class="card-body text-center pt-5 pb-4">
                    <h3 class="text-danger" id="usedSpan">--</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header pt-4 pb-3 text-center">
                    <h6>Toplam Kalan Kontör</h6>
                </div>
                <div class="card-body text-center pt-5 pb-4">
                    <h3 class="text-success" id="remainingSpan">--</h3>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <input type="hidden" id="id_edit">
    <input type="hidden" id="encrypted_id_edit">
    <div class="row">
        <div class="col-xl-12">
            <div id="usages"></div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('dealerUser.pages.customer.show.credit.components.style')
@stop

@section('page-script')
    @include('dealerUser.pages.customer.show.credit.components.script')
@stop
