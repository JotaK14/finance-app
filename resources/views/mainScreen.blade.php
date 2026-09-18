@use('App\Support\Moeda')
@use('Illuminate\Support\Js')
<link rel="stylesheet" href="{{ asset('css/colors.css') }}">
<link rel="stylesheet" href="{{ asset('css/loading.css') }}">
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<html>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <body>
        <div class="header">
            <div>
                <div class="boas-vindas">Bem-vindo de volta</div>
                <div class="nome">{{ Auth::user()->name }}</div>
            </div>

            <button class="botao-icone" style="margin-left: auto;" type="button" onclick="alternarTodosValores(this)">
                <img class="icone-visivel" src="{{ asset('icons/eye-on.svg') }}" width="18" height="18">
                <img class="icone-escondido" src="{{ asset('icons/eye-off.svg') }}" width="18" height="18" hidden>
            </button>

            <button class="logout" type="button" onclick="window.location.href = '{{ route('login') }}'">
                <img src="{{ asset('icons/logout.svg') }}" width="18" height="18">
            </button>
        </div>

        <div class="valores" style="margin-top: 40px;">
            <div class="cartao">
                <div class="cartao-topo">
                    <div class="cartao-titulo">Saldo da conta</div>

                    <div class="acoes">
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
                        <img src="{{ asset('icons/info.svg') }}" width="18" height="18" style="cursor: pointer;" title=" Saldo total + (Salário Bruto - Despesas Mensais - Segurança Social - IRS)">
                    </th>
                    <th></th>
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
                        <td style="display: flex; gap: 6px; justify-content: flex-end;">
                            <button class="botao-icone" style="width: 30px; height: 30px;" type="button"
                                onclick="abrirPopupEditarMovimento({{ $movimento['id'] }}, {{ Js::from($movimento['descricao']) }}, {{ abs($movimento['valor']) }})">
                                <img src="{{ asset('icons/pencil.svg') }}" width="14" height="14">
                            </button>
                            <button class="botao-icone" style="width: 30px; height: 30px;" type="button"
                                onclick="confirmarApagarMovimento({{ $movimento['id'] }})">
                                <img src="{{ asset('icons/trash.svg') }}" width="14" height="14">
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="vazio" colspan="7">Ainda não existem movimentos registados.</td>
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

        <x-popup id="popupEditarMovimento" titulo="Editar movimento" ao-guardar="guardarEdicaoMovimento(event)" botao="Guardar">
            <input class="popup-input" style="margin-top: 16px;" id="editarMovimentoDescricao" type="text" maxlength="255" placeholder="Descrição" required autocomplete="off">
            <input class="popup-input" style="margin-top: 16px;" id="editarMovimentoValor" type="text" inputmode="decimal" oninput="filtrarValor(this)" placeholder="Valor" required autocomplete="off">
        </x-popup>

        <dialog id="popupConfirmarApagarMovimento">
            <div class="popup-titulo">Apagar movimento</div>

            <div class="popup-texto" style="margin-top: 14px;">
                Tem a certeza que quer apagar este movimento? Esta ação não pode ser desfeita.
            </div>

            <div class="popup-botoes" style="margin-top: 20px;">
                <button type="button" onclick="fechar('popupConfirmarApagarMovimento')">Cancelar</button>
                <button type="button" onclick="apagarMovimentoConfirmado()">Apagar</button>
            </div>
        </dialog>

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

        @include('components.loading-overlay')

        <script src="{{ asset('js/loading.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>
