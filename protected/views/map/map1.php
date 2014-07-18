<?php
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile('https://maps.googleapis.com/maps/api/js?v=3.exp&language=th');
?>
<div id="map-canvas" style="width: 100%; height: 100%"></div>

<script>

    var map = new google.maps.Map(document.getElementById("map-canvas"), {
        center: new google.maps.LatLng(16, 100), // พิกัดกึ่งกลางแผนที่
        zoom: 8,
    });

    // ส้รางหมุด หรือที่ฝรั่งเรียก Marker
    var marker_1 = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(16.3234, 100.086521),
        title: 'บ้านผู้ป่วยรายที่ 1'
    });

    var marker_2 = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(16.023145, 100.10123),
        title: 'บ้านผู้ป่วยรายที่ 2'
    });

    var circle = new google.maps.Circle({
        map: map,
        radius: 10000, // รัศมี เมตร
        strokeColor: '#FF0000',//สีเส้นขอบ
        strokeOpacity: 0.8,//ความโปร่งแสงเว้นขอบ
        strokeWeight: 2,//ความหนาเส้นขอบ
        fillColor: '#FF0000',//สีพื้นที่
        fillOpacity: 0.25,//ความโปร่งแสงพื้นที่
    });
    circle.bindTo('center', marker_1, 'position');




</script>
