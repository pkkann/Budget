<?php
function outputJSON($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    die(0);
}