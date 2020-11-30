<?php
        session_start();  
?>
<!DOCTYPE html>
<html>
<head>
 <meta charset='utf-8'>
<?php include "../html/Head.html"?> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvzzWoLs2-LJiFqqsXRnKp7t1eFpeCw5E&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
    <style type="text/css">
      #map {
        height: 400px;
		margin: auto;
        width: 60%;
		border-style: solid;
		border-color: blue;
      }
    </style>
</head> 
<body> 
<?php include "../php/Menus.php" ?>
<section class="main" id="s1"> 
<div>
	<h2>DATOS DEL AUTOR/AUTORES</h2>
	<br><br>
	<p>Guillermo Arenales & Mikel Iturria 
	<br><br>
	Especialidad en Ingenieria del Software
	<br><br>
	<img src="../images/guille.jpeg" height="150">
	<img src="../images/mikel.jpg" height="150" >
	<br><br>
	<a href="mailto:garenales001@ikasle.ehu.eus">garenales001@ikasle.ehu.eus</a>
	<a href="mailto:miturria003@ikasle.ehu.eus">miturria003@ikasle.ehu.eus</a>
</div> 
<br><br>
<h3 style="color:blue;font-weight:bold;">Tus datos de conexión son:</h3>
<div style="margin:auto; width:60%;"> 
<?php include "getLocation.php";?>
</div>
<br><br>
<h3 style="color:blue;font-weight:bold;">Te encuentras en:</h3><br>

    <script>
      function initMap() {
        const pos = { lat: <?php echo "$latitud";?>, lng: <?php echo "$longitud";?> };
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 4,
          center: pos,
        });
        const marker = new google.maps.Marker({
          position: pos,
          map: map,
        });
      }
    </script>

<div id="map"></div>
</section>
<?php include "../html/Footer.html" ?>
</body> </html>