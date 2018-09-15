//promenljive: 
//slike sadrze niz naziva slika koje se nalaze u galeriji
var slike = ["slike/slika1.jpg", "slike/slika2.jpg", "slike/slika3.jpg", "slike/slika4.jpg", "slike/slika5.jpg" ];
//brojac odredjuje do koje smo slike dosli
var i=0;
//promenljiva za prekidanje intervala prikazivanja slideshow-a
var interval;

//funkcija predhodna prikazuje nam predhodnu sliku od trenutne prikazane			   
function prethodna(){
    if(i==0)
        i=4;
    else
        i--;
						 
    document.getElementById('zamena').src=slike[i]; //menjamo adresu img elementa 
				                                    //radi prikazivanje predhodne slike
}
//funkcija sledeca prikazuje sledecu sliku koja je u nizu				
function sledeca(){
    if(i==4)
        i=0;
    else 
        i++;
	
    document.getElementById('zamena').src=slike[i]; //menjamo adresu radi img elementa
                                                    //radi prikazivanje sledece slika 
}
//funkcija play prikazuje slike redom po intervalu
function play(){				    
    document.getElementsByName('sledeci')[0].disabled=true;   //iskljucujemo dugme sledeci
    document.getElementsByName('predhodni')[0].disabled=true; //iskljucujemo dugme prethodni
    interval=window.setInterval("prikazi()", 1000);           //postavljanje intervala menjana slika
}

//funkcija prikazi odredjuje koju sliku prikazujemo 
function prikazi(){
    i=(i+1)%5;
    document.getElementById('zamena').src=slike[i];
}

//funkcija zaustavi zaustavlja rad prikazivanja slika u intervalu u slideshow-u
function zaustavi(){
    window.clearInterval(interval);  //iskljucujemo interval
    document.getElementsByName('sledeci')[0].disabled=false;  //uskljucujemo dugme sledeci
    document.getElementsByName('predhodni')[0].disabled=false;	//ukljucujemo dugme prethodni
}