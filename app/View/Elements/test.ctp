<script>

    if(typeof(EventSource) !== "undefined") {
        var source = new EventSource("sse_test");
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
            <h1>text here</h1>
        </div>
    </div>
</div>
