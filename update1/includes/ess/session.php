<?php
$lifetime = 43200;
session_set_cookie_params($lifetime);
ini_set('session.gc_maxlifetime', $lifetime);

session_start();
?>