
//funkcija za proveru formulara da se ne ostavi prazno polje
function proveraUnosa(){
      
	if(document.unosi.ime.value.length==0){
	    window.alert("Nesmete da ostavite ovo polje prazno"); //upozoravamo korisnika da je polje prazno
	    document.unosi.ime.style.background="red";            //bojimo u crveno da bi prepoznao gde je greska
	    return false;
	}
	if(document.unosi.prezime.value.length==0){
	    window.alert("Nesmete da ostavite ovo polje prazno");
	    document.unosi.prezime.style.background="red";
	    return false;
	}
    if(document.unosi.sifra.value.length==0 || document.unosi.sifra.value.length>16){
        window.alert("Polje sifra mora da ima od 1 do 16 karaktera pokušajte ponovo");
		document.unosi.sifra.style.background="red";
        return false;
    }
    if(document.unosi.broj_karte.value.length==0){
	    window.alert("Nesmete da ostavite ovo polje prazno");
	    document.unosi.broj_karte.style.background="red";
	    return false;
	}
    if(document.unosi.adresa.value.length==0){
	    window.alert("Nesmete da ostavite ovo polje prazno");
	    document.unosi.adresa.style.background="red";
	    return false;
	}
	if(document.unosi.datum_rodjenja.value.length==0){
	    window.alert("Nesmete da ostavite ovo polje prazno");
	    document.unosi.datum_rodjenja.style.background="red";
	    return false;
	}
	if(vreme(document.unosi.datum_rodjenja)==false){
		document.unosi.datum_rodjenja.style.background="red";
		return false;
	}
	//vraca tacnu vrednost ako su sve provere tacne  
	return true;

}

//funkcija za proveru ispravnosti unetog datuma
function vreme(x){
          
    var re = /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/; //regularan izraz za proveru datuma formata godina-mesec-dan 
    if(re.test(x.value))
        x.style.background="#FFF";
    else{
        window.alert("Neispravan format datuma!");
        x.style.background="red";
        return false;
    }		 
}