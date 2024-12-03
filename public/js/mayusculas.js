//Primer letra en mayuscula
function mayuscula(e) {
  e.value = e.value.charAt(0).toUpperCase() + e.value.slice(1);
}

const Checkbox = document.getElementById('Changeselect');
const slectInput = document.getElementById('categorySelect');
const selectCategory = document.getElementById('selectCategory')

//mandar a primera opcion select al activar checkbox
Checkbox.addEventListener('change', function () {
  if (this.checked) {
    //valor 1 a select
    slectInput.value = '';
  }
});

var precioNormal = document.getElementById('precioNormal');
var precioUrgente = document.getElementById('precioUrgente');
var nombreAnalisis = document.getElementById('nombreAnalisis');
var checktipo = document.getElementById('checktipo');
var Changeselect = document.getElementById('Changeselect');

precioNormal.addEventListener('keyup', function () {
  //transformar precioNormal a numero
  if (precioNormal.value) {
    var numeroNormal = parseFloat(precioNormal.value);
    var resultado = numeroNormal * 1.5;
    precioUrgente.value = resultado
  } else {
    precioUrgente.value = ''
  }
});

Changeselect.addEventListener('change', function () {
  //desactivar check
  checktipo.checked = false;
});

//reatrdar accion 15 seg despues de precionar teclas
nombreAnalisis.addEventListener('keyup', function (event) {
  setTimeout(function () {
    checktipo.checked = nombreAnalisis.value.length >= 3;
  }, 1500);
});

