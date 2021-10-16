<?php

if (!function_exists('explodeNamespace')) {
    function explodeNamespace($namespace)
    {
        $exploded = explode('\\', $namespace);
        return end($exploded);
    }
}
