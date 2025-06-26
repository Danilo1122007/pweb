document.getElementById("formulario").addEventListener("submit", function(e) {
    e.preventDefault();
    
    const email = document.getElementById("email").value.trim();
    const senha = document.getElementById("senha").value.trim();

    if (!email || !senha) {
        alert("Por favor, preencha todos os campos!");
    } else {
        this.submit();
    }
});