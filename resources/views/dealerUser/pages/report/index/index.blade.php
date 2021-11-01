@extends('user.layouts.master')
@section('title', 'Raporlar')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    <div class="row">
        <div class="col-xl-3">
            <a href="{{ route('dealerUser.report.show', ['report' => 'credit']) }}" class="card card-custom card-stretch gutter-b">
                <div class="card-body">
                    <span class="svg-icon svg-icon-success svg-icon-3x ml-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M10.8226874,8.36941377 L12.7324324,9.82298668 C13.4112512,8.93113547 14.4592942,8.4 15.6,8.4 C17.5882251,8.4 19.2,10.0117749 19.2,12 C19.2,13.9882251 17.5882251,15.6 15.6,15.6 C14.5814697,15.6 13.6363389,15.1780547 12.9574041,14.4447676 L11.1963369,16.075302 C12.2923051,17.2590082 13.8596186,18 15.6,18 C18.9137085,18 21.6,15.3137085 21.6,12 C21.6,8.6862915 18.9137085,6 15.6,6 C13.6507856,6 11.9186648,6.9294879 10.8226874,8.36941377 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                <path d="M8.4,18 C5.0862915,18 2.4,15.3137085 2.4,12 C2.4,8.6862915 5.0862915,6 8.4,6 C11.7137085,6 14.4,8.6862915 14.4,12 C14.4,15.3137085 11.7137085,18 8.4,18 Z" fill="#000000"/>
                            </g>
                        </svg>
                    </span>
                    <div class="text-inverse-white font-weight-bolder font-size-h5 mb-2 mt-5">Müşteri Kontör Raporu</div>
                </div>
            </a>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('user.pages.report.index.components.style')
@stop

@section('page-script')
    @include('user.pages.report.index.components.script')
@stop
