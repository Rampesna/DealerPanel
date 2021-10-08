<?php

if (!function_exists('generateToken')) {
    function generateToken()
    {
        return uniqid() . '-' . \Illuminate\Support\Str::random() . '-' . uniqid();
    }
}
