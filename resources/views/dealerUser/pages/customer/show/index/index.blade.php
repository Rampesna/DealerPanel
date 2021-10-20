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
                            <h5>Müşteri Bilgileri</h5>
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
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header pt-4 pb-3">
                    <div class="row">
                        <div class="col-xl-8">
                            <h5>Kontör Bilgileri</h5>
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
    </div>

@endsection

@section('page-styles')
    @include('dealerUser.pages.customer.show.index.components.style')
@stop

@section('page-script')
    @include('dealerUser.pages.customer.show.index.components.script')
@stop
