<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
require_once 'config/database.php';
require_once 'controllers/BarangController.php';

$controller = new BarangController($conn);
$controller->index();