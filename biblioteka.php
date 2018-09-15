<?php
session_start();
// cuvanje podataka sezone i postavljanje cookia
if(isset($_POST['username']) && isset($_POST['pasw'])){
    $_SESSION['usern']= $_POST['username'];
    $_SESSION['paswd']= $_POST['pasw'];
    
}
//brisemo unete podatke u sesiji i ponovo ucitavamo stranicu
if(isset($_POST['logoff'])){
    setcookie('user', $_SESSION['usern'] , time()+7200);	
    if(isset($_SESSION['usern']))
       unset($_SESSION['usern']);
    if(isset($_SESSION['paswd']))
       unset($_SESSION['paswd']);
    header('Location: biblioteka.php'); 
}
include 'funkcije.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Библиотека</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="css/StilComp.css" />
        <script src="javascript/jquery-1.11.1.js"></script>
        <script src="javascript/promenaNaslovne.js"></script>
        <script type="text/javascript" src="javascript/proveraObrada.js"></script>
		<style type="text/css">
			#levi_sredina{
			   overflow:scroll;
			}
        </style>
    </head>

    <body onload="brojac()" style="background-image:url(slike/biblioteka.jpg);background-size: 100% 100%;background-repeat: no-repeat;">
        <div id="omotac">
                <?php include 'naslovna.php'; ?>
            <div id="sredina">
                <div id="levi_sredina">
				    <?php	
                        //povezujemo se sa bazom
							include	'db.inc';
                        //postavljamo da razmena podataka sa bazom koristi utf8 
                         mysqli_query($baza,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");					
                        //primena cookia  							
					    if (isset($_COOKIE["user"]))
                        echo "Drago mi je da ste se vratili " . $_COOKIE["user"] . "<br/>"; 
						//provera da li je korisnik vec ulogovan
					    if(strlen(isset($_SESSION['usern']))== 0){ 
					?>
                            <!-- format logovanja ime,sifra -->
		                    <form  name ="login" method="post"  action="">
                            Корисничко име: <input type="text" name="username" ><br/>
                            Шифра:          <input type="text" name="pasw"><br/>
                                            <input name="log" type="submit" value="Uloguj se">
                            </form>
				    <?php 
					    }else{
					        $username = $_SESSION['usern'];
                            $password = $_SESSION['paswd']; 
					        $korisnik=logovanje($username,$password,$baza);	
                            if(strcmp($korisnik,'')==0){
                                echo'<p>Niste registorvan korisnik ili niste uneli dobro šifru
								     <form method="post" action="">
								        <input name="logoff" type="submit" value="vratite se nazad">
								     </form>
									 </p>'; 
                            }else{					
	                ?>
	                            <p>
							        <form method="post" action="">
								        <input name="logoff" type="submit" value="Izloguj se">
								    </form>
							    </p>
		                        <p>Unesite šta želite da nađete:</p>
							    <!-- formular za pretragu sadrzaja -->
	                            <form name="pretrazi" method="post" action=""  >
                                    <input type="text" name="nadji"  > <br/>
                                    <input type="submit" name="trazi" value="Trazi"  ><br/>
                                </form>
					<?php
							    //unos novog clana
							    if(isset($_POST["unos"])){
									unosClana($baza,$_POST["broj_karte"],$_POST["ime"],$_POST["prezime"],$_POST["adresa"],$_POST["datum_rodjenja"],$_POST["sifra"]);
                                }
								//brisanje clana	
								if(isset($_POST['obrisi'])){
                                    obrisati($baza,$_POST['clanovi']);	  
                                }								
								//pretraga
                                if(isset($_POST['trazi'])){
                                    pretragaPodataka($baza,$_POST["nadji"],$korisnik);
							    }
							    //promena sadrzaja
							    if(isset($_POST['izmeni'])){
							        izmena($baza,$_POST['izmene'],$_POST['ID']);
							    }
								//unos iznajmljenih knjiga
							    if(isset($_POST['unos1'])){
							        unosIznajmi($baza,$_POST['clan'],$_POST['knjiga'],$_POST['datum_uzimanja']);
							    }
							    //Spisak Knjiga
							    if(isset($_POST['knjige']))
                                    ispisKnjiga($baza);
								else{
                    ?>
                                    <p>
							            <form method="post" action="">
								            <input name="knjige" type="submit" value="Prikaži knjige">
								        </form>
							        </p>  
				    <?php
                                }											
								//spisak Clanaka
								if(isset($_POST['clanci']))
								    ispisClanaka($baza);
                                else{
                    ?> 
							        <p>
							            <form method="post" action="">
								            <input name="clanci" type="submit" value="Prikaži članke">
								        </form>
							        </p>
                    <?php							
								}										   
		                        //proveravamo da li je administrator ulogovan
                                if(strcmp($korisnik,'Administrator')==0){
								    //Spisak clanovi
                                    if(isset($_POST['clanovi']))
								        ispisClanova($baza);
								    else{
                    ?>
							            <p>
							                <form method="post" action="">
								                <input name="clanovi" type="submit" value="Prikaži članove">
								            </form>
							            </p>
					<?php				
                                    }											
			                        //Ispisujemo spisak iznajmljenih knjiga
                                    if(isset($_POST['iznajmi']))
                                        ispisIznajmljivanje($baza);                           
				                    else{
                    ?>
                                        <p>
							                <form method="post" action="">
								                <input name="iznajmi" type="submit" value="Prikaži unose">
								            </form>
							            </p>
                    <?php							
									}
											 
	                ?>
                </div><!-- kraj levog diva-->
                <div id="desni_sredina" style="color:white;">
				    <?php           
					                if(isset($_POST['clanovi'])){
                    ?>
                    	                <!-- Formular za unos novog clana  -->										   
                                        <p>Unesite novog clana:</p>
                                        <form name="unosi" method="post" action="" onsubmit="return proveraUnosa();" >
                                        Ime:           <input type="text" name="ime" ><br/>
                                        Prezime:       <input type="text" name="prezime" ><br/>
										Šifra:         <input type="text" name="sifra" ><br/>
                                        Broj karte:    <input type="text" name="broj_karte"><br/>
			                            Adresa:        <input type="text" name="adresa"><br/>
                                        Datum Rođenja:<input type="text" name="datum_rodjenja" onChange="vreme(document.unosi.datum_rodjenja);">format zapisa(godina-mesec-dan)<br/>
                                                       <input type="submit" name="unos" value="Unesi"  ><br/>
                                        </form>
		                                <br/>
		                                <p>Obriši člana</p>
							            <!-- formular za brisanje clana -->
		                                <form name="brisanje"  method="post" action="" >
		                                    <select name="clanovi">
					<?php 
					                            formularBrisanje($baza);
                    ?>
                                            </select>
		                                    <input type="submit" name="obrisi" value="Obrisi"  ><br/>
		                                </form>
                    <?php
								    }
									if(isset($_POST['iznajmi'])){
                    ?>
                                        <!-- Formular za izmenu podataka iznajmljivanja  -->										   
                                        <p>Izmena tabele iznajmljivanje:</p>
                                        <form name="zamena" method="post" action="" onsubmit="return vreme(document.zamena.izmene);">
                                        Unesite ID Iznajmljivanja za izmenu:<select name="ID">
                    <?php 
					                                                            ispisID($baza);
                    ?>
                                                                            </select><br/>
									    Datum vraćanja:                <input type="text" name="izmene" onChange="vreme(document.zamena.izmene);" >format zapisa(godina-mesec-dan)<br/>
											                                <input type="submit" name="izmeni" value="Izmeni"  >
                                              
                                        </form>
										<br/>
                                        <p>Novi Unos:</p>
                    <?php             
						                formularIznajmi($baza); //formular za unos novih iznajmljivanja
						                         
									}
												 
                                }
		                        //Prekidamo kontakt sa bazom
		                        mysqli_close($baza);
 
                            }//else provere konekcije baze
                        }//kraj razdvajanja kad se korisnik ulogovao							   
                    ?>
                </div> <!--kraj desnog div-->
            </div>
            <div id="copyright">
                <?php include 'footer.php';?>
            </div>	
        </div>
    </body>
</html>
