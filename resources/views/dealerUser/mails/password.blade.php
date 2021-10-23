@component('mail::message')
    # Sayın {{ $name }}, Aşağıdaki Bilgileri Kullanarak Bayi Paneline Giriş Yapabilirsiniz

    URL: {{ url('/dealerUser/login') }}
    E-posta Adresiniz: {{ $email }}
    Şifreniz: {{ $password }}

    İyi Günler Dileriz.
@endcomponent
