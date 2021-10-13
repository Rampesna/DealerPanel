@extends('customer.layouts.master')
@section('title', 'Kontör Yönetimi')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('customer.pages.credit.modals.create')

    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header pt-4 pb-3">
                    <div class="row">
                        <div class="col-xl-8">
                            <h5>Kontör Bilgileri</h5>
                        </div>
                        <div class="col-xl-4 text-right">
                            <button type="button" class="btn btn-sm btn-primary mt-n2 mr-n6" data-toggle="modal" data-target="#CreateModal">Kontör Yükle</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <label class="col-6 col-form-label">Toplam Alınan Kontör:</label>
                        <div class="col-6 text-right">
                            <span class="form-control-plaintext font-weight-bolder" id="creatorSpan">
                                {{ \App\Models\Credit::where('relation_type', 'App\\Models\\Customer')->where('relation_id', auth()->id())->sum('amount') }}
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
    @include('customer.pages.credit.components.style')
@stop

@section('page-script')
    @include('customer.pages.credit.components.script')
@stop
