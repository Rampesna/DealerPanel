@extends('user.layouts.master')
@section('title', 'Müşteri Bilgileri')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('user.pages.customer.show.layouts.subheader')

    @include('user.pages.customer.show.index.modals.addRelationService')
    @include('user.pages.customer.show.index.modals.addReceipt')

    <div class="row mt-15">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header pt-4 pb-3">
                    <div class="row">
                        <div class="col-xl-8">
                            <h5>Kontör Bilgileri</h5>
                        </div>
                        <div class="col-xl-4 text-right">
                            <button type="button" class="btn btn-sm btn-primary mt-n2 mr-n6" data-toggle="modal" data-target="#AddRelationServiceModal">Kontör Yükle</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <label class="col-6 col-form-label">Toplam Alınan Kontör:</label>
                        <div class="col-6 text-right">
                            <span class="form-control-plaintext font-weight-bolder" id="totalCreditSpan">
                                --
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-6 col-form-label">Toplam Kullanılan Kontör:</label>
                        <div class="col-6 text-right">
                            <span class="form-control-plaintext font-weight-bolder" id="usedCreditSpan">
                                --
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-6 col-form-label">Kalan Kontör:</label>
                        <div class="col-6 text-right">
                            <span class="form-control-plaintext font-weight-bolder" id="remainingCreditSpan">
                                --
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header pt-4 pb-3">
                    <div class="row">
                        <div class="col-xl-8">
                            <h5>Finans Bilgileri</h5>
                        </div>
                        <div class="col-xl-4 text-right">
                            <button type="button" class="btn btn-sm btn-primary mt-n2 mr-n6" data-toggle="modal" data-target="#AddReceiptModal">Ödeme Al</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <label class="col-6 col-form-label">Toplam Borç:</label>
                        <div class="col-6 text-right">
                            <span class="form-control-plaintext font-weight-bolder" id="outgoingSpan">
                                --
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-6 col-form-label">Toplam Ödeme:</label>
                        <div class="col-6 text-right">
                            <span class="form-control-plaintext font-weight-bolder" id="incomingSpan">
                                --
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-6 col-form-label">Bakiye:</label>
                        <div class="col-6 text-right">
                            <span class="form-control-plaintext font-weight-bolder" id="balance">
                                --
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('user.pages.customer.show.index.components.style')
@stop

@section('page-script')
    @include('user.pages.customer.show.index.components.script')
@stop
