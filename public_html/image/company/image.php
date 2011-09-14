<?php

if(!isset($_GET['id'])) {
	header('location:default.png');
	exit;
}

$id = (int) $_GET['id'];

if(file_exists($id.'.png')) {
	header('location:' . $id . '.png');
	exit;
} else {
	header('location:default.png');
	exit;
}