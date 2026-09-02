<?php

namespace App\Support;

final class TabelasIrs{
    public static function para(bool $emAtividade, bool $incapacidade, bool $casado, bool $conjugeEmAtividade, int $dependentes): array{
        if ($emAtividade && ! $incapacidade) {
            if ($casado && ! $conjugeEmAtividade) {
                return self::atividadeCasadoUnicoTitular();
            }

            if (! $casado && $dependentes > 0) {
                return self::atividadeNaoCasadoComDependentes();
            }

            return self::atividadeSemDependentesOuDoisTitulares();
        }

        if ($emAtividade && $incapacidade) {
            if ($casado && ! $conjugeEmAtividade) {
                return self::atividadeDeficienteCasadoUnicoTitular();
            }

            if ($dependentes === 0) {
                return self::atividadeDeficienteSemDependentes();
            }

            return $casado
                ? self::atividadeDeficienteDoisTitularesComDependentes()
                : self::atividadeDeficienteNaoCasadoComDependentes();
        }

        if (! $emAtividade && ! $incapacidade) {
            return $casado && ! $conjugeEmAtividade
                ? self::pensaoCasadoUnicoTitular()
                : self::pensaoNaoCasadoOuDoisTitulares();
        }

        return $casado && ! $conjugeEmAtividade
            ? self::pensaoDeficienteCasadoUnicoTitular()
            : self::pensaoDeficienteNaoCasadoOuDoisTitulares();
    }

    // (casado == false && dependentes == 0) || (casado == true && conjugeEmAtividade == true)
    private static function atividadeSemDependentesOuDoisTitulares(): array{
        return [
            ['ate' => 920.0, 'tmm' => 0.0, 'pa' => 0.0, 'extra' => 0.0],
            ['ate' => 1042.0, 'tmm' => 0.125, 'pa' => fn (float $bruto) => 0.125 * 2.6 * (1273.85 - $bruto), 'extra' => 21.43],
            ['ate' => 1108.0, 'tmm' => 0.157, 'pa' => fn (float $bruto) => 0.157 * 1.35 * (1554.83 - $bruto), 'extra' => 21.43],
            ['ate' => 1154.0, 'tmm' => 0.157, 'pa' => 94.71, 'extra' => 21.43],
            ['ate' => 1212.0, 'tmm' => 0.212, 'pa' => 158.18, 'extra' => 21.43],
            ['ate' => 1819.0, 'tmm' => 0.241, 'pa' => 193.33, 'extra' => 21.43],
            ['ate' => 2119.0, 'tmm' => 0.311, 'pa' => 320.66, 'extra' => 21.43],
            ['ate' => 2499.0, 'tmm' => 0.349, 'pa' => 401.19, 'extra' => 21.43],
            ['ate' => 3305.0, 'tmm' => 0.3836, 'pa' => 487.66, 'extra' => 21.43],
            ['ate' => 5547.0, 'tmm' => 0.3969, 'pa' => 531.62, 'extra' => 21.43],
            ['ate' => 20221.0, 'tmm' => 0.4495, 'pa' => 823.4, 'extra' => 21.43],
            ['ate' => PHP_FLOAT_MAX, 'tmm' => 0.4717, 'pa' => 1272.31, 'extra' => 21.43],
        ];
    }

    // casado == false && dependentes > 0
    private static function atividadeNaoCasadoComDependentes(): array{
        return [
            ['ate' => 920.0, 'tmm' => 0.0, 'pa' => 0.0, 'extra' => 0.0],
            ['ate' => 1042.0, 'tmm' => 0.125, 'pa' => fn (float $bruto) => 0.125 * 2.6 * (1273.85 - $bruto), 'extra' => 34.29],
            ['ate' => 1108.0, 'tmm' => 0.157, 'pa' => fn (float $bruto) => 0.157 * 1.35 * (1554.83 - $bruto), 'extra' => 34.29],
            ['ate' => 1154.0, 'tmm' => 0.157, 'pa' => 94.71, 'extra' => 34.29],
            ['ate' => 1212.0, 'tmm' => 0.212, 'pa' => 158.18, 'extra' => 34.29],
            ['ate' => 1819.0, 'tmm' => 0.241, 'pa' => 193.33, 'extra' => 34.29],
            ['ate' => 2119.0, 'tmm' => 0.311, 'pa' => 320.66, 'extra' => 34.29],
            ['ate' => 2499.0, 'tmm' => 0.349, 'pa' => 401.19, 'extra' => 34.29],
            ['ate' => 3305.0, 'tmm' => 0.3836, 'pa' => 487.66, 'extra' => 34.29],
            ['ate' => 5547.0, 'tmm' => 0.3969, 'pa' => 531.62, 'extra' => 34.29],
            ['ate' => 20221.0, 'tmm' => 0.4495, 'pa' => 823.4, 'extra' => 34.29],
            ['ate' => PHP_FLOAT_MAX, 'tmm' => 0.4717, 'pa' => 1272.31, 'extra' => 34.29],
        ];
    }

    // casado == true && conjugeEmAtividade == false
    private static function atividadeCasadoUnicoTitular(): array{
        return [
            ['ate' => 991.0, 'tmm' => 0.0, 'pa' => 0.0, 'extra' => 0.0],
            ['ate' => 1042.0, 'tmm' => 0.125, 'pa' => fn (float $bruto) => 0.125 * 2.6 * (1372.15 - $bruto), 'extra' => 42.86],
            ['ate' => 1108.0, 'tmm' => 0.125, 'pa' => fn (float $bruto) => 0.125 * 1.35 * (1677.85 - $bruto), 'extra' => 42.86],
            ['ate' => 1119.0, 'tmm' => 0.125, 'pa' => 96.17, 'extra' => 42.86],
            ['ate' => 1432.0, 'tmm' => 0.1272, 'pa' => 98.64, 'extra' => 42.86],
            ['ate' => 1962.0, 'tmm' => 0.157, 'pa' => 141.32, 'extra' => 42.86],
            ['ate' => 2240.0, 'tmm' => 0.1938, 'pa' => 213.53, 'extra' => 42.86],
            ['ate' => 2773.0, 'tmm' => 0.2277, 'pa' => 289.47, 'extra' => 42.86],
            ['ate' => 3389.0, 'tmm' => 0.257, 'pa' => 370.72, 'extra' => 42.86],
            ['ate' => 5965.0, 'tmm' => 0.2881, 'pa' => 476.12, 'extra' => 42.86],
            ['ate' => 20265.0, 'tmm' => 0.3843, 'pa' => 1049.96, 'extra' => 42.86],
            ['ate' => PHP_FLOAT_MAX, 'tmm' => 0.4717, 'pa' => 2821.13, 'extra' => 42.86],
        ];
    }

    // (casado == false) || (casado == true && conjugeEmAtividade==true && dep == 0)
    private static function atividadeDeficienteSemDependentes(): array{
        return [
            ['ate' => 1694.0, 'tmm' => 0.0, 'pa' => 0.0, 'extra' => 0.0],
            ['ate' => 2063.0, 'tmm' => 0.212, 'pa' => 359.13, 'extra' => 0.0],
            ['ate' => 2492.0, 'tmm' => 0.311, 'pa' => 563.37, 'extra' => 0.0],
            ['ate' => 4487.0, 'tmm' => 0.349, 'pa' => 658.07, 'extra' => 0.0],
            ['ate' => 4753.0, 'tmm' => 0.3836, 'pa' => 813.33, 'extra' => 0.0],
            ['ate' => 6687.0, 'tmm' => 0.3969, 'pa' => 876.55, 'extra' => 0.0],
            ['ate' => 20468.0, 'tmm' => 0.4495, 'pa' => 1228.29, 'extra' => 0.0],
            ['ate' => PHP_FLOAT_MAX, 'tmm' => 0.4717, 'pa' => 1682.68, 'extra' => 0.0],
        ];
    }

    // casado == false && dep > 0
    private static function atividadeDeficienteNaoCasadoComDependentes(): array{
        return [
            ['ate' => 1938.0, 'tmm' => 0.0, 'pa' => 0.0, 'extra' => 0.0],
            ['ate' => 2063.0, 'tmm' => 0.2132, 'pa' => 413.19, 'extra' => 42.86],
            ['ate' => 2854.0, 'tmm' => 0.311, 'pa' => 614.96, 'extra' => 42.86],
            ['ate' => 4504.0, 'tmm' => 0.349, 'pa' => 723.42, 'extra' => 42.86],
            ['ate' => 6826.0, 'tmm' => 0.3836, 'pa' => 879.26, 'extra' => 42.86],
            ['ate' => 7048.0, 'tmm' => 0.3969, 'pa' => 970.05, 'extra' => 42.86],
            ['ate' => 20468.0, 'tmm' => 0.4495, 'pa' => 1340.78, 'extra' => 42.86],
            ['ate' => PHP_FLOAT_MAX, 'tmm' => 0.4717, 'pa' => 1795.17, 'extra' => 42.86],
        ];
    }

    // casado == true && conjugeEmAtividade == true && dep > 0
    private static function atividadeDeficienteDoisTitularesComDependentes(): array{
        return [
            ['ate' => 1668.0, 'tmm' => 0.0, 'pa' => 0.0, 'extra' => 0.0],
            ['ate' => 2068.0, 'tmm' => 0.2049, 'pa' => 341.78, 'extra' => 21.43],
            ['ate' => 2497.0, 'tmm' => 0.241, 'pa' => 416.44, 'extra' => 21.43],
            ['ate' => 3107.0, 'tmm' => 0.311, 'pa' => 591.23, 'extra' => 21.43],
            ['ate' => 4504.0, 'tmm' => 0.349, 'pa' => 709.3, 'extra' => 21.43],
            ['ate' => 6826.0, 'tmm' => 0.3836, 'pa' => 865.14, 'extra' => 21.43],
            ['ate' => 7048.0, 'tmm' => 0.3969, 'pa' => 955.93, 'extra' => 21.43],
            ['ate' => 20468.0, 'tmm' => 0.4495, 'pa' => 1326.66, 'extra' => 21.43],
            ['ate' => PHP_FLOAT_MAX, 'tmm' => 0.4717, 'pa' => 1781.05, 'extra' => 21.43],
        ];
    }

    // casado == true && conjugeEmAtividade == false
    private static function atividadeDeficienteCasadoUnicoTitular(): array{
        return [
            ['ate' => 2325.0, 'tmm' => 0.0, 'pa' => 0.0, 'extra' => 0.0],
            ['ate' => 3494.0, 'tmm' => 0.2277, 'pa' => 529.41, 'extra' => 42.86],
            ['ate' => 3761.0, 'tmm' => 0.257, 'pa' => 631.79, 'extra' => 42.86],
            ['ate' => 6687.0, 'tmm' => 0.2881, 'pa' => 748.76, 'extra' => 42.86],
            ['ate' => 20468.0, 'tmm' => 0.4244, 'pa' => 1660.2, 'extra' => 42.86],
            ['ate' => PHP_FLOAT_MAX, 'tmm' => 0.4717, 'pa' => 2628.34, 'extra' => 42.86],
        ];
    }

    // (casado == false) || (casado == true && conjugeEmAtividade == true)
    private static function pensaoNaoCasadoOuDoisTitulares(): array{
        return [
            ['ate' => 920.0, 'tmm' => 0.0, 'pa' => 0.0, 'extra' => 0.0],
            ['ate' => 1042.0, 'tmm' => 0.125, 'pa' => fn (float $bruto) => 0.125 * 2.6 * (1320.92 - $bruto), 'extra' => 0.0],
            ['ate' => 1100.0, 'tmm' => 0.157, 'pa' => fn (float $bruto) => 0.157 * 1.35 * (1627.01 - $bruto), 'extra' => 0.0],
            ['ate' => 1133.0, 'tmm' => 0.157, 'pa' => 111.7, 'extra' => 0.0],
            ['ate' => 1239.0, 'tmm' => 0.212, 'pa' => 174.02, 'extra' => 0.0],
            ['ate' => 1869.0, 'tmm' => 0.241, 'pa' => 209.96, 'extra' => 0.0],
            ['ate' => 2114.0, 'tmm' => 0.311, 'pa' => 340.79, 'extra' => 0.0],
            ['ate' => 2361.0, 'tmm' => 0.349, 'pa' => 421.13, 'extra' => 0.0],
            ['ate' => 3462.0, 'tmm' => 0.431, 'pa' => 614.74, 'extra' => 0.0],
            ['ate' => 5833.0, 'tmm' => 0.446, 'pa' => 666.67, 'extra' => 0.0],
            ['ate' => 18332.0, 'tmm' => 0.505, 'pa' => 1010.82, 'extra' => 0.0],
            ['ate' => PHP_FLOAT_MAX, 'tmm' => 0.53, 'pa' => 1469.12, 'extra' => 0.0],
        ];
    }

    // casado == true && conjugeEmAtividade == false
    private static function pensaoCasadoUnicoTitular(): array{
        return [
            ['ate' => 920.0, 'tmm' => 0.0, 'pa' => 0.0, 'extra' => 0.0],
            ['ate' => 1042.0, 'tmm' => 0.125, 'pa' => fn (float $bruto) => 0.1250 * 2.6 * (1381.69 - $bruto), 'extra' => 0.0],
            ['ate' => 1100.0, 'tmm' => 0.125, 'pa' => fn (float $bruto) => 0.1250 * 1.728 * (1553.11 - $bruto), 'extra' => 0.0],
            ['ate' => 1170.0, 'tmm' => 0.125, 'pa' => 97.88, 'extra' => 0.0],
            ['ate' => 1526.0, 'tmm' => 0.159, 'pa' => 137.66, 'extra' => 0.0],
            ['ate' => 1884.0, 'tmm' => 0.1928, 'pa' => 189.24, 'extra' => 0.0],
            ['ate' => 2314.0, 'tmm' => 0.2177, 'pa' => 236.16, 'extra' => 0.0],
            ['ate' => 3245.0, 'tmm' => 0.2792, 'pa' => 378.48, 'extra' => 0.0],
            ['ate' => 3480.0, 'tmm' => 0.3233, 'pa' => 521.59, 'extra' => 0.0],
            ['ate' => 6085.0, 'tmm' => 0.3237, 'pa' => 522.99, 'extra' => 0.0],
            ['ate' => 18350.0, 'tmm' => 0.4293, 'pa' => 1165.57, 'extra' => 0.0],
            ['ate' => PHP_FLOAT_MAX, 'tmm' => 0.53, 'pa' => 3013.42, 'extra' => 0.0],
        ];
    }

    // (casado == false) || (casado == true && conjugeEmAtividade == true)
    private static function pensaoDeficienteNaoCasadoOuDoisTitulares(): array{
        return [
            ['ate' => 1816.0, 'tmm' => 0.0, 'pa' => 0.0, 'extra' => 0.0],
            ['ate' => 2063.0, 'tmm' => 0.241, 'pa' => 437.66, 'extra' => 18.19],
            ['ate' => 2492.0, 'tmm' => 0.311, 'pa' => 582.07, 'extra' => 18.19],
            ['ate' => 3280.0, 'tmm' => 0.349, 'pa' => 676.77, 'extra' => 18.19],
            ['ate' => 4598.0, 'tmm' => 0.431, 'pa' => 945.73, 'extra' => 18.19],
            ['ate' => 6627.0, 'tmm' => 0.446, 'pa' => 1014.7, 'extra' => 18.19],
            ['ate' => 18529.0, 'tmm' => 0.505, 'pa' => 1405.7, 'extra' => 18.19],
            ['ate' => PHP_FLOAT_MAX, 'tmm' => 0.53, 'pa' => 1868.93, 'extra' => 18.19],
        ];
    }

    // casado == true && conjuge == false
    private static function pensaoDeficienteCasadoUnicoTitular(): array{
        return [
            ['ate' => 2257.0, 'tmm' => 0.0, 'pa' => 0.0, 'extra' => 0.0],
            ['ate' => 2782.0, 'tmm' => 0.1822, 'pa' => 411.23, 'extra' => 36.38],
            ['ate' => 3359.0, 'tmm' => 0.2373, 'pa' => 564.52, 'extra' => 36.38],
            ['ate' => 4074.0, 'tmm' => 0.3017, 'pa' => 780.84, 'extra' => 36.38],
            ['ate' => 6266.0, 'tmm' => 0.3637, 'pa' => 1033.43, 'extra' => 36.38],
            ['ate' => 18169.0, 'tmm' => 0.4697, 'pa' => 1697.63, 'extra' => 36.38],
            ['ate' => PHP_FLOAT_MAX, 'tmm' => 0.53, 'pa' => 2793.23, 'extra' => 36.38],
        ];
    }
}
