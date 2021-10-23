@component('mail::message')
    # Sayın {{ $name }}, Aşağıdaki Bilgileri Kullanarak Bayi Paneline Giriş Yapabilirsiniz

    URL: {{ url('/customer/login') }}
    Vergi Numaranız: {{ $tax_number }}
    Şifreniz: {{ $password }}

    İyi Günler Dileriz.
@endcomponent
