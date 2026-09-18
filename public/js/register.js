    function goToLogin(){
        mostrarCarregamento();
        limparCampos()
        window.location.href = "/login";
    }

    function limparCampos(){
        document.getElementById("username").value = "";
        document.getElementById("email").value = "";
        document.getElementById("password").value = "";
        document.getElementById("confirmPassword").value = "";
    }

    function mensagemDeErro(dados){
        if (dados.errors){
            return Object.values(dados.errors).flat().join("\n");
        }

        return dados.message ?? "Ocorreu um erro inesperado.";
    }

    async function validarRegisto(event){
        event.preventDefault();
        const username = document.getElementById("username").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const password_confirmation = document.getElementById("confirmPassword").value;

        if (username === "" || email === "" || password === "" || password_confirmation === ""){
            alert("Por favor, preencha todos os campos.");
            return;
        }
        if (username.length < 4 || username.length > 20){
            alert("O nome de utilizador deve ter entre 4 e 20 caracteres.");
            return;
        }
        if (!username.match(/^[a-zA-Z0-9]+$/)){
            alert("O nome de utilizador deve conter apenas letras e números.");
            return;
        }
        if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)){
            alert("Indique um email válido.");
            return;
        }
        if (password !== password_confirmation){
            alert("As palavras-passe não coincidem.");
            return;
        }
        if (password.length < 6){
            alert("A palavra-passe deve ter pelo menos 6 caracteres.");
            return;
        }
        if (password.match(/^[a-zA-Z]+$/) || password.match(/^[0-9]+$/)){
            alert("A palavra-passe deve conter pelo menos uma letra e um número.");
            return;
        }

        mostrarCarregamento();

        const resposta = await fetch("/register",{
            method: "POST",
            headers:{
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
            },
            body: JSON.stringify({username, email, password, password_confirmation}),
        });

        esconderCarregamento();

        if (!resposta.ok){
            const dados = await resposta.json();
            alert(mensagemDeErro(dados));
            limparCampos();
            return;
        }

        goToLogin();
    }
