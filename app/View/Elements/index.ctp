<script>
    var url =  '<?php echo $this->request->base.'/'.$this->request->params['controller']; ?>'+'/sse_test';
    var mapOptions;
    var startPoint;
    var heatMap;
    var sligo;
    var map;
    var hmData;
    $(document).ready(function(){
        startPoint = new google.maps.LatLng(51.563412, 5.229492);
        sligo = new google.maps.LatLng(54.27455, -8.47339);
        mapOptions = {
            zoom: 4,
            mapTypeId: google.maps.MapTypeId.HYBRID,
            center: startPoint,
            disableDefaultUI: true,
            scrollwheel: true,
            draggable: true,
            navigationControl: true,
            mapTypeControl: true,
            scaleControl: true,
            disableDoubleClickZoom: false
        };
        initialize();
    });

    function initialize() {
        var mapCanvas = document.getElementById('map-canvas');

        hmData = new google.maps.MVCArray();

        map = new google.maps.Map(mapCanvas, mapOptions);
        heatMap = new google.maps.visualization.HeatmapLayer({
            "radius":20,
            "visible":true,
            "opacity":50,
            "data": hmData
        });
        heatMap.setMap(map);
    }

    if(typeof(EventSource) !== "undefined") {
        var source = new EventSource(url);
        source.onmessage = function(event) {
            var data = JSON.parse(event.data);
            console.log(data.lat);
            console.log(data.lng);
            document.getElementById("result").innerHTML += data.country + "<br>";
            latLng = new google.maps.LatLng(data.lat, data.lng);
            hmData.push(latLng);
        };

    } else {
        document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
    }
</script>
<div class="row">
    <div class="col-xs-8">
        <div id="map-canvas"></div>
    </div>
    <div class="col-xs-4">
        <div id="result">
        </div>
    </div>
</div>
