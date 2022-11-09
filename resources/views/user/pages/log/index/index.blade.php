@extends('user.layouts.master')
@section('title', 'Loglar')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    <input type="hidden" id="id_edit">
    <input type="hidden" id="encrypted_id_edit">
    <div class="row">
        <div class="col-xl-12">
            <div class="card" id="logsCard">
                <div class="card-body">
                    <table class="table" id="logs">
                        <thead>
                        <tr>
                            <th>Oluşturulma Tarihi</th>
                            <th>Oluşturan</th>
                            <th>Oluşturan Ünvan</th>
                            <th>Hizmeti Alan</th>
                            <th>Hizmeti Ünvan</th>
                            <th>Hizmet Adı</th>
                            <th>Hizmet Adeti</th>
                            <th>Hizmet Başlangıcı</th>
                            <th>Hizmet Bitişi</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Oluşturulma Tarihi</th>
                            <th>Oluşturan</th>
                            <th>Oluşturan Ünvan</th>
                            <th>Hizmeti Alan</th>
                            <th>Hizmeti Ünvan</th>
                            <th>Hizmet Adı</th>
                            <th>Hizmet Adeti</th>
                            <th>Hizmet Başlangıcı</th>
                            <th>Hizmet Bitişi</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('user.pages.log.index.components.style')
@stop

@section('page-script')
    @include('user.pages.log.index.components.script')
@stop
