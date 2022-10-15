var elementoHTML = document.getElementById('estado')
if (elementoHTML.value === 'EM ESPERA') {
    elementoHTML.style.backgroundColor = 'yellow'
} else if (elementoHTML.value === 'A CAMINHO') {
    elementoHTML.style.backgroundColor = 'blue'
} else if (elementoHTML.value === 'ENTREGUE') {
    elementoHTML.style.backgroundColor = 'green'
} else if (elementoHTML.value === 'RECUSADO') {
    elementoHTML.style.backgroundColor = 'red'
}