<?php

//log in funkcija
function logovanje($username,$password,$baza1){
     $result = mysqli_query($baza1,"SELECT * FROM clanovi");
	 while($clan = mysqli_fetch_array($result)){
	       if((strcmp($clan{'broj_karte'},$username)==0) && (strcmp($clan{'sifra'},$password)==0))
		              return $clan{'ime'};
	 }
	 if((strcmp($username,'Administrator')==0) && (strcmp($password,'0205')==0))
	    return 'Administrator';
	 else
        return '';	 
	     

}

//Funkcije za ispis

//funkcija za ispis Knjiga
function ispisKnjiga($baza1){
    echo'<div class="oblasti">Knjige: </div>';
    $result = mysqli_query($baza1,"SELECT * FROM knjige");
    echo'<div><table><tr><th>ID</th><th>Naziv</th><th> Autor </th><th>Izdavač</th><th>Datum izdavanja</th></tr>';
    while($row = mysqli_fetch_array($result)) {
        echo "<tr><td>".$row{'id_knjige'}."</td><td> ".$row{'naziv'}."</td><td> ". //Ispisujemo rezultat
              $row{'autor'}."</td><td>".$row{'izdavac'}."</td><td>".$row{'izdanje'}."</td></tr>";
	}
    echo'</table></div>';
}

//funkcija za ispis Clanaka
function ispisClanaka($baza1){
    echo'<br/><div class="oblasti">Članci: <br/></div>';
    $result = mysqli_query($baza1,"SELECT * FROM novinski_clanci");
    while($row = mysqli_fetch_array($result)){
    echo "<div class='naslov'>".$row{'naslov'}."</div><div class='autor'>".$row{'autor'}."</div><div class='tekst'> ". //Ispisujemo rezultat
          $row{'tekst'}."</div><div class='datum'>".$row{'datum'}."</div><br/>";					
    }
             
}

//funkcija za ispis Clanova
function ispisClanova($baza1){
    echo'<div class="oblasti">Članovi:</div>';
    $clanovi = mysqli_query($baza1,"SELECT * FROM clanovi");
    echo'<div><table><tr><th>ID</th><th>Ime i Prezime</th><th> Adresa: </th><th> Datum Rođenja: </th></tr>';
    while($row = mysqli_fetch_array($clanovi)){
    echo "<tr> <td>".$row{'broj_karte'}."</td><td> ".$row{'ime'}." ". //Ispisujemo rezultat
          $row{'prezime'}."</td><td>".$row{'adresa'}."</td><td>".$row{'datum_rodjenja'}."</td></tr>";
    }                                     
    echo'</table></div><br/>';
}

//funkcija za ispis Iznajmljenih knjiga
function ispisIznajmljivanje($baza1){
    echo'<div class="oblasti">Spisak iznajmljenih knjiga:</div>';
    $result = mysqli_query($baza1,"SELECT * FROM iznajmljivanje");
    echo'<div><table><tr><th>ID</th><th>  ID Člana:</th><th>ID Knjige </th><th> Datum uzimanja: </th><th>Datum vraćanja:  </th></tr>';
    while($row = mysqli_fetch_array($result)){
        echo "<tr><td>".$row{'id_iznajmljivanja'}."</td> <td>".$row{'broj_karte'}."</td><td> ". //Ispisujemo rezultat
              $row{'id_knjige'}."</td><td>".$row{'datum_iznajmljivanja'}."</td><td> ".$row{'datum_vracanja'}."</td></tr>";
    }
	echo'</table></div>';
}

//funkcija za ispis id atributa
function ispisID($baza1){
    $ID = mysqli_query($baza1,"SELECT * FROM iznajmljivanje");
    while($row = mysqli_fetch_array($ID)) {
        echo "<option value=".$row{'id_iznajmljivanja'}.">".$row{'id_iznajmljivanja'}."</option><br/>"; //pravljenje select formulara od id 
    }
}

//funkcija za prikazivanje svi mogucih clanova za brisanje
function formularBrisanje($baza1){
    $clanovi = mysqli_query($baza1,"SELECT * FROM clanovi");
    while($row = mysqli_fetch_array($clanovi)){
        echo "<option value=".$row{'broj_karte'}.">".$row{'broj_karte'}." ".$row{'ime'}." ".$row{'prezime'}."</option><br/>"; //pravljenje select formulara za brisanje clanova
    }   
  			 
}

//funkcija za ispis formulara za unos Iznajmljenih knjiga
function formularIznajmi($baza1){
    echo "<form name='unosi1' method='post' action='' onsubmit='return vreme(document.unosi1.datum_uzimanja);'><br/>
	      Članovi:<select name='clan'>";
    formularBrisanje($baza1); //koristimo funkciju koju smo vec napisali za prikazivanje clanova
    echo "</select><br/>
	      Knjige:<select name='knjiga'>";
    $knjige = mysqli_query($baza1,"SELECT * FROM knjige");
    while($row = mysqli_fetch_array($knjige)){
        echo "<option value=".$row{'id_knjige'}.">".$row{'id_knjige'}." ".$row{'naziv'}." ".$row{'autor'}."</option><br/>";
    }
    echo "</select><br/>
	      Datum uzimanja:<input type='text' name='datum_uzimanja' onChange='vreme(document.unosi1.datum_uzimanja);'>
		  format zapisa(godina-mesec-dan)<br/>
          <input type='submit' name='unos1' value='Unesi'  ><br/>
          </form>"; 

}
//Funkcije za Unos

//funkcija za unos novih clanova
function unosClana($baza1,$broj_karte,$ime,$prezime,$adresa,$datum_rodjenja,$sifra){      
    //Unosimo podatke novog clana u bazu.
    $provera="INSERT INTO clanovi (broj_karte, ime, prezime,adresa,datum_rodjenja,sifra) VALUES ('$broj_karte','$ime','$prezime','$adresa','$datum_rodjenja','$sifra')";
    $vrednost=mysqli_query($baza1,$provera);
    //provera da li je unos uspešan   
	if($vrednost)
        echo'<div class="oznaka">Uspešno je član dodat.</div>';
    else
	    echo'<div class="oznaka">Neuspešno dodavanje pokušajte ponovo.</div>';
}

//funkcija za unos iznajmljenih knjiga
function unosIznajmi($baza1,$clan,$knjiga,$datum_uzimanja){
    $provera="INSERT INTO iznajmljivanje (broj_karte, id_knjige,datum_iznajmljivanja) VALUES ('$clan','$knjiga','$datum_uzimanja')";
    $vrednost=mysqli_query($baza1,$provera);
    //provera da li je unos uspešan
    if($vrednost)
        echo'<div class="oznaka">Uspešno unos.</div>';
    else
	    echo'<div class="oznaka">Neuspešan unos pokušajte ponovi.</div>';
}

//funkcija za pretragu tabela
function pretragaPodataka($baza1,$x,$admin){
    echo'<div class="naslov">Rezultati pretrage su:</div>';
    $m = htmlspecialchars($x);
    $pretraga = mysqli_real_escape_string($baza1,$m);
	//ako je korisnik admin pretrazujemo tablicu clanovi i iznajmljivanje
    if(strcmp($admin,'Administrator')==0){
	    //Pretrazujemo bazu clanovi
        $test = "SELECT * FROM clanovi WHERE (ime LIKE '%$pretraga%') OR (broj_karte LIKE '%$pretraga%') OR (prezime LIKE '%$pretraga%') OR (adresa LIKE '%$pretraga%') OR (datum_rodjenja LIKE '%$pretraga%') ";
        $rezultat = mysqli_query($baza1,$test) or die(mysqli_error($baza1));		   
        //Proveravamo da li je pretraga nasla nesto
        if(mysqli_num_rows($rezultat) > 0){
	        echo'<div class="oblasti">Članovi:</div>';
            echo'<div><table><tr><th>ID</th><th> Ime i Prezime</th><th> Adresa: </th><th> Datum Rođenja: </th></tr>';
            //Isppisujemo rezultate pretrage
            while ($row = mysqli_fetch_array($rezultat)) {
                echo "<tr> <td>".$row{'broj_karte'}."</td><td> ".$row{'ime'}." ".
                      $row{'prezime'}."</td><td>".$row{'adresa'}."</td><td>".$row{'datum_rodjenja'}."</td></tr>";
            }                                     
            echo'</table></div><br/>';
        }
	    //pretrazujemo tablicu iznajmljivanje
	    $test = "SELECT * FROM iznajmljivanje WHERE (id_iznajmljivanja LIKE '%$pretraga%') OR (broj_karte LIKE '%$pretraga%') OR (id_knjige LIKE '%$pretraga%') OR (datum_iznajmljivanja LIKE '%$pretraga%') OR (datum_vracanja LIKE '%$pretraga%') ";
        $rezultat = mysqli_query($baza1,$test) or die(mysqli_error($baza1));
        //Proveravamo da li ima rezultata pretrage
     	 
        if(mysqli_num_rows($rezultat) > 0){
            echo'<div class="oblasti">Spisak iznajmljenih knjiga:</div>';	 
            echo'<div><table><tr><th>ID</th><th>ID Člana</th><th> ID knjige </th><th>Datum Iznajmljivanja </th><th>Datum Vracanja</th></tr>';
            //ispisujemo rezultat pretrage		  
            while ($row = mysqli_fetch_array($rezultat)){
                echo "<tr><td>".$row{'id_knjige'}."</td><td> ".$row{'broj_karte'}."</td><td> ".
                      $row{'id_knjige'}."</td><td>".$row{'datum_iznajmljivanja'}."</td><td>".$row{'datum_vracanja'}."</td></tr>";
            }
		    echo'</table></div><br/>';
        }
	}
    //Pretrazujemo bazu knjige
    $test = "SELECT * FROM knjige WHERE (id_knjige LIKE '%$pretraga%') OR (autor LIKE '%$pretraga%') OR ( naziv LIKE '%$pretraga%') OR (izdavac LIKE '%$pretraga%') OR (izdanje LIKE '%$pretraga%') ";
    $rezultat = mysqli_query($baza1,$test) or die(mysqli_error($baza1));
     //Proveravamo da li ima rezultata pretrage	
    if(mysqli_num_rows($rezultat) > 0){
        echo'<div class="oblasti">Knjige: </div>';	 
        echo'<div><table><tr><th>ID</th><th>Naziv</th><th> Autor </th><th>Izdavac </th><th>Datum izdavanja</th></tr>';
        //ispisujemo rezultat pretrage		  
        while ($row = mysqli_fetch_array($rezultat)) {
            echo "<tr><td>".$row{'id_knjige'}."</td><td> ".$row{'naziv'}."</td><td> ". 
                  $row{'autor'}."</td><td>".$row{'izdavac'}."</td><td>".$row{'izdanje'}."</td></tr>";
        }
		echo'</table></div><br/>';
    }
	
	//pretrazujemo tablicu novinski clanci
    $test = "SELECT * FROM novinski_clanci WHERE (naslov LIKE '%$pretraga%') OR (autor LIKE '%$pretraga%') OR (tekst LIKE '%$pretraga%') OR (datum LIKE '%$pretraga%') ";
    $rezultat = mysqli_query($baza1,$test) or die(mysqli_error($baza1));
    //Proveravamo da li ima rezultata pretrage	
    if(mysqli_num_rows($rezultat) > 0){
        echo'<div class="oblasti">Članci: </div>';
        while ($row = mysqli_fetch_array($rezultat)){
        echo "<div class='naslov'>".$row{'naslov'}."</div><div class='autor'>".$row{'autor'}."</div><div class='tekst'> " //Ispisujemo rezultat
              .$row{'tekst'}."</div><div class='datum'>".$row{'datum'}."</div><br/>";					
        }
 
    }			  

}

//izmena podataka u tabeli Iznajmljivanje
function izmena($baza1,$zameni,$identifikacija){
	//menjamo sadrzaj u tablici
    $zameniti = "UPDATE iznajmljivanje SET datum_vracanja='$zameni' WHERE id_iznajmljivanja='$identifikacija' ";
    $vrednost =  mysqli_query($baza1,$zameniti) or die(mysqli_error($baza1));
    
    if($vrednost)
        echo'<div class="oznaka">Uspešno je unet datum.</div> ';
    else
	    echo'<div class="oznaka">Niste uspeli da unesete datum pokušajte ponovo.</div>';
}

//brisanje podataka iz tablice clanovi
function obrisati($baza1,$id){
	//Brisemo podatke clana u bazu.
    $zameniti = "DELETE FROM clanovi WHERE broj_karte='$id' ";
    $vrednost =  mysqli_query($baza1,$zameniti) or die(mysqli_error($baza1));
    if($vrednost)
        echo'<div class="oznaka">Uspešno je član obrisan.</div>';
    else
	    echo'<div class="oznaka">Neuspesno brisanje pokusajte ponovi.</div>';
}

?>