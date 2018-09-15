//primena JQUERY

//Menjanje providnosti elementa
function slideshow(s1){
    //ako je slika1 vidljiva smanjujemo opacity na 0 i povecavamo opacity slike2 na 100
    if(s1==1){
        $("#slika1").fadeTo(5000,0);
        $("#slika2").fadeTo(5000,1);
    }
    //obrnuto
    else{
        $("#slika2").fadeTo(5000,0);
        $("#slika1").fadeTo(5000,1);
    }
}

//podesavanja intervala menjanja slika
function brojac(){ 
    window.setInterval(function (){slideshow(document.getElementById("slika1").style.opacity)}, 20000);
}
