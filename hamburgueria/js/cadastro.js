document.getElementById("formulario_cadastro").addEventListener("submit", function(e) {
    e.preventDefault();

    const nome = document.getElementById("nome").value.trim();
    const email = document.getElementById("email").value.trim();
    const senha = document.getElementById("senha").value.trim();

    if (!nome || !email || !senha  ) {
        alert("Por favor, preencha todos os campos!");
    } else {
        window.location.href = "../paginas/login.php";
    }
});

document.getElementById('telefone').addEventListener('input', function(e) {
    let input = e.target.value.replace(/\D/g, '');

    if (input.length > 0) {
        input = '(' + input;
    }
    if (input.length > 3) {
        input = input.slice(0, 3) + ') ' + input.slice(3);
    }
    if (input.length > 10) {
        input = input.slice(0, 10) + '-' + input.slice(10);
    }

    input = input.slice(0, 15);
    e.target.value = input;
});
