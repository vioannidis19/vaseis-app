<?php

    $conn = new mysqli('', '', '', '');
    if ($conn->connect_error) die("Connection failed" . $conn->connect_error);