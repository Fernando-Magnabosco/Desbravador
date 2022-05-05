function init() {

    var opmenu = document.getElementById("opmenu-btn");
    var selectCreated = false;
    if (!selectCreated) var select = createSelect(opmenu, selectCreated);
    else select.style.display = "none";
    document.body.appendChild(select);

    opmenu.addEventListener("click", function () {

        if (select.style.display == "none")
            select.style.display = "block";
        else
            select.style.display = "none";



    });

}


function createSelect(opmenu, selectCreated) {

    selectCreated = true;
    var op = [
        { "texto": "Cadastrar membro", "link": "cadastro.php" },
        { "texto": "Cadastrar culto", "link": "culto.php" },
        { "texto": "Desconectar", "link": "logoff.php" },
    ];

    var ul = document.createElement("ul");

    op.forEach(function (element) {
        var li = document.createElement("li");
        li.style.border = "1px solid black";
        var a = document.createElement("a");
        a.style.textDecoration = "none";
        a.style.color = "black";
        a.innerText = element.texto;
        a.href = element.link;
        li.appendChild(a);
        ul.appendChild(li);
    });

    ul.style.position = "absolute";
    ul.style.backgroundColor = "white";
    ul.style.top = opmenu.offsetTop + opmenu.offsetHeight + "px";
    ul.style.right = opmenu.offsetHeight + "px";
    ul.style.margin = 0;
    ul.style.listStyle = "none";
    ul.style.display = "none";
    ul.style.padding = 0;


    return ul;

}

function changeCalendarBtnColor() {

    var calendarBtn = document.getElementById("calendar-btn");
    calendarBtn.style.backgroundColor = "white";
    calendarBtn.style.color = "black";
}

function navBarUserInformation(cpf, tipo) {

    var navbar = document.getElementById("navbar");
    var userInformation = document.createElement("p");
    userInformation.innerText = `Você está logado como ${cpf}, tipo ${tipo}`;
    navbar.children[0].appendChild(userInformation);

}
document.addEventListener("DOMContentLoaded", init);