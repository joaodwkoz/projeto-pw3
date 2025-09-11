document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("loginForm");
    const email = document.getElementById("email");
    const senha = document.getElementById("senha");
    const erroEmail = document.getElementById("erroEmail");
    const erroSenha = document.getElementById("erroSenha");

    form.addEventListener("submit", function(e) {
        let valido = true;

        erroEmail.textContent = "";
        erroSenha.textContent = "";

        if (email.value.trim() === "") {
            erroEmail.textContent = "O campo e-mail é obrigatório.";
            valido = false;
        } else {
            let regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!regexEmail.test(email.value)) {
                erroEmail.textContent = "Digite um e-mail válido.";
                valido = false;
            }
        }

        if (senha.value.trim() === "") {
            erroSenha.textContent = "O campo senha é obrigatório.";
            valido = false;
        } else if (senha.value.length < 6) {
            erroSenha.textContent = "A senha deve ter pelo menos 6 caracteres.";
            valido = false;
        }

        if (!valido) {
            e.preventDefault(); 
        }
    });
});
