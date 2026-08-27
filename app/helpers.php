<?php
if (! function_exists('euros')) {
    function euros(float $valor): string{
        return number_format($valor, 2, ',', '') . ' €';
    }
}
