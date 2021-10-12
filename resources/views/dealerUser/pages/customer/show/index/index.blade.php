@extends('dealerUser.layouts.master')
@section('title', 'Müşteri Bilgileri')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('dealerUser.pages.customer.show.layouts.subheader')

    @include('dealerUser.pages.customer.show.index.modals.create')

    <div class="row mt-15">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header pt-4 pb-3">
                    <div class="row">
                        <div class="col-xl-8">
                            <h5>Kontör Bilgileri</h5>
                        </div>
                        <div class="col-xl-4 text-right">
                            <button type="button" class="btn btn-sm btn-primary mt-n2 mr-n6" data-toggle="modal" data-target="#AddCreditModal">Kontör Yükle</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <label class="col-6 col-form-label">Toplam Alınan Kontör:</label>
                        <div class="col-6 text-right">
                            <span class="form-control-plaintext font-weight-bolder" id="creatorSpan">
                                --
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-6 col-form-label">Toplam Kullanılan Kontör:</label>
                        <div class="col-6 text-right">
                            <span class="form-control-plaintext font-weight-bolder" id="creatorSpan">
                                --
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-6 col-form-label">Kalan Kontör:</label>
                        <div class="col-6 text-right">
                            <span class="form-control-plaintext font-weight-bolder" id="creatorSpan">
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
    @include('dealerUser.pages.customer.show.index.components.style')
@stop

@section('page-script')
    @include('dealerUser.pages.customer.show.index.components.script')
@stop
