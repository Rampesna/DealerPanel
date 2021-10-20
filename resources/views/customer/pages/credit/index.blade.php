@extends('customer.layouts.master')
@section('title', 'Kontör Yönetimi')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('customer.pages.credit.modals.create')

    <div class="row">
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
    <div class="row">
        <div class="col-xl-12">
            <div class="card" id="creditsCard">
                <div class="card-body">
                    <table class="table" id="credits">
                        <thead>
                        <tr>
                            <th>İşlem Tarihi</th>
                            <th>Bağlı Hizmet</th>
                            <th>Miktar</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>İşlem Tarihi</th>
                            <th>Bağlı Hizmet</th>
                            <th>Miktar</th>
                            <th>İşlem</th>
                        </tr>
                        </tfoot>
                    </table>
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
