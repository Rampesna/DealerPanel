@extends('user.layouts.master')
@section('title', 'Profili Düzenle')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    <div class="row">
        <div class="col-xl-4">
            <form id="PasswordForm" class="card">
                <div class="card-header text-center pt-4 pb-3">
                    <h5>Şifre Değiştir</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="old_password">Eski Şifreniz</label>
                                <input id="old_password" type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="new_password">Yeni Şifreniz</label>
                                <input id="new_password" type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="confirm_new_password">Yeni Şifreyi Tekrar Girin</label>
                                <input id="confirm_new_password" type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-12 text-right">
                            <button type="button" class="btn btn-success" id="UpdatePasswordButton">Güncelle</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('user.pages.profile.components.style')
@stop

@section('page-script')
    @include('user.pages.profile.components.script')
@stop
