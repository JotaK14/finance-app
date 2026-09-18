    function goToLogin(){
        window.location.href = "/login";
    }

    function mensagemDeErro(dados){
        if (dados.errors){
            return Object.values(dados.errors).flat().join("\n");
        }

        return dados.message ?? "Ocorreu um erro inesperado.";
    }

    async function guardarNovaPassword(event){
        event.preventDefault();
        const token = document.getElementById("token").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const password_confirmation = document.getElementById("confirmPassword").value;

        if (email === "" || password === "" || password_confirmation === ""){
            alert("Por favor, preencha todos os campos.");
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

        const resposta = await fetch("/redefinir-password",{
            method: "POST",
            headers:{
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
            },
            body: JSON.stringify({ token, email, password, password_confirmation }),
        });

        esconderCarregamento();

        if (!resposta.ok){
            const dados = await resposta.json();
            alert(mensagemDeErro(dados));
            return;
        }

        alert("Palavra-passe atualizada com sucesso.");
        goToLogin();
    }
