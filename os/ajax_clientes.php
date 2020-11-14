<?php

require '../config.php';
require DBAPI;
if(filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT)) {
    $id_cliente = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
    $db = open_database();
    $sql = "SELECT * FROM customers WHERE id = '$id_cliente'";
    $query = $db->query($sql);
    $responses = [];
    if($id_cliente > 0) {
        if($query->num_rows > 0) {
            while($response = $query->fetch_assoc()) {
                $responses=$response;
            }
            header("Content-Type: application/json");
            echo json_encode($responses);
        } else {
            header("HTTP/1.1 403 Forbidden");
            exit;    
        }
    } else {
        header("HTTP/1.1 403 Forbidden");
        exit;
    }
} else {
    header("HTTP/1.1 403 Forbidden");
    exit;
}