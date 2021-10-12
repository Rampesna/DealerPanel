@extends('dealerUser.layouts.master')
@section('title', 'Finansal İşlemler')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header pt-4 pb-3">
                    <h5>Kontör Bilgileri</h5>
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
    @include('dealerUser.pages.finance.components.style')
@stop

@section('page-script')
    @include('dealerUser.pages.finance.components.script')
@stop
