<!DOCTYPE html>

<html >
    <head>
        <title>Контакт</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="css/StilComp.css" />
        <script src="javascript/jquery-1.11.1.js"></script>
        <script src="javascript/promenaNaslovne.js"></script>
        <script src="javascript/ostavljanjeKomentara.js"></script>
		<script src="javascript/slideshow.js"></script>
    </head>

    <body onload="brojac()">
        <div id="omotac">
      
                <?php include 'naslovna.php'; ?>
           
            <div id="sredina">
                <div id="levi_sredina">
		    
                        <div>
                            <h2>Остави коментар за администратора</h2>
                            <!-- primer formulara sa submit,input text, input textarea, reset i select kontrolom -->                  
                            <form name="ubaci" method="post">
                                Ваш Email: <input type="text" name="posaljioc" onChange="provera();"> <br/>
                                Порука: <br/><textarea rows="10" cols="40" name="poruka"></textarea><br/>
                                <input type="submit" name="send" value="Postavi" onClick="post();return false;"/>
                                <input type="reset" name="obrisi" value="Obrisi" onClick="resete();return false;"/>
                                <select id="boje">
                                    <option value="1">Бела</option>
                                    <option value="2">Жута</option>
                                    <option value="3">Плава</option>
                                    <option value="4">Розе</option>
                                </select>
								<input type="radio" name="pol" id="m" value="musko" />Мушко
                                <input type="radio" name="pol" id="z" value="zensko" />Женско<br/>
								<input type="checkbox" name="iskrivljen" value="italic" />искошен текст<br/>
                                <input type="checkbox" name="boldovan" value="bold" />подебљан текст
                            </form>
                        </div>
                        <div id="komentari">
						<p>Коментари:</p>
                        </div>
                </div>
                <div id="desni_sredina">
                    <div id="galerija">
			            <?php include 'galerija.php'; ?>
                    </div>
                    <div id="obavestenja">
                        <?php include 'obavestenja.php';?>
                    </div>		
                </div>
            </div>
            <div id="copyright">
                <?php include 'footer.php';?>
            </div>	
				
        </div>
    </body>
</html>
