function init() {

    var tablePessoas = document.getElementById("pessoas");
    var addPessoa = document.getElementById("addPessoa");

    fillAmbientes();
    var pessoas = fetchPessoas();
    var id = 0;


    addPessoa.addEventListener("click", function () {

        pessoas.then(vetorPessoas => {

            if (tablePessoas.childElementCount >= vetorPessoas.length) return;

            var tr = document.createElement("tr");
            var selectPessoa = document.createElement("select");
            selectPessoa.name = "p" + id;
            selectPessoa.setAttribute("form", "1");


            selectPessoa.addEventListener("change", function () {
                tr.removeChild(tr.lastChild);
                var selectFuncoes = fillFuncoes(fetchFuncoes(selectPessoa.value));
                selectFuncoes.firstChild.name = "f" + selectPessoa.name.substring(1);
                selectFuncoes.firstChild.setAttribute("form", "1");
                tr.appendChild(selectFuncoes);
            })
            tr.appendChild(fillPessoas(selectPessoa, pessoas));
            var selectFuncoes = fillFuncoes(fetchFuncoes(vetorPessoas[0].cpf));
            selectFuncoes.firstChild.name = "f" + id++;
            selectFuncoes.firstChild.setAttribute("form", "1");
            tr.appendChild(selectFuncoes);
            tablePessoas.appendChild(tr);
        })



    });




}

function fillAmbientes() {
    fetch("../controller/get_functions.php", {
        headers: { 'content-type': 'application/json' },
        method: "POST",
        body: JSON.stringify({
            "id": 0,
        })
    })
        .then((result) => {
            result = result.json();
            return result;
        })
        .then((result) => {

            var selectAmbiente = document.getElementById("ambiente");
            result.forEach(element => {
                var option = document.createElement("option");
                option.value = element.id;
                option.innerText = element.nome;
                selectAmbiente.appendChild(option);
            })
        })
        .catch((error) => {
            console.log(error);
        });

}

function fetchPessoas() {

    var promise = fetch("../controller/get_functions.php", {
        headers: { 'content-type': 'application/json' },
        method: "POST",
        body: JSON.stringify({
            "id": 1,
        })
    })
        .then((result) => {
            result = result.json();
            return result;
        })

        .catch((error) => {
            console.log(error);
        });
    return promise;

}

function fillPessoas(select, pessoas) {

    var td = document.createElement("td");
    pessoas.then((pessoas) => {
        pessoas.forEach(pessoa => {

            var option = document.createElement("option");
            option.value = pessoa.cpf;
            option.innerText = pessoa.nome;
            select.appendChild(option);

        });
    });
    td.appendChild(select);
    return td;


}

function fetchFuncoes(cpf) {

    var promise = fetch("../controller/get_functions.php", {
        headers: { 'content-type': 'application/json' },
        method: "POST",
        body: JSON.stringify({
            "id": 2,
            "cpf": cpf
        })
    })
        .then((result) => {
            result = result.json();
            return result;
        })
        .catch((error) => {
            console.log(error);
        });
    return promise;
}

function fillFuncoes(funcoes) {


    var td = document.createElement("td");
    var selectFuncoes = document.createElement("select");

    funcoes.then((funcoes) => {
        funcoes.forEach(funcao => {
            var option = document.createElement("option");
            option.value = funcao.id;
            option.innerText = funcao.descricao;
            selectFuncoes.appendChild(option);
        });
    });

    td.appendChild(selectFuncoes);
    return td;

}



document.addEventListener('DOMContentLoaded', init);