<?php

namespace App\Support;

use App\Models\Irs;

final class CalculadoraIrs{
    private const TAXA_SEGURANCA_SOCIAL = 0.11;

    public static function segurancaSocial(float $bruto): float{
        return round($bruto * self::TAXA_SEGURANCA_SOCIAL, 2);
    }

    public static function retencao(Irs $irs, float $bruto): float{
        $escalao = self::escalao($irs, $bruto);

        $pa = $escalao['pa'];
        $pa = is_callable($pa) ? $pa($bruto) : $pa;

        $retencao = ($bruto * $escalao['tmm']) - $pa;

        $retencao -= $irs->emAtividade || ! $irs->incapacidade
            ? $escalao['extra'] * $irs->dependentes
            : ($irs->deficientesArmadas ? $escalao['extra'] : 0);

        return max(0, round($retencao, 2));
    }

    public static function liquido(Irs $irs, float $bruto): float{
        $segurancaSocial = $irs->emAtividade ? self::segurancaSocial($bruto) : 0;

        return round($bruto - self::retencao($irs, $bruto) - $segurancaSocial, 2);
    }

    private static function escalao(Irs $irs, float $bruto): array{
        $escaloes = TabelasIrs::para(
            $irs->emAtividade,
            $irs->incapacidade,
            $irs->casado,
            $irs->conjugeEmAtividade,
            $irs->dependentes,
        );

        foreach ($escaloes as $escalao) {
            if ($bruto <= $escalao['ate']) {
                return $escalao;
            }
        }

        return end($escaloes);
    }
}
