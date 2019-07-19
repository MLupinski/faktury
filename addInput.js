var i = 0;
function add() {

	var div = document.createElement('div');
	div.setAttribute('id', 'it'+i);

	var ad = document.createElement('input');
	ad.setAttribute('type', 'text');
	ad.setAttribute('name', 'item[]');
	ad.setAttribute('placeholder', 'Przedmiot');
	ad.setAttribute('class', 'intext');

	var ad2 = document.createElement('select');
	ad2.setAttribute('name', 'vat[]');
	ad2.options[ad2.options.length] = new Option('23');
	ad2.options[ad2.options.length] = new Option('8');
	ad2.options[ad2.options.length] = new Option('5');
	ad2.options[ad2.options.length] = new Option('0');
	ad2.options[ad2.options.length] = new Option('ZW');
	ad2.options[ad2.options.length] = new Option('NP');

	var ad3 = document.createElement('input');
	ad3.setAttribute('type', 'text');
	ad3.setAttribute('name', 'price[]');
	ad3.setAttribute('placeholder', 'Cena przedmiotu');
	ad3.setAttribute('class', 'intext');

	var ad4 = document.createElement('input');
	ad4.setAttribute('type', 'text');
	ad4.setAttribute('name', 'quantity[]');
	ad4.setAttribute('placeholder', 'Sztuk');
	ad4.setAttribute('class', 'intext');

	var la = document.createElement('label');

	la.innerHTML = "Nazwa: ";
	var la2 = document.createElement('label4');
	la2.innerHTML = "VAT[%]: ";
	var la3 = document.createElement('label');
	la3.innerHTML = "Kwota NETTO: ";
	var la4 = document.createElement('label5');
	la4.innerHTML = "Ilość: ";

	var el = document.getElementById('FV');
	el.appendChild(div);
	div.appendChild(la);
	la.appendChild(la2);
	div.appendChild(ad);
	div.appendChild(ad2);
	div.appendChild(la3);
	la3.appendChild(la4);
	div.appendChild(ad3);
	div.appendChild(ad4);
	
	i += 1;
};

var j = 0;
function del() {
		

		j = i - 1;
		var div = document.getElementById('it' + j);
		div.remove();	
		i -= 1;
};

var k = 0;

function add2() {

	var td = document.createElement('td');
	var div = document.createElement('div');
	div.setAttribute('id', 'it' + k);

	var ad = document.createElement('input');
	ad.setAttribute('type', 'text');
	ad.setAttribute('name', 'item[]');
	ad.setAttribute('placeholder', 'Przedmiot');
	ad.setAttribute('id','item' + k);

	var el = document.getElementById('nextInput');
	el.appendChild(div);
	div.appendChild(td);
	td.appendChild(ad);
	
	k += 1;
};

var l = 0;

function del2() {
		
		l = k - 1;

		var div = document.getElementById('it' + l);
		div.remove();

		k -= 1;
};