//&========================================================================================Elementos
var form1 = document.getElementById('form1');
var form2 = document.getElementById('form2');
var form3 = document.getElementById('form3');
var form4 = document.getElementById('form4');
var form5 = document.getElementById('form5');
var form6 = document.getElementById('form6');

var title1 = document.getElementById('title1');
var title2 = document.getElementById('title2');
var title3 = document.getElementById('title3');
var title4 = document.getElementById('title4');
var title5 = document.getElementById('title5');
var title6 = document.getElementById('title6');

var buttonNext1 = document.getElementById('butonNext1')
var buttonNext2 = document.getElementById('butonNext2')
var buttonNext3 = document.getElementById('butonNext3')
var buttonNext4 = document.getElementById('butonNext4')
var buttonNext5 = document.getElementById('butonNext5')

var butonPrevius1 = document.getElementById('butonPrevius1');
var butonPrevius2 = document.getElementById('butonPrevius2');
var butonPrevius3 = document.getElementById('butonPrevius3');
var butonPrevius4 = document.getElementById('butonPrevius4');
var butonPrevius5 = document.getElementById('butonPrevius5');
var butonPrevius6 = document.getElementById('butonPrevius6');


//&========================================================================================Categoria
var catId = document.getElementById('categoriaId');
var catName = document.getElementById('categoriaName');
var CatDesc = document.getElementById('categoriaDescription');

catId.addEventListener('input', function () {

	if (this.value.length) {
		catName.disabled = true;
		catName.value = '';

		CatDesc.disabled = true;
		CatDesc.value = '';

	} else {
		catName.disabled = false;
		CatDesc.disabled = false;
	}

});

butonNext1.addEventListener('click', function () {
	if (catId.value.length) {
		form1.classList.remove('flex');
		form1.classList.toggle('hidden');

		title1.classList.remove('text-sky-500');
		title1.classList.toggle('text-lime-500');
		title2.classList.toggle('text-sky-500');


		form2.classList.remove('hidden');
		form2.classList.toggle('flex');
	} else if (catName.value.length && CatDesc.value.length) {
		form1.classList.remove('flex');
		form1.classList.toggle('hidden');

		title1.classList.remove('text-sky-500');
		title1.classList.toggle('text-lime-500');
		title2.classList.toggle('text-sky-500');


		form2.classList.remove('hidden');
		form2.classList.toggle('flex');
	} else {
		alert('Debe seleccionar una categoria o agregar un nombre y descripcion');
	}
});


butonPrevius1.addEventListener('click', function () {
	form1.classList.remove('hidden');
	form1.classList.toggle('flex');

	title2.classList.remove('text-sky-500');
	title1.classList.remove('text-lime-500');
	title1.classList.toggle('text-sky-500');

	form2.classList.remove('flex');
	form2.classList.toggle('hidden');
});

//&========================================================================================Subcategoria



var subId = document.getElementById('subcategoriaId');
var subName = document.getElementById('subcategoriaName');

subId.addEventListener('input', function () {

	if (this.value.length) {
		subName.disabled = true;
		subName.value = '';

	} else {
		subName.disabled = false;
	}

});
butonNext2.addEventListener('click', function () {
	if (subId.value.length) {
		form2.classList.remove('flex');
		form2.classList.toggle('hidden');

		title2.classList.remove('text-sky-500');
		title2.classList.toggle('text-lime-500');
		title3.classList.toggle('text-sky-500');

		form3.classList.remove('hidden');
		form3.classList.toggle('flex');
		

	} else if (subName.value.length) {

		form2.classList.remove('flex');
		form2.classList.toggle('hidden');

		title2.classList.remove('text-sky-500');
		title2.classList.toggle('text-lime-500');
		title3.classList.toggle('text-sky-500');

		form3.classList.remove('hidden');
		form3.classList.toggle('flex');
	} else {
		alert('Debe seleccionar una subcategoria o agregar un nombre');
	}
});

butonPrevius2.addEventListener('click', function () {
	form2.classList.remove('hidden');
	form2.classList.toggle('flex');

	title3.classList.remove('text-sky-500');
	title2.classList.remove('text-lime-500');
	title2.classList.toggle('text-sky-500');


	form3.classList.remove('flex');
	form3.classList.toggle('hidden');
});

//&========================================================================================Unidad Metodo
var metId = document.getElementById('unidadmetodoId');
var metName = document.getElementById('unidadmetodoName');

metId.addEventListener('input', function () {


	if (this.value.length) {
		metName.disabled = true;
		metName.value = '';

	} else {
		metName.disabled = false;
	}

});

butonNext3.addEventListener('click', function () {

	if (metId.value.length) {
		form3.classList.remove('flex');
		form3.classList.toggle('hidden');

		title3.classList.remove('text-sky-500');
		title3.classList.toggle('text-lime-500');
		title4.classList.toggle('text-sky-500');

		form4.classList.remove('hidden');
		form4.classList.toggle('flex');
	} else if (metName.value.length) {
		form3.classList.remove('flex');
		form3.classList.toggle('hidden');

		title3.classList.remove('text-sky-500');
		title3.classList.toggle('text-lime-500');
		title4.classList.toggle('text-sky-500');

		form4.classList.remove('hidden');
		form4.classList.toggle('flex');
	} else {
		alert('Debe seleccionar una unidad de metodo o agregar un nombre');
	}
});

butonPrevius3.addEventListener('click', function () {
	form3.classList.remove('hidden');
	form3.classList.toggle('flex');

	title4.classList.remove('text-sky-500');
	title3.classList.remove('text-lime-500');
	title3.classList.toggle('text-sky-500');


	form4.classList.remove('flex');
	form4.classList.toggle('hidden');
});

//&========================================================================================unidad de Medida

var medId = document.getElementById('unidadmedidaId');
var medName = document.getElementById('unidadmedidaName');

medId.addEventListener('input', function () {


	if (this.value.length) {
		medName.disabled = true;
		medName.value = '';

	} else {
		medName.disabled = false;
	}

});

buttonNext4.addEventListener('click', function () {

	if (medId.value.length) {
		form4.classList.remove('flex');
		form4.classList.toggle('hidden');

		title4.classList.remove('text-sky-500');
		title4.classList.toggle('text-lime-500');
		title5.classList.toggle('text-sky-500');

		form5.classList.remove('hidden');
		form5.classList.toggle('flex');
	} else if (medName.value.length) {
		form4.classList.remove('flex');
		form4.classList.toggle('hidden');

		title4.classList.remove('text-sky-500');
		title4.classList.toggle('text-lime-500');
		title5.classList.toggle('text-sky-500');

		form5.classList.remove('hidden');
		form5.classList.toggle('flex');
	} else {
		alert('Debe seleccionar una unidad de metodo o agregar un nombre');
	}
});

butonPrevius4.addEventListener('click', function () {
	form4.classList.remove('hidden');
	form4.classList.toggle('flex');

	title5.classList.remove('text-sky-500');
	title4.classList.remove('text-lime-500');
	title4.classList.toggle('text-sky-500');


	form5.classList.remove('flex');
	form5.classList.toggle('hidden');
});

//&========================================================================================Tipo Muestra

var descripId = document.getElementById('tipomuestraId');
var descripName = document.getElementById('tipomuestraName');

descripId.addEventListener('input', function () {


	if (this.value.length) {
		descripName.disabled = true;
		descripName.value = '';

	} else {
		descripName.disabled = false;
	}

});

buttonNext5.addEventListener('click', function () {

	if (descripId.value.length) {
		form5.classList.remove('flex');
		form5.classList.toggle('hidden');

		title5.classList.remove('text-sky-500');
		title5.classList.toggle('text-lime-500');
		title6.classList.toggle('text-sky-500');

		form6.classList.remove('hidden');
		form6.classList.toggle('flex');
	} else if (medName.value.length) {
		form5.classList.remove('flex');
		form5.classList.toggle('hidden');

		title5.classList.remove('text-sky-500');
		title5.classList.toggle('text-lime-500');
		title6.classList.toggle('text-sky-500');

		form6.classList.remove('hidden');
		form6.classList.toggle('flex');
	} else {
		alert('Debe seleccionar una unidad de metodo o agregar un nombre');
	}
});

butonPrevius5.addEventListener('click', function () {
	form5.classList.remove('hidden');
	form5.classList.toggle('flex');

	title6.classList.remove('text-sky-500');
	title5.classList.remove('text-lime-500');
	title5.classList.toggle('text-sky-500');


	form6.classList.remove('flex');
	form6.classList.toggle('hidden');
});