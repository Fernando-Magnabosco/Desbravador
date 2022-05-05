function init() {

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'br',
        eventClick: function (info) {
            var otherPopups = document.getElementsByClassName("popup");
            for (var i = 0; i < otherPopups.length; i++) {
                otherPopups[i].remove();
            }
            var positionX = info.jsEvent.pageX;
            var positionY = info.jsEvent.pageY;
            var div = document.createElement("div");
            div.style.zIndex = "100";
            div.className = "popup";
            div.style.top = positionY + "px";
            div.style.left = positionX + "px";
            div.style.position = "absolute";
            div.style.backgroundColor = "white";
            div.style.border = "1px solid black";
            var total_presentes = info.event.extendedProps.presentes;
            var sala = info.event.extendedProps.sala;
            var close = document.createElement("span");
            close.innerText = "X";
            close.style.float = "right";
            close.style.cursor = "pointer";
            close.style.color = "red";
            close.addEventListener("click", function () {

                div.remove();
            });
            div.appendChild(close);
            div.appendChild(document.createTextNode("Total de presentes: " + total_presentes));
            div.appendChild(document.createElement("br"));
            div.appendChild(document.createTextNode("Sala: " + sala));
            document.body.appendChild(div);
        }
    });


    calendar.render();
    renderEvents(calendar);

    var prev = document.getElementsByClassName("fc-prev-button")[0];
    var next = document.getElementsByClassName("fc-next-button")[0];

    prev.addEventListener("click", renderEvents.bind(null, calendar));
    next.addEventListener("click", renderEvents.bind(null, calendar));





}

function renderEvents(calendar) {

    var data = calendar.getCurrentData().dateProfile.currentRange.start.toISOString()
    var mes = data.substring(5, 7);
    var ano = data.substring(0, 4);
    calendar.removeAllEvents();
    var result = fetchCultos(mes, ano);
    fillCultos(calendar, result);

}
function fillCultos(calendar, cultos) {
    cultos.then((cultos) => {

        cultos.forEach(culto => {
            var event = {
                title: "Culto",
                start: culto.data_hora,
                sala: culto.nome,
                presentes: culto.total_presentes
            }
            calendar.addEvent(event);
        });


    });

}
function fetchCultos(mes, ano) {

    var promise = fetch("../controller/get_functions.php", {
        headers: { 'content-type': 'application/json' },
        method: "POST",
        body: JSON.stringify({
            "id": 3,
            "mes": mes,
            "ano": ano
        })
    })
        .then((result) => {
            result = result.json();
            return result;
        }
        )
        .catch((error) => {
            console.log(error);
        }
        );
    return promise;


}



document.addEventListener("DOMContentLoaded", init);