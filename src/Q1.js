
function init() {

    var precos = [99, 139, 189]; // Preco de cada tipo de quarto
    var taxa = 0.08;  // Taxa = 8%;

    var submit = document.getElementById("submit");

    submit.addEventListener("click", function (event) {

        event.preventDefault();

        var qtd = parseInt(document.getElementById("qtd-diarias").value);
        var tipo = parseInt(document.getElementById("tipos-quarto").value);

        if (isNaN(qtd) || qtd <= 0) {
            alert("Insira corretamente as diárias!");
            return;
        }

        var total = precos[tipo] * qtd * (1 + taxa);

        alert("O total a pagar é de R$" + total.toFixed(2));


    });



}




document.addEventListener("DOMContentLoaded", init);