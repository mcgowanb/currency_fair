<script>
    var url =  '<?php echo $this->request->base.'/'.$this->request->params['controller']; ?>'+'/sse';
    var heatMap;
    var map;
    var hmData;
    var count = 0;
    var limit = 15;
    $(document).ready(function(){
        initialize();
    });

    function initialize() {
        var startPoint = new google.maps.LatLng(51.563412, 5.429492);
        var mapOptions = {
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
            if(count === limit){
                document.getElementById("result").innerHTML = '';
                count = 0;
            }
            var data = JSON.parse(event.data);
            document.getElementById("result").innerHTML += data.country + "<br>";
            latLng = new google.maps.LatLng(data.lat, data.lng);
            hmData.push(latLng);
            count++;
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
