<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="tr"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>IP Bilgileri - V1</title>
        <meta name="description" content="IP Bilgileri sayesinde girdiğiniz IP hakkında ki bilgilere kolaylıkla erişebilirsiniz.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <form method="POST">
            <input type="text" name="ip_adresi" placeholder="IP Adresini girin.">
            <button type="submit" name="sorgula">Sorgula</button>
        </form>
        <?php
        if(isset($_POST['sorgula'])) {
            //JSON Veriyi çek ve çöz
            $ip_bilgi = file_get_contents('http://ip-api.com/json/'.$_POST['ip_adresi']);
            $json_coz = json_decode($ip_bilgi, true);
 
            //IP Bilgilerini Listele
            echo '<hr>';
            echo '<b>IP:</b> ' . $json_coz['query'] . '<br>';
            echo '<b>Ülke:</b> '. $json_coz['country'] . '<br>';
            echo '<b>Ülke Kodu:</b> ' . $json_coz['countryCode'] . '<br>';
            echo '<b>Bölge:</b> ' . $json_coz['regionName'] . '<br>';
            echo '<b>Bölge Kodu:</b> ' . $json_coz['region'] . '<br>';
            echo '<b>Şehir:</b> ' . $json_coz['city'] . '<br>';
            echo '<b>Posta Kodu:</b> ' . $json_coz['zip'] . '<br>';
            echo '<b>Enlem:</b> ' . $json_coz['lat'] . '<br>';
            echo '<b>Boylam:</b> ' . $json_coz['lon'] . '<br>';
            echo '<b>Zaman Dilimi:</b> ' . $json_coz['timezone'] . '<br>';
            echo '<b>ISP:</b> ' . $json_coz['isp'] . '<br>';
            echo '<b>Organizasyon:</b> ' . $json_coz['org'] . '<br>';
            echo '<b>AS Numarası/Adı:</b> ' . $json_coz['as'] . '<br>';
            echo '<hr>';
            echo '<b>Harita:</b>';
            echo '<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script><div style="overflow:hidden;height:440px;width:700px;"><div id="gmap_canvas" style="height:440px;width:700px;"></div><div><small><a href="embed google map">http://embedgooglemaps.com</a></small></div><div><small><a href="https://googlemapsgenerator.com">embed google maps</a></small></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div><script type="text/javascript">function init_map(){var myOptions = {zoom:10,center:new google.maps.LatLng(39.9333635,32.85974190000002),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng('.$json_coz['lat'].','.$json_coz['lon'].')});infowindow = new google.maps.InfoWindow({content:"<strong>'.$json_coz['query'].'</strong><br>'.$json_coz['city'].', '.$json_coz['country'].'<br>"});google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, "load", init_map);</script> ';
            echo '<br>* Harita (Şehir ve Ülke) dışında ki yerleri doğru göstermeyebilir.';
        }
        ?>
    </body>
</html>
