<script>
    var url = '<?php echo $this->request->base.'/'.$this->request->params['controller']; ?>' + '/test_listener';
    if (typeof(EventSource) !== "undefined") {
        var source = new EventSource(url);
        source.onmessage = function(event) {
            document.getElementById("result").innerHTML += event.data + "<br>";
        };

    } else {
        document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
    }
</script>

<div class="row">
    <div class="col-xs-12">
        <div id="result">
        </div>
    </div>
</div>