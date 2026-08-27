<?php

namespace App\Support;

final class Moeda{
    public static function euros(float $valor): string{
        return number_format($valor, 2, ',', '') . ' €';
    }
}
