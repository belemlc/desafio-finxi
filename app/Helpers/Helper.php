<?php
if (!function_exists('status')) {
    function status($tipo)
    {
        if ($tipo === 'aberto') {
            return asset('images/baseline-check_circle_outline.svg');
        } else if ($tipo === 'finalizado') {
            return asset('images/baseline-highlight_off.svg');
        }
    }
}
