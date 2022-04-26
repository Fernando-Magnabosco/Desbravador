function init() {


    var hotel = criarHotel();
    popularHotel(hotel);

    var spanQtdQuartos = document.getElementById("qtd-quartos");
    var spanQtdHospedes = document.getElementById("qtd-hospedes");
    var ulQuartosDisponiveis = document.getElementById("quartos-disponiveis");

    spanQtdQuartos.innerText = qtdQuartosDisponiveis(hotel);
    spanQtdHospedes.innerText = qtdHospedes(hotel);

    var quartos = quartosDisponiveis(hotel);
    for (var i = 0; i < quartos.length; i++) {
        var li = document.createElement("li");
        li.innerText = `Andar ${quartos[i].andar}, Quarto ${quartos[i].quarto}`;
        ulQuartosDisponiveis.appendChild(li);
    }


}

function criarHotel() {

    var hotel = new Array(5);
    for (var i = 0; i < hotel.length; i++) {
        hotel[i] = new Array(8);
    }
    return hotel;
}

// Preenche o hotel aleatoriamente;
function popularHotel(hotel) {

    for (var i = 0; i < hotel.length; i++) {
        for (var j = 0; j < hotel[i].length; j++) {
            hotel[i][j] = Math.floor(Math.random() * 10);
        }
    }

}

// Retorna a quantidade de quartos disponíveis;
function qtdQuartosDisponiveis(hotel) {

    var qtdQuartosDisponiveis = 0;
    for (var i = 0; i < hotel.length; i++) {
        for (var j = 0; j < hotel[i].length; j++) {
            if (hotel[i][j] == 0) {
                qtdQuartosDisponiveis++;
            }
        }
    }
    return qtdQuartosDisponiveis;
}

// Numero do andar e numero de cada quarto disponível;

function quartosDisponiveis(hotel) {

    var quartosDisponiveis = new Array();
    for (var i = 0; i < hotel.length; i++) {
        for (var j = 0; j < hotel[i].length; j++) {
            if (hotel[i][j] == 0) {
                quartosDisponiveis.push({ "andar": i, "quarto": j });
            }
        }
    }
    return quartosDisponiveis;

}

// Retorna a quantidade de hóspedes atualmente no hotel;
function qtdHospedes(hotel) {

    var qtdHospedes = 0;
    for (var i = 0; i < hotel.length; i++) {
        for (var j = 0; j < hotel[i].length; j++) {
            qtdHospedes += hotel[i][j];
        }
    }
    return qtdHospedes;
}



document.addEventListener("DOMContentLoaded", init);