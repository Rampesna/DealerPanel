@extends('user.layouts.master')
@section('title', 'Müşteri Kontör Raporu')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    <input type="hidden" id="id_edit">
    <input type="hidden" id="encrypted_id_edit">
    <div class="row">
        <div class="col-xl-12">
            <div class="card" id="customersCard">
                <div class="card-body">
                    <table class="table" id="customers">
                        <thead>
                        <tr>
                            <th>Vergi Numarası</th>
                            <th>Ünvan</th>
                            <th>Toplam Alınan Kontör</th>
                            <th>Toplam Harcanan Kontör</th>
                            <th>Kalan Kontör</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Vergi Numarası</th>
                            <th>Ünvan</th>
                            <th>Toplam Alınan Kontör</th>
                            <th>Toplam Harcanan Kontör</th>
                            <th>Kalan Kontör</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('user.pages.report.reports.credit.components.style')
@stop

@section('page-script')
    @include('user.pages.report.reports.credit.components.script')
@stop
