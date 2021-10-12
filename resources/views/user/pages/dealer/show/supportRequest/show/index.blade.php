@extends('dealerUser.layouts.master')
@section('title', 'Talep Detayları')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="mr-3">
                                            <div class="d-flex align-items-center mr-3">
                                                <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3" id="nameSpan">--</a>
                                            </div>
                                            <div class="d-flex flex-wrap my-2">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap justify-content-between">
                                        <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5" id="descriptionSpan">--</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card card-custom">
                                        <div class="card-header h-auto py-4">
                                            <div class="card-title">
                                                <h3 class="card-label">
                                                    Detaylar
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="card-body py-4">
                                            <div class="form-group row my-2">
                                                <label class="col-6 col-form-label">Oluşturan:</label>
                                                <div class="col-6 text-right">
                                                    <span class="form-control-plaintext font-weight-bolder" id="creatorSpan">
                                                        --
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row my-2">
                                                <label class="col-6 col-form-label">Kategori:</label>
                                                <div class="col-6 text-right">
                                                    <span class="form-control-plaintext font-weight-bolder" id="categorySpan">
                                                        --
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row my-2">
                                                <label class="col-6 col-form-label">Öncelik:</label>
                                                <div class="col-6 text-right">
                                                    <span class="form-control-plaintext font-weight-bolder" id="prioritySpan">
                                                        --
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row my-2">
                                                <label class="col-6 col-form-label">Oluşturulma Tarihi:</label>
                                                <div class="col-6 text-right">
                                                    <span class="form-control-plaintext font-weight-bolder" id="createdAtSpan">
                                                        --
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row my-2">
                                                <label class="col-6 col-form-label">Durum:</label>
                                                <div class="col-6 text-right">
                                                    <span class="form-control-plaintext font-weight-bolder">
                                                        <span class="" id="statusSpan">
                                                            --
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row my-2">
                                                <label class="col-6 col-form-label"><i class="fa fa-paperclip mr-2"></i>Ekler: </label>
                                                <div class="col-6 text-right" id="filesSpan">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="CompleteButtons" style="display: none">
                                <hr>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <button class="btn btn-success btn-block" onclick="updateStatus(3)">Onayla/Sonlandır</button>
                                    </div>
                                    <div class="col-xl-6">
                                        <button class="btn btn-danger btn-block" onclick="updateStatus(4)">İptal Et</button>
                                    </div>
                                </div>
                            </div>
                            <div id="ReActivateButtons" style="display: none">
                                <hr>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <button class="btn btn-warning btn-block" onclick="updateStatus(1)">Talebi Tekrar Aktif Et</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-pane active" id="kt_apps_contacts_view_tab_1" role="tabpanel">
                                        <div class="container">
                                            <div id="CreateSupportRequestMessageForm" style="display: none">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <span class="mr-2"><i class="fa fa-paperclip mr-2"></i>Ekler: </span>
                                                        <input type="file" id="files_create" multiple>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="form-group">
                                                            <label style="width: 100%">
                                                                <textarea class="form-control form-control-lg form-control-solid" id="message_create" placeholder="Mesajınız..."></textarea>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-12 text-right mt-n5">
                                                        <button type="submit" class="btn btn-light-success font-weight-bold" id="CreateSupportRequestMessageButton">Yanıtla</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="separator separator-dashed my-10"></div>
                                            <div class="timeline timeline-3">
                                                <div class="timeline-items" id="timeline">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('dealerUser.pages.supportRequest.show.components.style')
@stop

@section('page-script')
    @include('dealerUser.pages.supportRequest.show.components.script')
@stop
