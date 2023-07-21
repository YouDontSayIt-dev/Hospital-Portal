<?php

include("connection.php");
include("functions.php");
session_start();

$_SESSION['patientID'] = $_GET['ID'];

header("location:../doctor-patient-file.php");