@extends('user.layouts.master')
@section('title', 'Müşteri Bilgileri')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('user.pages.customer.show.layouts.subheader')

    @include('user.pages.customer.show.index.modals.addRelationService')
    @include('user.pages.customer.show.index.modals.showPaymentLink')
    @include('user.pages.customer.show.index.modals.addReceipt')
    @include('user.pages.customer.show.index.modals.edit')

    <input type="hidden" id="id_edit">
    <div class="row mt-15">
        <div class="col-xl-4 mb-5">
            <div class="card">
                <div class="card-header pt-4 pb-3">
                    <div class="row">
                        <div class="col-xl-8">
                            <h5>Müşteri Bilgileri</h5>
                        </div>
                        <div class="col-xl-4 text-right">
                            <button class="btn btn-sm btn-primary mr-n4" id="EditButton">Düzenle</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>Bayi</div>
                        <div id="dealer_id_span">--</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Ünvan</div>
                        <div id="name_span">--</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Vergi Numarası</div>
                        <div id="tax_number_span">--</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Aktivasyon Tarihi</div>
                        <div id="activation_date_span">--</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Vergi Dairesi</div>
                        <div id="tax_office_span">--</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>E-posta Adresi</div>
                        <div id="email_span">--</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>GSM</div>
                        <div id="gsm_span">--</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Website</div>
                        <div id="website_span">--</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Kuruluş Tarihi</div>
                        <div id="foundation_date_span">--</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Ülke</div>
                        <div id="country_id_span">--</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Şehir</div>
                        <div id="province_id_span">--</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>İlçe</div>
                        <div id="district_id_span">--</div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>Fatura Gönderim Durumu</div>
                        <div id="invoice_send_status_span">--</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 mb-5">
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
                                <i class="fas fa-spinner fa-spin"></i>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-6 col-form-label">Toplam Kullanılan Kontör:</label>
                        <div class="col-6 text-right">
                            <span class="form-control-plaintext font-weight-bolder" id="usedCreditSpan">
                                <i class="fas fa-spinner fa-spin"></i>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-6 col-form-label">Kalan Kontör:</label>
                        <div class="col-6 text-right">
                            <span class="form-control-plaintext font-weight-bolder" id="remainingCreditSpan">
                                <i class="fas fa-spinner fa-spin"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 mb-5">
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
