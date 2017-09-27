<?php

    include "videoStreamer.php";
    $stream = new VideoStream("../resources/videos/sample.mp4");
    $stream->start();
    exit;

?>