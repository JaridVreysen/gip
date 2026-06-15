<?php
session_start();
session_unset();
session_destroy();

$response = array();
echo json_encode($response);
