    function goToRegister(){
        mostrarCarregamento();
        limparCampos()
        window.location.href = "/register";
    }

    function goToMain(){
        mostrarCarregamento();
        limparCampos()
        window.location.href = "/main";
    }

    function limparCampos(){
        document.getElementById("username").value = "";
        document.getElementById("password").value = "";
    }

    function mensagemDeErro(dados){
        if (dados.errors){
            return Object.values(dados.errors).flat().join("\n");
        }

        return dados.message ?? "Ocorreu um erro inesperado.";
    }

    async function validarLogin(event){
        event.preventDefault();
        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;

        if (username === "" || password === ""){
            alert("Por favor, preencha todos os campos.");
            return;
        }

        mostrarCarregamento();

        const resposta = await fetch("/login",{
            method: "POST",
            headers:{
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
            },
            body: JSON.stringify({ username, password }),
        });

        esconderCarregamento();

        if (!resposta.ok){
            const dados = await resposta.json();
            alert(mensagemDeErro(dados));
            limparCampos();
            return;
        }

        goToMain();
    }
