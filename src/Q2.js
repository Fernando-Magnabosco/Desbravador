

function init() {

    var divInitial = document.getElementById("initial-info");
    var divVendas = document.getElementById("vendas");

    var submitInitial = document.getElementById("submit-initial");
    var submitVendas = document.getElementById("submit-vendas");

    var qtdLitrosTanque;
    var valorLitro;

    submitInitial.addEventListener("click", function (event) {

        event.preventDefault();

        qtdLitrosTanque = parseInt(document.getElementById("qtd-tanque").value);
        valorLitro = parseFloat(document.getElementById("valor-litro").value);

        if (isNaN(qtdLitrosTanque) || isNaN(valorLitro) || qtdLitrosTanque <= 0 || valorLitro <= 0) {
            alert("Algum campo inválido!");
            return;
        }

        divInitial.style.display = "none";
        divVendas.style.display = "block";

    });


    submitVendas.addEventListener("click", function (event) {

        event.preventDefault();

        var qtdLitros = parseFloat(document.getElementById("qtd-litros").value);

        if (isNaN(qtdLitros) || qtdLitros <= 0) {
            alert("Campo inválido!");
            return;
        }

        if (qtdLitros > qtdLitrosTanque) {
            alert("Quantidade de litros maior que o tanque!");
            return;
        }

        var total = qtdLitros * valorLitro;
        qtdLitrosTanque -= qtdLitros;

        alert("O total a pagar é de R$" + total.toFixed(2));

        if (qtdLitrosTanque == 0) {
            alert("Tanque vazio!");
            divInitial.style.display = "block";
            divVendas.style.display = "none";
        }

    });


}





document.addEventListener("DOMContentLoaded", init);