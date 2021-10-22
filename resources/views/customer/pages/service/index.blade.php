@extends('customer.layouts.master')
@section('title', 'Hizmetlerim')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card" id="servicesCard">
                <div class="card-body">
                    <table class="table" id="services">
                        <thead>
                        <tr>
                            <th>Hizmet Adı</th>
                            <th>Başlangıç</th>
                            <th>Bitiş</th>
                            <th>Miktar</th>
                            <th>Durum</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Hizmet Adı</th>
                            <th>Başlangıç</th>
                            <th>Bitiş</th>
                            <th>Miktar</th>
                            <th>Durum</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('customer.pages.service.components.style')
@stop

@section('page-script')
    @include('customer.pages.service.components.script')
@stop
