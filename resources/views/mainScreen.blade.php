@use('App\Support\Moeda')
<link rel="stylesheet" href="{{ asset('css/colors.css') }}">
<html>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <style>
        body{
            background-color: var(--preto);
            color: var(--branco);
            font-family: Roboto, sans-serif;
            margin: 0;
            padding: 40px;
        }

        dialog{
            width: 320px;
            padding: 24px;
            border: 1px solid var(--border-button);
            border-radius: 14px;
            background-color: var(--preto);
            color: var(--branco);
        }

        dialog::backdrop{
            background-color: rgba(0, 0, 0, 0.67);
        }

        select.popup-input{
            cursor: pointer;
        }

        table{
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th{
            padding: 14px 16px;
            border-bottom: 1px solid var(--border-button);
            color: var(--cinza);
            font-size: 14px;
            font-weight: 400;
            text-align: left;
        }

        td{
            padding: 16px;
            border-bottom: 1px solid var(--hover-button);
            font-size: 15px;
        }

        [hidden]{
            display: none;
        }

        strong{
            color: var(--branco);
        }

        .header{
            display: flex;
            align-items: center;
        }

        .logout{
            padding: 12px 20px;
            border: 1px solid var(--border-button);
            border-radius: 12px;
            background-color: transparent;
            color: var(--branco);
            font-family: inherit;
            font-size: 15px;
            cursor: pointer;
        }

        .logout:hover{
            background-color: var(--hover-button);
        }

        .boas-vindas{
            font-size: 15px;
            font-weight: 400;
            color: var(--cinza);
        }

        .nome{
            font-size: 26px;
            font-weight: 600;
        }

        .valores{
            display: flex;
            gap: 60px;
        }

        .cartao{
            flex: 1;
            max-width: 420px;
        }

        .cartao-topo{
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .cartao-titulo{
            font-size: 15px;
            color: var(--cinza);
        }

        .cartao-valor{
            font-size: 38px;
            font-weight: 600;
        }

        .acoes{
            display: flex;
            gap: 10px;
        }

        .botao-icone{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 38px;
            height: 38px;
            border: 1px solid var(--border-button);
            border-radius: 10px;
            background-color: transparent;
            color: var(--branco);
            cursor: pointer;
        }

        .botao-icone:hover:not(:disabled){
            background-color: var(--hover-button);
        }

        .botao-icone:disabled{
            opacity: 0.35;
            cursor: not-allowed;
        }

        

        .popup-titulo{
            font-size: 18px;
            font-weight: 600;
        }

        .popup-input{
            box-sizing: border-box;
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-button);
            border-radius: 8px;
            background-color: var(--preto);
            color: var(--branco);
            font-family: inherit;
            font-size: 16px;
        }

        .popup-texto{
            font-size: 15px;
            line-height: 1.5;
            color: var(--cinza);
        }

        .irs-bruto{
            display: flex;
            justify-content: space-between;
            padding: 12px;
            border: 1px solid var(--border-button);
            border-radius: 8px;
        }

        .interruptor{
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            cursor: pointer;
        }

        .interruptor input{
            position: none;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .interruptor-calha{
            position: relative;
            width: 42px;
            height: 24px;
            border-radius: 12px;
            background-color: var(--border-button);
        }

        .interruptor-calha::after{
            content: "";
            position: absolute;
            top: 3px;
            left: 3px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background-color: var(--branco);
            transition: transform 0.15s;
        }

        .interruptor input:checked + .interruptor-calha{
            background-color: var(--verde-escuro);
        }

        .interruptor input:checked + .interruptor-calha::after{
            transform: translateX(18px);
        }

        .interruptor input:focus-visible + .interruptor-calha{
            outline: 2px solid var(--branco);
            outline-offset: 2px;
        }

        .popup-botoes{
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .popup-botoes button{
            padding: 10px 18px;
            border: 1px solid var(--border-button);
            border-radius: 10px;
            background-color: transparent;
            color: var(--branco);
            font-family: inherit;
            font-size: 14px;
            cursor: pointer;
        }

        .popup-botoes button[type="submit"],
        .popup-botoes button[onclick="confirmarSaldo()"]{
            border-color: var(--branco);
            background-color: var(--branco);
            color: var(--preto);
        }

        .popup-botoes button:hover{
            opacity: 0.85;
        }

        .movimentos-topo{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .movimentos-titulo{
            font-size: 22px;
            font-weight: 600;
        }

        .botao-adicionar{
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            border: 1px solid var(--border-button);
            border-radius: 12px;
            background-color: transparent;
            color: var(--branco);
            font-size: 15px;
            font-family: inherit;
            cursor: pointer;
        }

        .botao-adicionar:hover{
            background-color: var(--hover-button);
        }

        .data{
            color: var(--cinza);
        }

        .descricao{
            font-weight: 600;
        }

        .numero{
            text-align: right;
        }

        .movimentos-botoes{
            display: flex;
            gap: 10px;
        }

        .valor-negativo{
            color: var(--vermelho);
            text-align: right;
        }

        .valor-positivo{
            color: var(--verde);
            text-align: right;
        }

        .saldo-pos{
            font-weight: 600;
            text-align: right;
        }

        .vazio{
            color: var(--cinza);
            text-align: center;
        }

        .etiqueta{
            display: inline-block;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 13px;
        }

        .alimentacao{
            font-weight: 600;
            border: 1px solid var(--laranja-escuro);
            background-color: var(--laranja);
            color: var(--laranja-escuro);
        }

        .transporte{
            font-weight: 600;
            border: 1px solid var(--azul-escuro);
            background-color: var(--azul);
            color: var(--azul-escuro);
        }

        .habitacao {
            font-weight: 600;
            border: 1px solid var(--roxo-escuro);
            background-color: var(--roxo);
            color: var(--roxo-escuro);
        }

        .ganho{
            font-weight: 600;
            border: 1px solid var(--verde-escuro);
            background-color: var(--verde);
            color: var(--verde-escuro);
        }

        .lazer{
            font-weight: 600;
            border: 1px solid var(--castanho-escuro);
            background-color: var(--castanho);
            color: var(--castanho-escuro);
        }
    </style>
    <body>
        <div class="header">
            <div>
                <div class="boas-vindas">Bem-vindo de volta</div>
                <div class="nome">{{ Auth::user()->name }}</div>
            </div>

            <button class="logout" style="margin-left: auto;" type="button" onclick="window.location.href = '{{ route('login') }}'">
                <img src="{{ asset('icons/logout.svg') }}" width="18" height="18">
            </button>
        </div>

        <div class="valores" style="margin-top: 40px;">
            <div class="cartao">
                <div class="cartao-topo">
                    <div class="cartao-titulo">Saldo da conta</div>

                    <div class="acoes">
                        <button class="botao-icone" type="button" onclick="alternarValor(this, 'saldo')">
                            <img class="icone-visivel" src="{{ asset('icons/eye-on.svg') }}" width="18" height="18">
                            <img class="icone-escondido" src="{{ asset('icons/eye-off.svg') }}" width="18" height="18" hidden>
                        </button>
                        <button class="botao-icone" type="button" @disabled($saldoDefinido)
                                onclick="abrirPopup('saldo', 'Saldo da conta', {{ $saldo }})"
                                title="{{ $saldoDefinido ? 'O saldo da conta só pode ser definido uma vez' : 'Editar' }}">
                            <img src="{{ asset('icons/pencil.svg') }}" width="18" height="18">
                        </button>
                    </div>
                </div>
                <div class="cartao-valor" id="saldo" data-valor="{{ Moeda::euros($saldo) }}" style="margin-top: 12px;">{{ Moeda::euros($saldo) }}</div>
            </div>

            <div class="cartao">
                <div class="cartao-topo">
                    <div class="cartao-titulo">Despesas mensais</div>

                    <div class="acoes">
                        <button class="botao-icone" type="button" onclick="alternarValor(this, 'despesasMensais')">
                            <img class="icone-visivel" src="{{ asset('icons/eye-on.svg') }}" width="18" height="18">
                            <img class="icone-escondido" src="{{ asset('icons/eye-off.svg') }}" width="18" height="18" hidden>
                        </button>
                        <button class="botao-icone" type="button" onclick="abrirPopup('despesasMensais', 'Despesas mensais', {{ $despesasMensais }})">
                            <img src="{{ asset('icons/pencil.svg') }}" width="18" height="18">
                        </button>
                    </div>
                </div>

                <div class="cartao-valor" id="despesasMensais" data-valor="{{ Moeda::euros($despesasMensais) }}" style="margin-top: 12px;">{{ Moeda::euros($despesasMensais) }}</div>
            </div>
            
            <div class="cartao">
                <div class="cartao-topo">
                    <div class="cartao-titulo">Salário Bruto</div>

                    <div class="acoes">
                        <button class="botao-icone" type="button" onclick="alternarValor(this, 'salarioBruto')">
                            <img class="icone-visivel" src="{{ asset('icons/eye-on.svg') }}" width="18" height="18">
                            <img class="icone-escondido" src="{{ asset('icons/eye-off.svg') }}" width="18" height="18" hidden>
                        </button>
                        <button class="botao-icone" type="button" onclick="abrirPopup('salarioBruto', 'Salário Bruto', {{ $salarioBruto }})">
                            <img src="{{ asset('icons/pencil.svg') }}" width="18" height="18">
                        </button>
                    </div>
                </div>

                <div class="cartao-valor" id="salarioBruto" data-valor="{{ Moeda::euros($salarioBruto) }}" style="margin-top: 12px;">{{ Moeda::euros($salarioBruto) }}</div>
            </div>

            <div class="cartao">
                <div class="cartao-topo">
                    <div class="cartao-titulo">Salário Líquido</div>

                    <div class="acoes">
                        <button class="botao-icone" type="button" onclick="alternarValor(this, 'salarioLiquido')">
                            <img class="icone-visivel" src="{{ asset('icons/eye-on.svg') }}" width="18" height="18">
                            <img class="icone-escondido" src="{{ asset('icons/eye-off.svg') }}" width="18" height="18" hidden>
                        </button>
                        <button class="botao-icone" type="button" @disabled($salarioBruto <= 0)
                                onclick="abrirPopupIrs()"
                                title="{{ $salarioBruto <= 0 }}">
                            <img src="{{ asset('icons/pencil.svg') }}" width="18" height="18">
                        </button>
                    </div>
                </div>

                <div class="cartao-valor" id="salarioLiquido" data-valor="{{ Moeda::euros($salarioLiquido) }}" style="margin-top: 12px;">{{ Moeda::euros($salarioLiquido) }}</div>
            </div>
        </div>

        <div class="movimentos-topo" style="margin-top: 60px;">
            <div class="movimentos-titulo">Movimentos</div>

            <div class="movimentos-botoes">
                <button class="botao-adicionar" type="button" onclick="abrirPopupGanho()">
                    Adicionar Ganho
                </button>
                <button class="botao-adicionar" type="button" onclick="abrirPopupDespesa()">
                    Adicionar Despesa
                </button>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th class="numero">Valor</th>
                    <th class="numero">Saldo atual</th>
                    <th class="numero" style="display: flex; justify-content: flex-end; gap: 5px;">
                        Saldo no final do mês
                        <img src="{{ asset('icons/info.svg') }}" width="18" height="18" style="cursor: pointer;" title=" Saldo total + salário - despesas mensais ">
                    </th>
                </tr>
            </thead>

            <tbody>
                @forelse ($movimentos as $movimento)
                    <tr>
                        <td class="data">{{ $movimento['data'] }}</td>
                        <td class="descricao">{{ $movimento['descricao'] }}</td>
                        <td>
                            <span class="etiqueta {{ $movimento['classe'] }}">{{ $movimento['tipo'] }}</span>
                        </td>
                        <td class="{{ $movimento['valor'] < 0 ? 'valor-negativo' : 'valor-positivo' }}">
                            {{ $movimento['valor'] > 0 ? '+' : '' }}{{ Moeda::euros($movimento['valor']) }}
                        </td>
                        <td class="numero">{{ Moeda::euros($movimento['saldoAtual']) }}</td>
                        <td class="saldo-pos">{{ Moeda::euros($movimento['saldoPos']) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="vazio" colspan="6">Ainda não existem movimentos registados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <x-popup id="popupValor" ao-guardar="guardarValor(event)">
            <input class="popup-input" style="margin-top: 16px;" id="popupInput" type="text" inputmode="decimal" oninput="filtrarValor(this)" required autocomplete="off">
        </x-popup>

        <dialog id="popupConfirmar">
            <div class="popup-titulo">Confirmar saldo</div>

            <div class="popup-texto" style="margin-top: 14px;">
                Vai definir o saldo da conta como <strong id="confirmarValor"></strong>.
                Este valor só pode ser definido uma vez, e depois não é possível alterá-lo.
            </div>

            <div class="popup-botoes" style="margin-top: 20px;">
                <button type="button" onclick="fechar('popupConfirmar')">Rever</button>
                <button type="button" onclick="confirmarSaldo()">Confirmar</button>
            </div>
        </dialog>

        <x-popup id="popupGanho" titulo="Adicionar ganho" ao-guardar="guardarGanho(event)" botao="Adicionar">
            <input class="popup-input" style="margin-top: 16px;" id="ganhoDescricao" type="text" maxlength="255" placeholder="Descrição" required autocomplete="off">
            <input class="popup-input" style="margin-top: 16px;" id="ganhoValor" type="text" inputmode="decimal" oninput="filtrarValor(this)" placeholder="Valor" required autocomplete="off">
        </x-popup>

        <x-popup id="popupDespesa" titulo="Retirar despesa" ao-guardar="guardarDespesa(event)" botao="Retirar">
            <select class="popup-input" style="margin-top: 16px;" id="despesaTipo" required>
                @foreach (config('movimentos.tiposDespesa') as $tipo)
                    <option value="{{ $tipo }}">{{ $tipo }}</option>
                @endforeach
            </select>

            <input class="popup-input" style="margin-top: 16px;" id="despesaDescricao" type="text" maxlength="255" placeholder="Descrição" required autocomplete="off">
            <input class="popup-input" style="margin-top: 16px;" id="despesaValor" type="text" inputmode="decimal" oninput="filtrarValor(this)" placeholder="Valor" required autocomplete="off">
        </x-popup>

        <x-popup id="popupIrs" titulo="Salário Líquido" ao-guardar="guardarIrs(event)" botao="Calcular">
            <div class="irs-bruto" style="margin-top: 16px;">
                Salário bruto <strong>{{ Moeda::euros($salarioBruto) }}</strong>
            </div>

            <select class="popup-input" style="margin-top: 16px;" id="irsResidencia" required>
                @foreach (config('irs.residencias') as $residencia)
                    <option value="{{ $residencia }}" @selected($irs?->residencia === $residencia)>{{ $residencia }}</option>
                @endforeach
            </select>

            @foreach ([
                'irsEmAtividade' => ['emAtividade', 'Em atividade', null, null],
                'irsIncapacidade' => ['incapacidade', 'Incapacidade', null, 'irsDeficientesArmadas'],
                'irsCasado' => ['casado', 'Casado', null, 'irsConjugeEmAtividade'],
                'irsConjugeEmAtividade' => ['conjugeEmAtividade', 'Cônjuge em atividade', 'irsCasado', null],
                'irsDeficientesArmadas' => ['deficientesArmadas', 'Deficiente das Forças Armadas', 'irsIncapacidade', null],
            ] as $campo => [$coluna, $etiqueta, $aLigar, $aDesligar])
                <label class="interruptor" style="margin-top: 14px;">
                    <input type="checkbox" id="{{ $campo }}" @checked($irs?->{$coluna})
                           @if ($aLigar || $aDesligar) onchange="ligacao(this, '{{ $aLigar }}', '{{ $aDesligar }}')" @endif>
                    <span class="interruptor-calha"></span>
                    {{ $etiqueta }}
                </label>
            @endforeach

            <input class="popup-input" style="margin-top: 16px;" id="irsDependentes" type="text"
                   inputmode="numeric" placeholder="Número de dependentes" autocomplete="off"
                   value="{{ $irs?->dependentes }}" oninput="filtrarInteiro(this)" required>
        </x-popup>

        <script>
            let campoAtual = null;

            function abrir(id){
                document.getElementById(id).showModal();
            }

            function fechar(id){
                document.getElementById(id).close();
            }

            async function enviar(url, metodo, corpo){
                const resposta = await fetch(url, {
                    method: metodo,
                    headers:{
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify(corpo),
                });

                if (!resposta.ok){
                    alert(mensagemDeErro(await resposta.json()));
                    return;
                }

                window.location.reload();
            }

            function abrirPopup(campo, titulo, valor){
                campoAtual = campo;
                document.getElementById("popupValorTitulo").textContent = titulo;
                document.getElementById("popupInput").value = String(valor).replace(".", ",");
                abrir("popupValor");
            }

            function abrirPopupIrs(){
                document.getElementById("popupIrs").querySelector("form").reset();
                abrir("popupIrs");
            }

            function guardarIrs(event){
                event.preventDefault();

                enviar("{{ route('main.irs') }}", "PATCH", {
                    residencia: document.getElementById("irsResidencia").value,
                    emAtividade: document.getElementById("irsEmAtividade").checked,
                    incapacidade: document.getElementById("irsIncapacidade").checked,
                    casado: document.getElementById("irsCasado").checked,
                    conjugeEmAtividade: document.getElementById("irsConjugeEmAtividade").checked,
                    deficientesArmadas: document.getElementById("irsDeficientesArmadas").checked,
                    dependentes: Number(document.getElementById("irsDependentes").value || 0),
                });
            }

            function ligacao(origem, aLigar, aDesligar){
                if (origem.checked && aLigar){
                    document.getElementById(aLigar).checked = true;
                }

                if (! origem.checked && aDesligar){
                    document.getElementById(aDesligar).checked = false;
                }
            }

            function filtrarInteiro(input){
                input.value = input.value.replace(/[^0-9]/g, "");
            }

            function abrirPopupGanho(){
                document.getElementById("ganhoDescricao").value = "";
                document.getElementById("ganhoValor").value = "";
                abrir("popupGanho");
            }

            function abrirPopupDespesa(){
                document.getElementById("despesaTipo").selectedIndex = 0;
                document.getElementById("despesaDescricao").value = "";
                document.getElementById("despesaValor").value = "";
                abrir("popupDespesa");
            }

            function guardarGanho(event){
                event.preventDefault();

                enviar("{{ route('main.ganhos') }}", "POST", {
                    descricao: document.getElementById("ganhoDescricao").value,
                    valor: document.getElementById("ganhoValor").value.replace(",", "."),
                });
            }

            function guardarDespesa(event){
                event.preventDefault();

                enviar("{{ route('main.despesas') }}", "POST", {
                    tipo: document.getElementById("despesaTipo").value,
                    descricao: document.getElementById("despesaDescricao").value,
                    valor: document.getElementById("despesaValor").value.replace(",", "."),
                });
            }

            function filtrarValor(input){
                let valor = input.value.replace(/[^0-9,]/g, "");

                const partes = valor.split(",");

                if (partes.length > 1){
                    valor = partes.shift() + "," + partes.join("").slice(0, 2);
                }

                input.value = valor;
            }

            function mensagemDeErro(dados){
                if (dados.errors){
                    return Object.values(dados.errors).flat().join("\n");
                }

                return dados.message ?? "Ocorreu um erro inesperado.";
            }

            function formatarEuros(valor){
                return Number(valor.replace(",", ".")).toFixed(2).replace(".", ",") + " \u20AC";
            }

            function guardarValor(event){
                event.preventDefault();

                if (campoAtual === "saldo"){
                    document.getElementById("confirmarValor").textContent =
                        formatarEuros(document.getElementById("popupInput").value);
                    abrir("popupConfirmar");
                    return;
                }

                enviarValor();
            }

            function confirmarSaldo(){
                fechar("popupConfirmar");
                enviarValor();
            }

            function enviarValor(){
                enviar("{{ route('main.valores') }}", "PATCH", {
                    campo: campoAtual,
                    valor: document.getElementById("popupInput").value.replace(",", "."),
                });
            }

            function alternarValor(botao, id){
                const elemento = document.getElementById(id);
                const estavaEscondido = elemento.textContent === "******";

                elemento.textContent = estavaEscondido ? elemento.dataset.valor : "******";

                botao.querySelector(".icone-visivel").hidden = !estavaEscondido;
                botao.querySelector(".icone-escondido").hidden = estavaEscondido;
            }
        </script>
    </body>
</html>
