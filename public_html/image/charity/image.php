<?php

if(!isset($_GET['id'])) {
	header('location:default.png');
	exit;
}

$id = (int) $_GET['id'];

if(file_exists($id.'.png')) {
	if(isset($_GET['time']))
		header('location:' . $id . '.png?time=' . time());
	else
		header('location:' . $id . '.png');
} else
	header('location:default.png');