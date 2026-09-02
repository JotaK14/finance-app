/*if(emAtividade == true){
	if(incapacidade == false){
		if ((casado == false && dependentes == 0) || (casado == true && conjugeEmAtividade == true)){
			if(salarioBruto <= 920){
				$valorDependentes  = 0;
				$TMM = 0;
				$PA = 0;
			}
			if(salarioBruto <= 1042){
				$valorDependentes  = 21.43;
				$TMM = 0.1250;
				$PA = $TMM * 2.6 * (1273.85 - $salarioBruto);
			}
			if(salarioBruto <= 1108){
				$valorDependentes  = 21.43;
				$TMM = 0.1570;
				$PA = $TMM * 1.35 * (1554.83 - $salarioBruto);
			}
			if(salarioBruto <= 1154){
				$valorDependentes  = 21.43;
				$TMM = 0.1570;
				$PA = 94.71;
			}
			if(salarioBruto <= 1212){
				$valorDependentes  = 21.43;
				$TMM = 0.2120;
				$PA = 158.18;
			}
			if(salarioBruto <= 1829){
				$valorDependentes  = 21.43;
				$TMM = 0.2410;
				$PA = 193.33;
			}
			if(salarioBruto <= 2119){
				$valorDependentes  = 21.43;
				$TMM = 0.3110;
				$PA = 320.66;
			}
			if(salarioBruto <= 2499){
				$valorDependentes  = 21.43;
				$TMM = 0.3490;
				$PA = 401.19;
			}
			if(salarioBruto <= 3305){
				$valorDependentes  = 21.43;
				$TMM = 0.3836;
				$PA = 487.66;
			}
			if(salarioBruto <= 5547){
				$valorDependentes  = 21.43;
				$TMM = 0.3969;
				$PA = 531.62;
			}
			if(salarioBruto <= 20221){
				$valorDependentes  = 21.43;
				$TMM = 0.4495;
				$PA = 823.40;
			}
			if(salarioBruto > 20221){
				$valorDependentes  = 21.43;
				$TMM = 0.4717;
				$PA = 1272.31;
			}
			$salarioLiquido = (salarioBruto * $TMM) - $PA - ($valorDependentes * dependentes)
		}
		if (casado == false && dependentes > 0){
			if(salarioBruto <= 920){
				$valorDependentes  = 0;
				$TMM = 0;
				$PA = 0;
			}
			if(salarioBruto <= 1042){
				$valorDependentes  = 34.29;
				$TMM = 0.1250;
				$PA = $TMM * 2.6 * (1273.85 - $salarioBruto);
			}
			if(salarioBruto <= 1108){
				$valorDependentes  = 34.29;
				$TMM = 0.1570;
				$PA = $TMM * 1.35 * (1554.83 - $salarioBruto);
			}
			if(salarioBruto <= 1154){
				$valorDependentes  = 34.29;
				$TMM = 0.1570;
				$PA = 94.71;
			}
			if(salarioBruto <= 1212){
				$valorDependentes  = 34.29;
				$TMM = 0.2120;
				$PA = 158.18;
			}
			if(salarioBruto <= 1829){
				$valorDependentes  = 34.29;
				$TMM = 0.2410;
				$PA = 193.33;
			}
			if(salarioBruto <= 2119){
				$valorDependentes  = 34.29;
				$TMM = 0.3110;
				$PA = 320.66;
			}
			if(salarioBruto <= 2499){
				$valorDependentes  = 34.29;
				$TMM = 0.3490;
				$PA = 401.19;
			}
			if(salarioBruto <= 3305){
				$valorDependentes  = 34.29;
				$TMM = 0.3836;
				$PA = 487.66;
			}
			if(salarioBruto <= 5547){
				$valorDependentes  = 34.29;
				$TMM = 0.3969;
				$PA = 531.62;
			}
			if(salarioBruto <= 20221){
				$valorDependentes  = 34.29;
				$TMM = 0.4495;
				$PA = 823.40;
			}
			if(salarioBruto > 20221){
				$valorDependentes  = 34.29;
				$TMM = 0.4717;
				$PA = 1272.31;
			}
			$salarioLiquido = (salarioBruto * $TMM) - $PA - ($valorDependentes * dependentes)
		}
		if (casado == true && conjugeEmAtividade == false){
			if(salarioBruto <= 991){
				$valorDependentes  = 0;
				$TMM = 0;
				$PA = 0;
			}
			if(salarioBruto <= 1042){
				$valorDependentes  = 42.86;
				$TMM = 0.1250;
				$PA = $TMM * 2.6 * (1372.15 - $salarioBruto);
			}
			if(salarioBruto <= 1108){
				$valorDependentes  = 42.86;
				$TMM = 0.1250;
				$PA = $TMM * 1.35 * (1677.85 - $salarioBruto);
			}
			if(salarioBruto <= 1119){
				$valorDependentes  = 42.86;
				$TMM = 0.1250;
				$PA = 96.17;
			}
			if(salarioBruto <= 1432){
				$valorDependentes  = 42.86;
				$TMM = 0.1272;
				$PA = 98.64;
			}
			if(salarioBruto <= 1962){
				$valorDependentes  = 42.86;
				$TMM = 0.1570;
				$PA = 141.32;
			}
			if(salarioBruto <= 2240){
				$valorDependentes  = 42.86;
				$TMM = 0.1938;
				$PA = 213.53;
			}
			if(salarioBruto <= 2773){
				$valorDependentes  = 42.86;
				$TMM = 0.2277;
				$PA = 289.47;
			}
			if(salarioBruto <= 3389){
				$valorDependentes  = 42.86;
				$TMM = 0.2570;
				$PA = 370.72
			}
			if(salarioBruto <= 5965){
				$valorDependentes  = 42.86;
				$TMM = 0.2881;
				$PA = 476.12
			}
			if(salarioBruto <= 20265){
				$valorDependentes  = 42.86;
				$TMM = 0.3843;
				$PA = 1049.96
			}
			if(salarioBruto > 20265){
				$valorDependentes  = 42.86;
				$TMM = 0.4717;
				$PA = 2821.13;
			}
			$salarioLiquido = (salarioBruto * $TMM) - $PA - ($valorDependentes * dependentes)
		}
	}
	if( incapacidade == true){
		if((casado == false) || (casado == true && conjugeEmAtividade==true && dep == 0)){
			if(salarioBruto <= 1694){
				$TMM = 0;
				$PA = 0;
			}
			if(salarioBruto <= 2063){
				$TMM = 0.2120;
				$PA = 359.13;
			}
			if(salarioBruto <= 2492){
				$TMM = 0.3110;
				$PA = 563.37;
			}
			if(salarioBruto <= 4487){
				$TMM = 0.3490;
				$PA = 658.07;
			}
			if(salarioBruto <= 4753){
				$TMM = 0.3836;
				$PA = 813.33;
			}
			if(salarioBruto <= 6687){
				$TMM = 0.3969;
				$PA = 876.55;
			}
			if(salarioBruto <= 20468){
				$TMM = 0.4495;
				$PA = 1228.29;
			}
			if(salarioBruto > 20468){
				$TMM = 0.4717;
				$PA = 1682.68;
			}
			$salarioLiquido = (salarioBruto * $TMM) - $PA
		}
		if(casado == false && dep > 0){
			if(salarioBruto <= 1938){
				$valorDependentes  = 0;
				$TMM = 0;
				$PA = 0;
			}
			if(salarioBruto <= 2063){
				$valorDependentes  = 42.86;
				$TMM = 0.2132;
				$PA = 413.19;
			}
			if(salarioBruto <= 2854){
				$valorDependentes  = 42.86;
				$TMM = 0.3110;
				$PA = 614.96;
			}
			if(salarioBruto <= 4504){
				$valorDependentes  = 42.86;
				$TMM = 0.3490;
				$PA = 723.42;
			}
			if(salarioBruto <= 6826){
				$valorDependentes  = 42.86;
				$TMM = 0.3836;
				$PA = 879.26;
			}
			if(salarioBruto <= 7048){
				$valorDependentes  = 42.86;
				$TMM = 0.3969;
				$PA = 970.05;
			}
			if(salarioBruto <= 20468){
				$valorDependentes  = 42.86;
				$TMM = 0.4495;
				$PA = 1340.78;
			}
			if(salarioBruto > 20468){
				$valorDependentes  = 42.86;
				$TMM = 0.4717;
				$PA = 1795.17;
			}
			$salarioLiquido = (salarioBruto * $TMM) - $PA - ($valorDependentes * dependentes)
		}
		if(casado == true && conjugeEmAtividade == true && dep > 0){
			if(salarioBruto <= 1668){
				$valorDependentes  = 0;
				$TMM = 0;
				$PA = 0;
			}
			if(salarioBruto <= 2068){
				$valorDependentes  = 21.43;
				$TMM = 0.2049;
				$PA = 341.78;
			}
			if(salarioBruto <= 2497){
				$valorDependentes  = 21.43;
				$TMM = 0.2410;
				$PA = 416.44;
			}
			if(salarioBruto <= 3107){
				$valorDependentes  = 21.43;
				$TMM = 0.3110;
				$PA = 591.23;
			}
			if(salarioBruto <= 4504){
				$valorDependentes  = 21.43;
				$TMM = 0.3490;
				$PA = 709.30;
			}
			if(salarioBruto <= 6826){
				$valorDependentes  = 21.43;
				$TMM = 0.3836;
				$PA = 865.14;
			}
			if(salarioBruto <= 7048){
				$valorDependentes  = 21.43;
				$TMM = 0.3969;
				$PA = 955.93;
			}
			if(salarioBruto <= 20468){
				$valorDependentes  = 21.43;
				$TMM = 0.4495;
				$PA = 1326.66;
			}
			if(salarioBruto > 20468){
				$valorDependentes  = 21.43;
				$TMM = 0.4717;
				$PA = 1781.05;
			}
			$salarioLiquido = (salarioBruto * $TMM) - $PA - ($valorDependentes * dependentes)
		}
		if(casado == true && conjugeEmAtividade == false){
			if(salarioBruto <= 2325){
				$valorDependentes  = 0;
				$TMM = 0;
				$PA = 0;
			}
			if(salarioBruto <= 3494){
				$valorDependentes  = 42.86;
				$TMM = 0.2277;
				$PA = 529.41;
			}
			if(salarioBruto <= 3761){
				$valorDependentes  = 42.86;
				$TMM = 0.2570;
				$PA = 631.79;
			}
			if(salarioBruto <= 6687){
				$valorDependentes  = 42.86;
				$TMM = 0.2818;
				$PA = 748.76;
			}
			if(salarioBruto <= 20468){
				$valorDependentes  = 42.86;
				$TMM = 0.4244;
				$PA = 1660.20;
			}
			if(salarioBruto > 20468){
				$valorDependentes  = 42.86;
				$TMM = 0.4717;
				$PA = 2628.34;
			}
			$salarioLiquido = (salarioBruto * $TMM) - $PA - ($valorDependentes * dependentes)
		}
	}
}
if( emAtividade == false){
	if(incapacidade==false){
		if((casado == false) || (casado == true && conjugeEmAtividade == true)){
			if(salarioBruto <= 920){
				$TMM = 0;
				$PA = 0;
			}
			if(salarioBruto <= 1042){
				$TMM = 0.1250;
				$PA = $TMM * 2.6 * (1320.92 - salarioBruto);
			}
			if(salarioBruto <= 1100){
				$TMM = 0.1570;
				$PA = $TMM * 1.35 * (1627.01 - salarioBruto);
			}
			if(salarioBruto <= 1133){
				$TMM = 0.1570;
				$PA = 111.70;
			}
			if(salarioBruto <= 1239){
				$TMM = 0.2120;
				$PA = 174.02;
			}
			if(salarioBruto <= 1869){
				$TMM = 0.2410;
				$PA = 209.96;
			}
			if(salarioBruto <= 2114){
				$TMM = 0.3110;
				$PA = 340.79;
			}
			if(salarioBruto <= 2361){
				$TMM = 0.3490;
				$PA = 421.13;
			}
			if(salarioBruto <= 3462){
				$TMM = 0.4310;
				$PA = 614.74;
			}
			if(salarioBruto <= 5833){
				$TMM = 0.4460;
				$PA = 666.67;
			}
			if(salarioBruto <= 18332){
				$TMM = 0.5050;
				$PA = 1010.82;
			}
			if(salarioBruto > 18332){
				$TMM = 0.53;
				$PA = 1469.12;
			}
			$salarioLiquido = (salarioBruto * $TMM) - $PA
		}
		if(casado == true && conjugeEmAtividade == false){
			if(salarioBruto <= 920){
				$TMM = 0;
				$PA = 0;
			}
			if(salarioBruto <= 1042){
				$TMM = 0.1250;
				$PA = 0.1250 * 2.6 * (1381.69 - salarioBruto);
			}
			if(salarioBruto <= 1100){
				$TMM = 0.1250;
				$PA = 0.1250 * 1.728 * (1553.11 - salarioBruto);
			}
			if(salarioBruto <= 1170){
				$TMM = 0.1250;
				$PA = 97.98;
			}
			if(salarioBruto <= 1526){
				$TMM = 0.1590;
				$PA = 137.66;
			}
			if(salarioBruto <= 1884){
				$TMM = 0.1928;
				$PA = 189.24;
			}
			if(salarioBruto <= 2314){
				$TMM = 0.2177;
				$PA = 236.16;
			}
			if(salarioBruto <= 3245){
				$TMM = 0.2792;
				$PA = 378.48;
			}
			if(salarioBruto <= 3480){
				$TMM = 0.3233;
				$PA = 521.59;
			}
			if(salarioBruto <= 6085){
				$TMM = 0.3237;
				$PA = 522.99;
			}
			if(salarioBruto <= 18350){
				$TMM = 0.4293;
				$PA = 1165.57;
			}
			if(salarioBruto > 18350){
				$TMM = 0.53;
				$PA = 3013.42;
			}
			$salarioLiquido = (salarioBruto * $TMM) - $PA
		}
	}
	if(incapacidade==true){
		if((casado == false) || (casado == true && conjugeEmAtividade == true)){
			if(salarioBruto <= 1816){
				$valorDeficientesArmadas  = 0;
				$TMM = 0;
				$PA = 0;
			}
			if(salarioBruto <= 2063){
				$valorDeficientesArmadas  = 18.19;
				$TMM = 0.2410;
				$PA = 437.66;
			}
			if(salarioBruto <= 2492){
				$valorDeficientesArmadas  = 18.19;
				$TMM = 0.3110;
				$PA = 582.07;
			}
			if(salarioBruto <= 3280){
				$valorDeficientesArmadas  = 18.19;
				$TMM = 0.3490;
				$PA = 676.77;
			}
			if(salarioBruto <= 4598){
				$valorDeficientesArmadas  = 18.19;
				$TMM = 0.4310;
				$PA = 945.73;
			}
			if(salarioBruto <= 6627){
				$valorDeficientesArmadas  = 18.19;
				$TMM = 0.4460;
				$PA = 1014.70;
			}
			if(salarioBruto <= 18529){
				$valorDeficientesArmadas  = 18.19;
				$TMM = 0.5050;
				$PA = 1405.70;
			}
			if(salarioBruto > 18529){
				$valorDeficientesArmadas  = 18.19;
				$TMM = 0.53;
				$PA = 1863.93;
			}
			$salarioLiquido = (salarioBruto * $TMM) - $PA
			if ($valorDeficientesArmadas == true){
				$salarioLiquido - $valorDeficientesArmadas;
			}
		}
		if(casado == true && conjuge == false){
			if(salarioBruto <= 2257){
				$valorDeficientesArmadas  = 0;
				$TMM = 0;
				$PA = 0;
			}
			if(salarioBruto <= 2782){
				$valorDeficientesArmadas  = 36.38;
				$TMM = 0.1822;
				$PA = 411.23;
			}
			if(salarioBruto <= 3359){
				$valorDeficientesArmadas  = 36.38;
				$TMM = 0.2373;
				$PA = 564.52;
			}
			if(salarioBruto <= 4074){
				$valorDeficientesArmadas  = 36.38;
				$TMM = 0.3017;
				$PA = 780.84;
			}
			if(salarioBruto <= 6266){
				$valorDeficientesArmadas  = 36.38;
				$TMM = 0.3637;
				$PA = 1033.43;
			}
			if(salarioBruto <= 18169){
				$valorDeficientesArmadas  = 36.38;
				$TMM = 0.4697;
				$PA = 1697.63;
			}
			if(salarioBruto > 18169){
				$valorDeficientesArmadas  = 36.38;
				$TMM = 0.53;
				$PA = 2793.23;
			}
			$salarioLiquido = (salarioBruto * $TMM) - $PA
			if ($valorDeficientesArmadas == true){
				$salarioLiquido - $valorDeficientesArmadas;
			}
		}
	}
}
*/