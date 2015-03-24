<?php
    echo "data: {\n";
    echo "data: \"lat\": \"$lat\",\n";
    echo "data: \"lng\": \"$lng\",\n";
    echo "data: \"country\": \"$msg\"\n";
    echo "data: }\n\n";
    ob_flush();
    flush();
?>



