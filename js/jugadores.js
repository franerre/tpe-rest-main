"use strict";

const URL = "api/jugadores/";

let players = [];
let teams = [];
let form = document.querySelector('#player-form');
form.addEventListener('submit', insertJugador);

async function getAll() {
    try {
        let responsePlayers = await fetch(URL);
        if (!responsePlayers.ok) {
            throw new Error('Recurso de jugadores no existe');
        }
        players = await responsePlayers.json();

        let responseTeams = await fetch("api/equipos/");
        if (!responseTeams.ok) {
            throw new Error('Recurso de equipos no existe');
        }
        teams = await responseTeams.json();

        showJugadores();
        fillTeamsSelect();
    } catch (e) {
        console.log(e);
    }
}

async function insertJugador(e) {
    e.preventDefault();

    let data = new FormData(form);
    let player = {
        nombre: data.get('nombre'),
        apellido: data.get('apellido'),
        id_equipo: data.get('id_equipo'),
        imagen_jugador: data.get('imagen_jugador'),
    };

    try {
        let response = await fetch(URL, {
            method: "POST",
            headers: { 'Content-Type': 'application/json'},
            body: JSON.stringify(player)
        });

        if (!response.ok) {
            throw new Error('Error del servidor');
        }

        let newPlayer = await response.json();
        players.push(newPlayer);
        showJugadores();
        form.reset();
    } catch (error) {
        console.log(error);
    }
}

async function deleteJugador(e) {
    e.preventDefault();
    try {
        let id = e.target.dataset.player;
        let response = await fetch(URL + id, { method: 'DELETE' });
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }

        players = players.filter(player => player.id != id);
        showJugadores();
    } catch (error) {
        console.log(error);
    }
}

function fillTeamsSelect() {
    let select = document.querySelector('#id_equipo');
    select.innerHTML = "";

    for (const team of teams) {
        console.log("Team Object: ", team); 
        let option = document.createElement('option');
        option.value = team.id_equipo || team.id; 
        option.textContent = team.equipo;
        select.appendChild(option);
    }
    console.log("fillTeamsSelect called"); 
}



function showJugadores() {
    let ul = document.querySelector("#player-list");
    ul.innerHTML = "";
    
    for (const player of players) {
        // Ruta completa a la imagen del jugador
        let imageUrl = `./imagenes/jugadores/${player.imagen_jugador}`;
        
        let html = `
            <li class='list-group-item d-flex justify-content-between align-items-center'>
                <span class="d-flex align-items-center">
                    <img src="${imageUrl}" alt="Imagen de ${player.nombre}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%; margin-right: 10px;">
                    <b>${player.nombre}</b> ${player.apellido} (Equipo ID: ${player.id_equipo})
                </span>
                <div class="ml-auto">
                    <a href='#' data-player="${player.id}" type='button' class='btn btn-danger btn-delete'>Borrar</a>
                    <a href='#' data-player="${player.id}" type='button' class='btn btn-primary edit-button'>Editar</a>
                </div>
            </li>
        `;
        ul.innerHTML += html;
    }

    const btnsDelete = document.querySelectorAll('a.btn-delete');
    for (const btnDelete of btnsDelete) {
        btnDelete.addEventListener('click', deleteJugador);
    }
}


getAll();
