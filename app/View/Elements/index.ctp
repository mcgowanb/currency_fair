<script>
    var url =  '<?php echo $this->request->base.'/'.$this->request->params['controller']; ?>'+'/sse_test';
    var mapOptions;
    var startLatLng;
    var heatMap;
    $(document).ready(function(){
        startLatLng = new google.maps.LatLng(51.563412, 5.229492);
        mapOptions = {
            zoom: 2,
            mapTypeId: google.maps.MapTypeId.HYBRID,
            center: startLatLng,
            disableDefaultUI: false,
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
        var mapOptions = {
            center: startLatLng,
            zoom: 4,
            mapTypeId: google.maps.MapTypeId.SATTELITE
        }
        var map = new google.maps.Map(mapCanvas, mapOptions);

        var pointArray = new google.maps.MVCArray(taxiData);

        heatMap = new google.maps.visualization.HeatmapLayer({
            "radius":10,
            "visible":true,
            "opacity":50,
        });
        heatMap.setMap(map);
    }

    var taxiData = [
        new google.maps.LatLng(37.782551, -122.445368),
        new google.maps.LatLng(37.751266, -122.403355)
    ];
    if(typeof(EventSource) !== "undefined") {
        var source = new EventSource(url);
        source.onmessage = function(event) {
            var data = JSON.parse(event.data);
            console.log(data.id);
            console.log(data.msg);
            document.getElementById("result").innerHTML += data.msg + "<br>";
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
