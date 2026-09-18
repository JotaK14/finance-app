    function goToLogin(){
        mostrarCarregamento();
        window.location.href = "/login";
    }

    function mensagemDeErro(dados){
        if (dados.errors){
            return Object.values(dados.errors).flat().join("\n");
        }

        return dados.message ?? "Ocorreu um erro inesperado.";
    }

    async function enviarLink(event){
        event.preventDefault();
        const email = document.getElementById("email").value;

        if (email === ""){
            alert("Indique o email da conta.");
            return;
        }

        mostrarCarregamento();

        const resposta = await fetch("/esqueci-a-password",{
            method: "POST",
            headers:{
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
            },
            body: JSON.stringify({ email }),
        });

        esconderCarregamento();

        if (!resposta.ok){
            const dados = await resposta.json();
            alert(mensagemDeErro(dados));
            return;
        }

        alert("Foi enviado um email com um link para definir uma nova palavra-passe.");
        goToLogin();
    }
