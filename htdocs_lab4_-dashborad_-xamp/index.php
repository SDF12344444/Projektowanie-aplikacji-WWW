<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Language" content="pl" />
<meta name="Autor" content="Adam Pyskło">
<link rel="stylesheet" href="http://localhost/css/css.css">
<title>Komputer moją pasją</title>
<script src="http://localhost/js/kolorujtlo.js" type="text/javascript"></script>
<script src="http://localhost/js/timedate.js" type="text/javascript"></script>
<script src="http://localhost/js/jquery.min.js"></script>
</head>
<body onload="startclock()">
<center>
<table>
<tr>
	<h1>Menu</h1>
</tr>
<tr>
    <th><h2><a href="komputer.html">Komputer</a></h2></th>
    <th><h2><a href="procesor.html">Procesor</a></h2></th>
    <th><h2><a href="karta_graficzna.html">Karta Graficzna</a><h2></th>
	<th><h2><a href="pamięć_ram.html">Pamięć RAM</a></h2></th>
	<th><h2><a href="dysk_twardy.html">Dysk Twardy</a></h2></th>
  </tr>
 
</table>
</center>
 <center>
    <h1>Zmień kolor tła </h1>
    <form METHOD="POST" NAME="tło">
    <INPUT TYPE="button" VALUE="Żółty" ONCLICK="changeBackground('#FFF000')">
    <INPUT TYPE="button" VALUE="Czarny" ONCLICK="changeBackground('#000000')">
    <INPUT TYPE="button" VALUE="Biały" ONCLICK="changeBackground('#FFFFFF')">
    <INPUT TYPE="button" VALUE="Zielony" ONCLICK="changeBackground('#00FF00')">
    <INPUT TYPE="button" VALUE="Niebieski" ONCLICK="changeBackground('#0000FF')">
        <INPUT TYPE="button" VALUE="Fioletowy" ONCLICK="changeBackground('#B803FF')">
    <INPUT TYPE="button" VALUE="Pomarańczowy" ONCLICK="changeBackground('#FF8000')">
    <INPUT TYPE="button" VALUE="Szary" ONCLICK="changeBackground('#C0C0C0')">
    <INPUT TYPE="button" VALUE="Czerwony" ONCLICK="changeBackground('#FF0000')">
     <INPUT TYPE="button" VALUE="Wróć do originalnego" ONCLICK="changeBackground('rgb(144, 238, 144)')">   
</form>
<br>
<div id="animacjaTestowa1"><h1> Zegarek</h1></div>

<form METHOD="POST" NAME="czas">
           <INPUT TYPE="button" VALUE="Zatrzymaj zegarek" ONCLICK="stopclock()">
           <INPUT TYPE="button" VALUE="Wznów zegarek" ONCLICK="startclock()">   
</form>
<div id="animacjaTestowa3" class="test-block">
<div id="zegarek"></div>  
<div id="data"></div>  
</div>

<br>
       
</center>  
<center>
<div><b>
Komputer</b> <i>(od ang. computer)</i>; dawniej: mózg elektronowy, elektroniczna maszyna cyfrowa, maszyna matematyczna– maszyna przeznaczona do przetwarzania informacji, które da się zapisać w formie ciągu cyfr albo sygnału ciągłego. Maszyna roku tygodnika „Time” w 1982 roku.

Mimo że mechaniczne maszyny liczące istniały od wielu stuleci, komputery w sensie współczesnym pojawiły się dopiero w połowie XX wieku, gdy zbudowano pierwsze komputery elektroniczne.<br><img  src="http://localhost/img/e.jpg"  width="300" height="300"><br> Miały one rozmiary sporych pomieszczeń i zużywały kilkaset razy więcej energii niż współczesne komputery osobiste <u>(PC)</u>, a jednocześnie miały miliardy razy mniejszą moc obliczeniową. Współcześnie są prowadzone także badania nad komputerami biologicznymi i optycznymi.

Małe komputery mogą zmieścić się nawet w zegarku i są zasilane baterią. Komputery osobiste stały się symbolem ery informatycznej. Najliczniejszymi maszynami liczącymi są systemy wbudowane sterujące najróżniejszymi urządzeniami – od odtwarzaczy MP3 i zabawek po roboty przemysłowe.
</div>
</center>
<br>
<div>



<center>
<img  src="http://localhost/img/e1.jpg"  width="300" height="300">
<img  src="http://localhost/img/e2.jpg"  width="300" height="300">
<img  src="http://localhost/img/e3.jpg"  width="300" height="300">
<img  src="http://localhost/img/e4.jpg"  width="300" height="300">
<img  src="http://localhost/img/e5.jpg"  width="300" height="300">
<img  src="http://localhost/img/e6.jpg"  width="300" height="300">
<img  src="http://localhost/img/e7.jpg"  width="300" height="300">
<img  src="http://localhost/img/e8.jpg"  width="300" height="300">
<img  src="http://localhost/img/e9.jpg"  width="300" height="300">
<img  src="http://localhost/img/e10.jpg"  width="300" height="300">
<img  src="http://localhost/img/e11.jpg"  width="300" height="300">
<img  src="http://localhost/img/e12.jpg"  width="300" height="300">
<img  src="http://localhost/img/e13.jpg"  width="300" height="300">
<img  src="http://localhost/img/e14.jpg"  width="300" height="300">
</center>
</div>

    
    


    <script>
        $("#animacjaTestowa1").on("click", function(){
            $(this).animate({
                width: "500px",
                opacity: 0.4,
                fontSize: "3em",
                borderWidth: "10px"
            }, 1500);
        });
    </script>
    

    


    <script>
        $("#animacjaTestowa3").on("click", function(){
            if (!$(this).is(":animated")) {
                $(this).animate({
                    width: "+=50",
                    height: "+=10",
                    opacity: "+=0.1"
                }, {
                    duration: 3000 // inny sposób deklaracji czasu trwania animacji
                });
            }
        });
    </script>
<center><h1>Kontakt</h1>
<form action="mailto:mail@.com" method="post" enctype="text/plain"><div>
<input name="Imię i Nazwisko">Imię i Nazwisko<br>
<p>Płeć:</p>
<input type="radio" name="Płeć" value="Kobieta">Kobieta
<input type="radio" name="Płeć" value="Mężczyzna">Mężczyzna
<p>Napisz wiadomość:</p>
<textarea name="Komentarz" cols="50" rows="10"></textarea>
<br><br><br>
<input type="submit" value="Wyślij formularz">
</div></form>
<div id="animacjaTestowa2" class="test-block">Najedź kursorem, a się powiększę</div>

    <script>
        $("#animacjaTestowa2").on("mouseover", function(){
            $(this).animate({
                width: 300
            }, 800);
        });

        $("#animacjaTestowa2").on("mouseout", function(){
            $(this).animate({
                width: 200
            }, 800);
        });
    </script>

</center>
</body>
</html>