    let campoAtual = null;
    let movimentoEditando = null;
    let movimentoApagando = null;

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

        enviar("/main/irs", "PATCH", {
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

        enviar("/main/ganhos", "POST", {
            descricao: document.getElementById("ganhoDescricao").value,
            valor: document.getElementById("ganhoValor").value.replace(",", "."),
        });
    }

    function guardarDespesa(event){
        event.preventDefault();

        enviar("/main/despesas", "POST", {
            tipo: document.getElementById("despesaTipo").value,
            descricao: document.getElementById("despesaDescricao").value,
            valor: document.getElementById("despesaValor").value.replace(",", "."),
        });
    }

    function abrirPopupEditarMovimento(id, descricao, valor){
        movimentoEditando = id;
        document.getElementById("editarMovimentoDescricao").value = descricao;
        document.getElementById("editarMovimentoValor").value = String(valor).replace(".", ",");
        abrir("popupEditarMovimento");
    }

    function guardarEdicaoMovimento(event){
        event.preventDefault();

        enviar(`/main/movimentos/${movimentoEditando}`, "PATCH", {
            descricao: document.getElementById("editarMovimentoDescricao").value,
            valor: document.getElementById("editarMovimentoValor").value.replace(",", "."),
        });
    }

    function confirmarApagarMovimento(id){
        movimentoApagando = id;
        abrir("popupConfirmarApagarMovimento");
    }

    function apagarMovimentoConfirmado(){
        fechar("popupConfirmarApagarMovimento");

        enviar(`/main/movimentos/${movimentoApagando}`, "DELETE", {});
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
        enviar("/main/valores", "PATCH", {
            campo: campoAtual,
            valor: document.getElementById("popupInput").value.replace(",", "."),
        });
    }

    function alternarTodosValores(botao){
        const ids = ["saldo", "despesasMensais", "salarioBruto", "salarioLiquido"];
        const estavaEscondido = document.getElementById(ids[0]).textContent === "******";

        ids.forEach((id) => {
            const elemento = document.getElementById(id);
            elemento.textContent = estavaEscondido ? elemento.dataset.valor : "******";
        });

        botao.querySelector(".icone-visivel").hidden = !estavaEscondido;
        botao.querySelector(".icone-escondido").hidden = estavaEscondido;
    }
