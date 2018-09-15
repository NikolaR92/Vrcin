//Primer provere email adrese.
function provera(){
    var email = document.ubaci.posaljioc.value;
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(re.test(email))
        ;
    else{
        window.alert("Neispravan formait email adrese!");
        document.ubaci.posaljioc.style.background="red";
    }
}

//Primer ponistavanja sadrzaja u formularu.
function resete(){
    var n = confirm("Je l' ste sigurni da želite da poništite sadržaj");
    if(n){			  
        document.ubaci.posaljioc.value="";
        document.ubaci.poruka.value="";  
    }
                
}

//Primer menjanja html elementa pri primeni submit dugmeta.
function post(){
    var email = document.ubaci.posaljioc.value;
    var poruka=document.ubaci.poruka.value;  
    var username="";		    
    //Proveravamo da li su polja email i poruka prazna.
    if(email.length==0){                      
        window.alert("Niste uneli email adresu. ");
        document.ubaci.posaljioc.style.background="red";
    }
    else if(poruka.length==0){
            window.alert("Polje poruka ste ostavili prazno.");
            document.ubaci.posaljioc.style.background="red";
        }else{
            //trazimo da korisnik unese nadimak
            while(username.length == 0){
                username = window.prompt("Unesite nadimak:","");
                if(username.length != 0)
                    break;
                else{
                    window.alert("Ostavili ste prazno polje, pokušajte ponovo!!")
                }
            } 
                		
            var vrednost = document.getElementById("boje").selectedIndex;      //Uzimamo vrednost select kontrolera
            var boja=document.getElementsByTagName("option")[vrednost].value;  //smestamo boju koju smo izabrali u promenljivu
            var element=document.getElementById("komentari");                 //Uzimamo element gde ce da se smeste komentari
                           
            //Kreairanje elementa pasusa i dodavanje atributa
            var x = document.createElement("p");
            x.className +="email_adresa";
            x.style.background="url('slike/navpozadina.jpg') 100% 100% no-repeat";
            x.style.textAlign="center";
            x.style.color="#FFF";
            var node = document.createTextNode(username);  //uzimamo nadimak i smestamo ga u pasus
            x.appendChild(node);
            //Kreiramo img element kao reakciju na radio dugme gde se birao pol 
            var slika = document.createElement("img");
            //Proveravamo da li je izabarno muski ili zenski pol dodajemo odgovarajuce slike i dodajemo stilove
            if(document.getElementById('m').checked){
                slika.setAttribute('src', 'slike/musko.jpg');
            }
            else if(document.getElementById('z').checked){
                    slika.setAttribute('src', 'slike/zensko.jpeg');
                }
            slika.style.marginTop = "4px";
            slika.style.marginBottom = "0px";
            slika.style.marginLeft = "30px";
            slika.style.width= '20px';
            slika.style.height= '20px';

            //Smesatmo sliku u p element
            x.appendChild(slika);
            element.appendChild(x); //p element smestamo u div 
						   
            //kreiramo novi p element za poruku dodajemo atribute i stil
            var y = document.createElement("p");
            y.className +="poruke";
            var node1 = document.createTextNode(poruka);
            y.style.border="2px solid";
            y.style.wordWrap="break-word";
						 
            //dodavanje mogucnosti da se stilizuje tekst
            if(document.ubaci.iskrivljen.checked){
                y.style.fontStyle = "italic";  //Formular za stil slova
            }
            if(document.ubaci.boldovan.checked){
                y.style.fontWeight = "bold";
            }
							
            //menjamo boju pozadine
            switch(boja){
                case "2":
                    y.style.background="yellow";
                    break;
                case "3":
                    y.style.background="blue";
                    break;
                case "4":
                    y.style.background="pink";
                    break;
                }
									   
            y.appendChild(node1);  //dodajemo tekst poruke
            element.appendChild(y); //smestamo p element u div sa komentarima
							
            window.alert("Uspešno ste postavili komentar");
        }           
}
