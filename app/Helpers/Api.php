<?php

if (!function_exists('generateToken')) {
    function generateToken()
    {
        return uniqid() . '-' . \Illuminate\Support\Str::random() . '-' . uniqid();
    }
}

if (!function_exists('checkMethod')) {
    function checkMethod($requestedMethod, $methods)
    {
        foreach ($methods as $method) {
            if (strtolower($requestedMethod) == strtolower($method)) {
                return 1;
            }
        }
        return 0;
    }
}
