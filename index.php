<!DOCTYPE html>
<html>
    <head>
        <title>Врчин</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="css/StilComp.css" />
        <script type="text/javascript" src="javascript/jquery-1.11.1.js" ></script>
         <script type="text/javascript" src="javascript/promenaNaslovne.js" ></script>
		 <script type="text/javascript" src="javascript/slideshow.js" ></script>
		 <script type="text/javascript">
		    <!--primer AJAX-->
            function ucitaj()
             {
            var xmlhttp;
             
			 xmlhttp=new XMLHttpRequest();
 
             xmlhttp.onreadystatechange=function()
             {
             if (xmlhttp.readyState==4 && xmlhttp.status==200)
             {
               document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
              }
              }
               xmlhttp.open("GET","Pozdrav.txt",true);
               xmlhttp.send();
               }
            </script>
    </head>

    <body onload="brojac()">
        <div id="omotac">
             
			<?php include 'naslovna.php';?>
            
			<div id="sredina">
                <div id="levi_sredina">
				     <!-- primer rada sa tekstom -->
				    <h2>Mala istorija</h2>
                    <p>
                        Врчин је при­град­ско место Бео­града. При­пада Бео­град­ској општини Гроцка.
                        Од Бео­града је уда­љен 20 км.
                    </p>
                    <p>
                        По кази­вању Николе Апо­сто­ло­вића  у књизи <span style="font-style:italic;">„Прва књига о Врчину“</span>, постоје неко­лико легенди,
                        народ­них пре­дања о настанку имена Врчин.
                    </p>
                    <p>
                        Он бележи:
                           <br/>
                        „Нада­јући се да ћу у пре­дању наићи на решење заго­нетке имена Врчин многе сусе­љане,
                         са којима сам раз­го­ва­рао у сво­јим тра­га­њима, питао сам знају ли откуд име Врчин и шта оно значи.
                         Невро­ватна је шаро­ли­кост прича које сам чуо, од тога да је име доби­јено по нека­квој тикви од које
                         се суше­њем праве посуде, врчеви, преко приче о томе да је у Врчину било много кошница те се мед много
                        <span style="text-transform:uppercase;">врцао</span>,
                         затим да се први човек који се овде насе­лио, и то у пре­делу Гра­бља звао Врча, па све до духо­вите ска­ске о 
                         путо­писцу Енглезу који је овде поча­шћен вином тра­жио још пока­за­јући на врч и гово­рећи ин (у).
                         Риста Т. Нико­лић, који је кра­јем про­шлог века оби­ла­зио око­лину Бео­града, опи­си­вао поло­жаје и изглед села,
                         као и поре­кло ста­нов­ни­штва, за име Врчин није могао да каже ништа друго сем да је стра­ног поре­кла. 1948. године,
                         отац Васи­лије Дов­га­нић, пише: “Када су турци и овим тере­ном наста­нио се један бег између Бега­љице и Врчина,
                         коме су ова два села марала давати десе­так. Када је бег десе­так про­и­звољно пове­ћао,
                         досе­ље­ници су отво­рено про­тив тога “врчали”, бунили се, те по томе су људи око­лних села, ово мало насеље назвали Врчин.”
                    </p>

                    <p style="font-weight:bold;">
                        Врчин је место које се упо­знаје срцем. То нај­боље говори о њему.
                        Нај­бољи начин упо­знати га јесте доћи, видети и дожи­вети. Тада ће Вам све бити јасније... 
                    </p>
				    <!--Primer ubacivanja videa u html -->
		            <iframe width="420" height="305" src="http://www.youtube.com/embed/2ymMH7Ij91g" >
                    </iframe>
					<div id="myDiv"><p>Ајде мало да мењамо садржај.</p></div>
                    <p><button type="button" onclick="ucitaj()">Promeni sadrzaj</button></p>
                </div>
                <div id="desni_sredina">
                    <div id="galerija">
                        <?php include 'galerija.php';?>
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
