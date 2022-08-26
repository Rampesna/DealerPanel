@extends('payment.layouts.master')
@section('title', 'Ödeme Onayı')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    <div class="container">
        <div class="row mb-15">
            <div class="col-xl-4"></div>
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <img src="{{ asset('assets/media/logos/bien.png') }}" alt="Bien" style="width: 150px; height: auto">
                    </div>
                </div>
            </div>
            <div class="col-xl-4"></div>
        </div>
        <div class="row">
            <div class="col-xl-4"></div>
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <h3>{{ $payment->relation->name }}</h3>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="d-flex justify-content-between">
                            <div>Ödenecek Tutar: </div>
                            <div class="font-weight-bolder font-size-h4">{{ number_format($payment->amount, 2) }} ₺</div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label class="font-weight-bolder" for="creditCardHolderName">Kartın Üzerindeki İsim</label>
                            <input id="creditCardHolderName" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label class="font-weight-bolder" for="creditCardNumber">Kart Numarası</label>
                            <input id="creditCardNumber" type="text" class="form-control creditCardMask">
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label class="font-weight-bolder" for="creditCardMonth">Ay</label>
                            <select id="creditCardMonth" class="form-control selectpicker" title="Ay">
                                <option value="" selected hidden disabled></option>
                                @for($month = 1; $month <= 12; $month++)
                                    <option value="{{ $month }}">{{ $month }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label class="font-weight-bolder" for="creditCardYear">Yıl</label>
                            <select id="creditCardYear" class="form-control selectpicker" title="Yıl">
                                <option value="" selected hidden disabled></option>
                                @for($year = intval(date('Y')); $year <= (intval(date('Y')) + 12); $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label class="font-weight-bolder" for="creditCardCvc">CVV</label>
                            <input id="creditCardCvc" type="text" class="form-control cvvMask">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-12 text-right">
                        <button class="btn btn-sm btn-success" id="PaymentButton">Ödeme Yap</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-4"></div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('payment.gateway.components.style')
@stop

@section('page-script')
    @include('payment.gateway.components.script')
@stop
