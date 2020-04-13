var increment=0;
var control=0;
function dynamique(){
	increment++
	var type = document.getElementById('type').value
	var dynamique = document.getElementById('dynamique')
	var nbre = document.getElementById('nbre')
	if(type=='0')
	{
		alert('choisissez le type svp')
	}else{
		if(type=='choixT'){
			control++
			if(control==1)
			{
				nbre.setAttribute('value',+increment)
				champ = document.createElement('input')
				champ.setAttribute('type','text')
				champ.setAttribute('required','required')
				champ.setAttribute('class','form-dynamique')
				champ.setAttribute('name','champs')
				champ.setAttribute('placeholder','entrer la reponse')
				dynamique.appendChild(champ)
			}else{alert('un seul champ autorisé pour le type texte')}
		}
			
	if (type=='choixM') 
	{
		if (increment <= 3) {
		nbre.setAttribute('value',+increment)
		champ = document.createElement('input')
		champ.setAttribute('type','text')
		champ.setAttribute('class','form-dynamique')
		champ.setAttribute('name','champs'+increment)
		champ.setAttribute('required','required')
		champ.setAttribute('placeholder','entrer une reponse')
		dynamique.appendChild(champ)
		//checkbox
		var checkbox = document.createElement('input')
		checkbox.setAttribute('type','checkbox')
		checkbox.setAttribute('name','champs[]')
		checkbox.setAttribute('id','check')
		checkbox.setAttribute('value','champ'+increment)
		dynamique.appendChild(checkbox);

		var btn_supp = document.createElement('input')
		btn_supp.setAttribute('type','button')
		btn_supp.setAttribute('class','btn-delete')
		btn_supp.setAttribute('name','supprimer')
		dynamique.appendChild(btn_supp)
	}else{ alert('trois reponses au maximum')}
			
	}else if(type=='choixS'){
		if (increment <= 3) {
		nbre.setAttribute('value',+increment)
		champ = document.createElement('input')
		champ.setAttribute('type','text')
		champ.setAttribute('required','required')
		champ.setAttribute('class','form-dynamique')
		champ.setAttribute('name','champs'+increment)
		champ.setAttribute('placeholder','entrer une reponse')
		dynamique.appendChild(champ)
		//radio
		var radio = document.createElement('input')
		radio.setAttribute('type','radio')
		radio.setAttribute('name','champs')
		radio.setAttribute('value','champ'+increment)
		dynamique.appendChild(radio);

		var btn_supp = document.createElement('input')
		btn_supp.setAttribute('type','button')
		btn_supp.setAttribute('class','btn-delete')
		btn_supp.setAttribute('name','supprimer')
		dynamique.appendChild(btn_supp)
		}else{ alert('trois reponses au maximum')}
	}
}
}
/*function Check()
{
	var box = document.getElementById('check')
	if (box.type.toLowerCase()=='checkbox'  && c.checked == true) { 
	
	}
}*/