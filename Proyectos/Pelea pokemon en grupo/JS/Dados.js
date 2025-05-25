let nrodados1 = 0
let nroTiradas1 = 0
function TirarDados1(){
    if (nroTiradas1 < 3) {
        const dado1 = Math.floor(Math.random() * 6) + 1;
        const dado2 = Math.floor(Math.random() * 6) + 1;
        const aux1 = dado1 + dado2
        nrodados1 += aux1
        nroTiradas1++
    }
    if (nroTiradas1 === 3) {
        document.getElementById("botonDados1").disabled = true;  
        document.getElementById("Resultadado1").innerHTML +=`Dados: ${nrodados1}` 
    }
} 
let nrodados2 = 0
let nroTiradas2 = 0
function TirarDados2(){
    if (nroTiradas2 < 3) {
        const dado1 = Math.floor(Math.random() * 6) + 1;
        const dado2 = Math.floor(Math.random() * 6) + 1;
        const aux2 = dado1 + dado2
        nrodados2 += aux2
        nroTiradas2++   
    }
    if (nroTiradas2 === 3) {
        document.getElementById("botonDados2").disabled = true;   
        document.getElementById("Resultadado2").innerHTML +=`Dados: ${nrodados2}`
    }
} 