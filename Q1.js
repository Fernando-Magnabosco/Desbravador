
function init() {

    var precos = [99, 139, 189]; // Preco de cada tipo de quarto
    var taxa = 0.08;  // Taxa = 8%;

    var selectedRoom = document.getElementById("tipos-quarto");
    var qtdDiarias = document.getElementById("qtd-diarias");
    var submit = document.getElementById("submit");

    submit.addEventListener("click", function (event) {

        event.preventDefault();

        var qtd = qtdDiarias.value;
        var tipo = selectedRoom.value;

        var total = precos[parseInt(tipo)] * qtd * (1 + taxa);

        alert("O total a pagar é de R$" + total.toFixed(2));


    });



}




document.addEventListener("DOMContentLoaded", init);