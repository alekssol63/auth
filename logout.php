<?php
session_start();
include 'functions.php';
logout();
header('Location: index.php');