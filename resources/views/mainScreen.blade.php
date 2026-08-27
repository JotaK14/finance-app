<html>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body{
            background-color: #000000;
            color: #ffffff;
            font-family: Roboto, sans-serif;
            margin: 0;
            padding: 40px;
        }

        .header{
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .logout{
            margin-left: auto;
            padding: 12px 20px;
            border: 1px solid #2f2f2f;
            border-radius: 12px;
            background-color: transparent;
            color: #ffffff;
            font-family: inherit;
            font-size: 15px;
            cursor: pointer;
        }

        .logout:hover{
            background-color: #1c1c1c;
        }

        .avatar{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background-color: #1e3a8a;
            color: #ffffff;
            font-size: 18px;
            font-weight: 600;
        }

        .boas-vindas{
            font-size: 15px;
            font-weight: 400;
            color: #9ca3af;
        }

        .nome{
            font-size: 26px;
            font-weight: 600;
        }

        .cartoes{
            display: flex;
            gap: 60px;
            margin-top: 40px;
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
            color: #9ca3af;
        }

        .cartao-valor{
            font-size: 38px;
            font-weight: 600;
            margin-top: 12px;
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
            border: 1px solid #2f2f2f;
            border-radius: 10px;
            background-color: transparent;
            color: #ffffff;
            cursor: pointer;
        }

        .botao-icone:hover:not(:disabled){
            background-color: #1c1c1c;
        }

        .botao-icone:disabled{
            opacity: 0.35;
            cursor: not-allowed;
        }

        dialog{
            width: 320px;
            padding: 24px;
            border: 1px solid #2f2f2f;
            border-radius: 14px;
            background-color: #101010;
            color: #ffffff;
        }

        dialog::backdrop{
            background-color: rgba(0, 0, 0, 0.6);
        }

        .popup-titulo{
            font-size: 18px;
            font-weight: 600;
        }

        .popup-input{
            box-sizing: border-box;
            width: 100%;
            margin-top: 16px;
            padding: 10px;
            border: 1px solid #2f2f2f;
            border-radius: 8px;
            background-color: #000000;
            color: #ffffff;
            font-family: inherit;
            font-size: 16px;
        }

        select.popup-input{
            cursor: pointer;
        }

        .popup-texto{
            margin-top: 14px;
            font-size: 15px;
            line-height: 1.5;
            color: #9ca3af;
        }

        .popup-texto strong{
            color: #ffffff;
        }

        .popup-botoes{
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .popup-botoes button{
            padding: 10px 18px;
            border: 1px solid #2f2f2f;
            border-radius: 10px;
            background-color: transparent;
            color: #ffffff;
            font-family: inherit;
            font-size: 14px;
            cursor: pointer;
        }

        .popup-botoes button[type="submit"],
        .popup-botoes button[onclick="confirmarSaldo()"]{
            border-color: #ffffff;
            background-color: #ffffff;
            color: #000000;
        }

        .popup-botoes button:hover{
            opacity: 0.85;
        }

        [hidden]{
            display: none;
        }

        .despesas-topo{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 60px;
        }

        .despesas-titulo{
            font-size: 22px;
            font-weight: 600;
        }

        .botao-adicionar{
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            border: 1px solid #2f2f2f;
            border-radius: 12px;
            background-color: transparent;
            color: #ffffff;
            font-size: 15px;
            font-family: inherit;
            cursor: pointer;
        }

        .botao-adicionar:hover{
            background-color: #1c1c1c;
        }

        table{
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th{
            padding: 14px 16px;
            border-bottom: 1px solid #2f2f2f;
            color: #9ca3af;
            font-size: 14px;
            font-weight: 400;
            text-align: left;
        }

        td{
            padding: 16px;
            border-bottom: 1px solid #1c1c1c;
            font-size: 15px;
        }

        .data{
            color: #9ca3af;
        }

        .descricao{
            font-weight: 600;
        }

        .numero{
            text-align: right;
        }

        .valor{
            color: #f87171;
            text-align: right;
        }

        .saldo-pos{
            font-weight: 600;
            text-align: right;
        }

        .vazio{
            color: #9ca3af;
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
            border: 1px solid #78350f;
            background-color: #fcd34d;
            color: #78350f;
        }

        .transporte{
            font-weight: 600;
            border: 1px solid #1e40af;
            background-color: #bfdbfe;
            color: #1e40af;
        }

        .habitacao{
            font-weight: 600;
            border: 1px solid #7f1d1d;
            background-color: #fca5a5;
            color: #7f1d1d;
        }

        .lazer{
            font-weight: 600;
            border: 1px solid #14532d;
            background-color: #86efac;
            color: #14532d;
        }
    </style>
    <body>
        <div class="header">
            <div class="avatar">{{ Auth::user()->iniciais }}</div>

            <div>
                <div class="boas-vindas">Bem-vindo de volta</div>
                <div class="nome">{{ Auth::user()->name }}</div>
            </div>

            <button class="logout" type="button" onclick="window.location.href = '{{ route('login') }}'">
                <img src="{{ asset('icons/logout.svg') }}" width="18" height="18">
            </button>
        </div>

        <div class="cartoes">
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

                <div class="cartao-valor" id="saldo" data-valor="{{ euros($saldo) }}">{{ euros($saldo) }}</div>
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

                <div class="cartao-valor" id="despesasMensais" data-valor="{{ euros($despesasMensais) }}">{{ euros($despesasMensais) }}</div>
            </div>
        </div>

        <div class="despesas-topo">
            <div class="despesas-titulo">Despesas</div>

            <button class="botao-adicionar" type="button" onclick="abrirPopupDespesa()">
                <img src="{{ asset('icons/plus.svg') }}" width="16" height="16"> Adicionar despesa
            </button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th class="numero">Valor</th>
                    <th class="numero">Saldo atual</th>
                    <th class="numero">Saldo pós despesas mensais</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($despesas as $despesa)
                    <tr>
                        <td class="data">{{ $despesa['data'] }}</td>
                        <td class="descricao">{{ $despesa['descricao'] }}</td>
                        <td>
                            <span class="etiqueta {{ config('despesas.classes.'.$despesa['tipo']) }}">{{ $despesa['tipo'] }}</span>
                        </td>
                        <td class="valor">&minus;{{ euros($despesa['valor']) }}</td>
                        <td class="numero">{{ euros($despesa['saldoAtual']) }}</td>
                        <td class="saldo-pos">{{ euros($despesa['saldoPos']) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="vazio" colspan="6">Ainda não existem despesas registadas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <dialog id="popupValor">
            <form onsubmit="guardarValor(event)">
                <div class="popup-titulo" id="popupTitulo"></div>

                <input class="popup-input" id="popupInput" type="text" inputmode="decimal" oninput="filtrarValor(this)" required>

                <div class="popup-botoes">
                    <button type="button" onclick="document.getElementById('popupValor').close()">Cancelar</button>
                    <button type="submit">Guardar</button>
                </div>
            </form>
        </dialog>

        <dialog id="popupConfirmar">
            <div class="popup-titulo">Confirmar saldo</div>

            <div class="popup-texto">
                Vai definir o saldo da conta como <strong id="confirmarValor"></strong>.
                Este valor só pode ser definido uma vez, e depois não é possível alterá-lo.
            </div>

            <div class="popup-botoes">
                <button type="button" onclick="document.getElementById('popupConfirmar').close()">Rever</button>
                <button type="button" onclick="confirmarSaldo()">Confirmar</button>
            </div>
        </dialog>

        <dialog id="popupDespesa">
            <form onsubmit="guardarDespesa(event)">
                <div class="popup-titulo">Adicionar despesa</div>

                <select class="popup-input" id="despesaTipo" required>
                    @foreach (array_keys(config('despesas.classes')) as $tipo)
                        <option value="{{ $tipo }}">{{ $tipo }}</option>
                    @endforeach
                </select>

                <input class="popup-input" id="despesaDescricao" type="text" maxlength="255" placeholder="Descrição" required>
                <input class="popup-input" id="despesaValor" type="text" inputmode="decimal" oninput="filtrarValor(this)" placeholder="Valor" required>

                <div class="popup-botoes">
                    <button type="button" onclick="document.getElementById('popupDespesa').close()">Cancelar</button>
                    <button type="submit">Adicionar</button>
                </div>
            </form>
        </dialog>

        <script>
            let campoAtual = null;

            function abrirPopup(campo, titulo, valor){
                campoAtual = campo;
                document.getElementById("popupTitulo").textContent = titulo;
                document.getElementById("popupInput").value = String(valor).replace(".", ",");
                document.getElementById("popupValor").showModal();
            }

            function abrirPopupDespesa(){
                document.getElementById("despesaTipo").selectedIndex = 0;
                document.getElementById("despesaDescricao").value = "";
                document.getElementById("despesaValor").value = "";
                document.getElementById("popupDespesa").showModal();
            }

            async function guardarDespesa(event){
                event.preventDefault();

                const resposta = await fetch("{{ route('main.despesas') }}", {
                    method: "POST",
                    headers:{
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({
                        tipo: document.getElementById("despesaTipo").value,
                        descricao: document.getElementById("despesaDescricao").value,
                        valor: document.getElementById("despesaValor").value.replace(",", "."),
                    }),
                });

                if (!resposta.ok){
                    const dados = await resposta.json();
                    alert(mensagemDeErro(dados));
                    return;
                }

                window.location.reload();
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
                    document.getElementById("popupConfirmar").showModal();
                    return;
                }

                enviarValor();
            }

            function confirmarSaldo(){
                document.getElementById("popupConfirmar").close();
                enviarValor();
            }

            async function enviarValor(){
                const resposta = await fetch("{{ route('main.valores') }}", {
                    method: "PATCH",
                    headers:{
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({
                        campo: campoAtual,
                        valor: document.getElementById("popupInput").value.replace(",", "."),
                    }),
                });

                if (!resposta.ok){
                    const dados = await resposta.json();
                    alert(mensagemDeErro(dados));
                    return;
                }

                window.location.reload();
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
