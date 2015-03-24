<script>
    var myOptions;
    var myLatlng;
    var heatMap;
    $(document).ready(function(){
        myLatlng = new google.maps.LatLng(40.0, 9.0);
        myOptions = {
            zoom: 2,
            mapTypeId: google.maps.MapTypeId.HYBRID,
            center: myLatlng,
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
            center: new google.maps.LatLng(37.774546, -122.433523),
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.SATTELITE
        }
        var map = new google.maps.Map(mapCanvas, myOptions);

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
    //google.maps.event.addDomListener(window, 'load', initialize);
</script>
<div id="map-canvas"></div>