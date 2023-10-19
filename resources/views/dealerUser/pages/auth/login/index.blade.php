@extends('dealerUser.layouts.authentication')
@section('title', 'Giriş Yap')

@section('content')
    <div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="login-aside d-flex flex-column flex-row-auto">
            <div class="d-flex flex-column-auto flex-column">
                <a class="login-logo text-center pb-10" style="margin-top: 100px">
                    <img src="{{ asset('assets/media/logos/bien.png') }}" class="max-h-75px" alt="" />
                </a>
            </div>
            <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-x-center" style="background-position-y: calc(95%); background-image: url({{ asset('assets/media/logos/bg.png') }});"></div>
        </div>
        <div class="login-content flex-row-fluid d-flex flex-column p-10">
            <div class="d-flex flex-row-fluid flex-center">
                <div class="login-form">
                    <div class="form" id="login">
                        <div class="pb-5 pb-lg-15">
                            <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Bayi Girişi</h3>
                        </div>
                        <div class="form-group">
                            <label for="tax_number" class="font-size-h6 font-weight-bolder text-dark">E-posta Adresiniz</label>
                            <input class="form-control h-auto py-7 px-6 rounded-lg border-0 emailMask" type="text" id="email" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between mt-n5">
                                <label for="password" class="font-size-h6 font-weight-bolder text-dark pt-5">Şifreniz</label>
                            </div>
                            <input class="form-control h-auto py-7 px-6 rounded-lg border-0" type="password" name="password" id="password" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <div class="d-flex">
                                <label class="checkbox checkbox-dark">
                                    <input type="checkbox" name="remember" value="1" checked /> Beni Hatırla
                                    <span></span>
                                </label>
                                <i class="fa fa-info-circle ml-3 mt-1" data-toggle="tooltip" data-placement="right" title="Aktif Ederseniz Oturumunuz Otomatik Olarak Sonlandırılmaz."></i>
                            </div>
                        </div>

                        <div class="pb-lg-0 pb-5">
                            <div class="row">
                                <div class="col-xl-4">
                                    <button type="button" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3" id="LoginButton">Giriş Yap</button>
                                </div>
                                <div class="col-xl-8">
                                    <a href="{{ route('home') }}" class="btn btn-secondary btn-block font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3" id="LoginButton">Ana Ekran</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page-styles')
    @include('dealerUser.pages.auth.login.components.style')
@stop

@section('page-script')
    @include('dealerUser.pages.auth.login.components.script')
@stop
