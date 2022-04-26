function init() {


    var submit = document.getElementById("submit");
    var ul = document.getElementById("ul-pessoas");

    submit.addEventListener("click", function (event) {

        while (ul.children.length > 0) {
            ul.removeChild(ul.children[0]);
        }

        event.preventDefault();

        var total = parseFloat(document.getElementById("total").value);
        var qtdPessoas = parseInt(document.getElementById("qtd-pessoas").value);

        if (isNaN(total) || isNaN(qtdPessoas) || total <= 0 || qtdPessoas <= 0) {
            alert("Algum campo inválido!");
            return;
        }

        document.getElementById("h2-saida").style.display = "block";
        var conta = (total / qtdPessoas).toFixed(2);
        for (var i = 0; i < qtdPessoas; i++) {
            var li = document.createElement("li");
            if (i == qtdPessoas - 1) {
                li.innerHTML = `Valor a pagar pessoa ${i + 1}: R$ ${(parseFloat(conta) + parseFloat(total - (conta * qtdPessoas))).toFixed(2)}`;
            } else {
                li.innerHTML = `Valor a pagar pessoa ${i + 1}: R$ ${conta}`;
            }
            ul.appendChild(li);
        }



    });

}


document.addEventListener("DOMContentLoaded", init);