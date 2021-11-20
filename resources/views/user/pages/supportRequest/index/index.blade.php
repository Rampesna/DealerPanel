@extends('user.layouts.master')
@section('title', 'Destek Talepleri')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    <input type="hidden" id="id_edit">
    <input type="hidden" id="encrypted_id_edit">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row text-center">
                        <a class="col border-right pb-4 pt-4 text-dark-75">
                            <i class="fas fa-clock fa-2x text-warning"></i><br>
                            <label class="mb-0 mr-5">Cevap Bekleyen</label>
                            <h4 id="waiting_span" class="font-30 font-weight-bold text-col-blue" style="font-size: 30px">--</h4>
                        </a>
                        <a class="col border-right pb-4 pt-4 text-dark-75">
                            <i class="fab fa-font-awesome-flag fa-2x text-primary"></i><br>
                            <label class="mb-0 mr-5">Cevaplanan</label>
                            <h4 id="answered_span" class="font-30 font-weight-bold text-col-blue" style="font-size: 30px">--</h4>
                        </a>
                        <a class="col pb-4 pt-4 text-dark-75">
                            <i class="fas fa-check-circle fa-2x text-success"></i><br>
                            <label class="mb-0 mr-5">Tamamlanan</label>
                            <h4 id="completed_span" class="font-30 font-weight-bold text-col-blue" style="font-size: 30px">--</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xl-12">
            <div class="card" id="supportRequestsCard">
                <div class="card-body">
                    <table class="table" id="supportRequests">
                        <thead>
                        <tr>
                            <th>Talep Bağlantısı</th>
                            <th>Talebi Açan</th>
                            <th>Talep Başlığı</th>
                            <th>Kategori</th>
                            <th>Öncelik</th>
                            <th>Durum</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Talep Bağlantısı</th>
                            <th>Talebi Açan</th>
                            <th>Talep Başlığı</th>
                            <th>Kategori</th>
                            <th>Öncelik</th>
                            <th>Durum</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="context-menu" style="width: 300px">
        <div id="EditingContexts">
            <a onclick="show()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-eye text-info"></i><span class="ml-4">İncele</span>
                    </div>
                </div>
            </a>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('user.pages.supportRequest.index.components.style')
@stop

@section('page-script')
    @include('user.pages.supportRequest.index.components.script')
@stop
