let EquipoUno = []
let EquipoDos = []
async function PokemonesAzar() {
  for (let i = 0; i < 3; i++){
    const id = Math.floor(Math.random() * 898) + 1
    const response = await fetch(`https://pokeapi.co/api/v2/pokemon/${id}`);
    const data = await response.json();
    EquipoUno[i] = {
      Nombre: data.name, 
      Ataque: data.stats.find(s => s.stat.name === 'attack').base_stat,
      Defensa: data.stats.find(s => s.stat.name === 'defense').base_stat,
      Imagen: data.sprites.other["official-artwork"].front_default
    }
  }
  for (let i = 0; i < 3; i++){
    const id = Math.floor(Math.random() * 898) + 1
    const response = await fetch(`https://pokeapi.co/api/v2/pokemon/${id}`);
    const data = await response.json();
    EquipoDos[i] = {
      Nombre: data.name, 
      Ataque: data.stats.find(s => s.stat.name === 'attack').base_stat,
      Defensa: data.stats.find(s => s.stat.name === 'defense').base_stat,
      Imagen:data.sprites.other["official-artwork"].front_default
    }
  }
  for (i = 0; i < EquipoUno.length; i++){
  document.getElementById("pokemonEquipoUno").innerHTML += `
    <div>
      <h4>${EquipoUno[i].Nombre}</h4>
      <img src="${EquipoUno[i].Imagen}" width="150">
      <p>Ataque: ${EquipoUno[i].Ataque}</p>
      <p>Defensa: ${EquipoUno[i].Defensa}</p>
    </div>`
  }
  for (i = 0; i < EquipoDos.length; i++){
    document.getElementById("pokemonEquipoDos").innerHTML += `
    <div>
      <h4>${EquipoDos[i].Nombre}</h4>
      <img src="${EquipoDos[i].Imagen}" width="150">
      <p>Ataque: ${EquipoDos[i].Ataque}</p>
      <p>Defensa: ${EquipoDos[i].Defensa}</p>
    </div>`
  }
}

let totalAtaque1 = 0
let totalDefensa1 = 0
let totalAtaque2 = 0
let totalDefensa2 = 0
async function peleaPokemon() {
  for(i=0; i <  EquipoUno.length; i++){
    totalAtaque1 += EquipoUno[i].Ataque
    totalDefensa1 += EquipoUno[i].Defensa
  }
  for(i=0; i <  EquipoDos.length; i++){
    totalAtaque2 += EquipoDos[i].Ataque 
    totalDefensa2 += EquipoDos[i].Defensa
  }
  if ((totalDefensa1 - totalAtaque2) > (totalDefensa2 - totalAtaque1)) {
    document.getElementById("TituloEquipoGanador").innerHTML +=`<h2> El ganador es el Equipo uno </h2>`
    for (let i = 0; i < EquipoUno.length; i++){
      document.getElementById("EquipoGanador").innerHTML +=`
      <div>
        <h4>${EquipoUno[i].Nombre}</h4>
        <img src="${EquipoUno[i].Imagen}" width="200">
        <p>Ataque: ${EquipoUno[i].Ataque}</p>
        <p>Defesa: ${EquipoUno[i].Defensa}</p>
      </div>`
    }
  } else if ((totalDefensa1 - totalAtaque2) < (totalDefensa2 - totalAtaque1)) {
    document.getElementById("TituloEquipoGanador").innerHTML +=`<h2> El ganador es el Equipo dos </h2>`
    for (let i = 0; i < EquipoDos.length; i++) {
      document.getElementById("EquipoGanador").innerHTML +=`
      <div>
        <h4>${EquipoDos[i].Nombre}</h4>
        <img src="${EquipoDos[i].Imagen}" width="200">
        <p>Ataque: ${EquipoDos[i].Ataque}</p>
        <p>Defensa: ${EquipoDos[i].Defensa}</p>
      </div>`
    }
  } else{
    document.getElementById("EquipoGanador").innerHTML +=`
    <div>
      <h2> El resultado de la batalla queda en empate, para desempatar se usara el resultado de los dados </h2>
    </div>`
    if (nrodados1 > nrodados2) {
      document.getElementById("EquipoGanador").innerHTML +=`
      <div>
        <h2> Por definicion de dados gana el Equipo uno </h2>
      </div>`
    } else if (nrodados1 < nrodados2) {
      document.getElementById("EquipoGanador").innerHTML +=`
      <div>
        <h2> Por definicion de dados gana el Equipo dos </h2>
      </div>`
    }
  }
}