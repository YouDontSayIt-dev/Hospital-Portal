<?php

include("connection.php");
include("functions.php");
session_start();

// update patient details
$patientID = $_SESSION['patientID'];
$doctorID = $_SESSION['doctorID'];
$age = $_POST['age-edit'];
$blood = $_POST['blood-edit'];
$height = $_POST['height-edit'];
$weight = $_POST['weight-edit'];
$temp = $_POST['temperature-edit'];
$o2 = $_POST['oxygen-edit'];
$pulse = $_POST['pulse-rate-edit'];
$bp = $_POST['blood-pressure-edit'];

$query = "UPDATE `patient details` SET `Age` = '".$age."', `Blood` = '".$blood."', `Height` = '".$height."', `Weight` = '".$weight."', `Temperature` = '".$temp."', `Oxygen Level` = '".$o2."', `Pulse Rate` = '".$pulse."', `Blood Pressure` = '".$bp."' WHERE `patientID` = '".$patientID."';";
$result = mysqli_query($con, $query);

if($result)
{
    header("location:../doctor-patient-file.php");
}
else{
    header("location:../doctor-patient-file-edit.php?update=error");
}

// insert to notes
$notes = $_POST['note-edit']; 

if(!(empty($notes))){
    $query = "INSERT INTO `notes` (`noteID`, `userID`, `doctorID`, `notes`) VALUES (NULL, '$patientID', '$doctorID', '$notes');";
    mysqli_query($con, $query); 
}

// insert to illness
$diagnosis = $_POST['diagnosis-edit']; 
$date = $_POST['date-edit'];
$status = $_POST['treatment-edit'];

// insert to medication
$med = $_POST['medication-edit']; 
$dosage = $_POST['dosage-edit'];
$daily = $_POST['daily-basis-edit'];
$instructions = $_POST['instruction-edit'];

if(!empty($diagnosis) && !empty($date) && !empty($status) && !empty($med) && !empty($dosage) && !empty($daily) && !empty($instructions)){
    $query = "INSERT INTO `illness` (`illnessID`, `Illness`, `date`, `notes`, `userID`, `doctorID`, `status`) VALUES (NULL, '$diagnosis', '$date', '', '$patientID', '$doctorID', '$status');";
    $result = mysqli_query($con, $query); 
    
    if($result){
        $query = "SELECT max(illnessID) as illnessID FROM `illness` WHERE userID=2 AND doctorID=1;";
        $result = mysqli_query($con, $query);

        if($row = mysqli_fetch_assoc($result)){
            $illnessID = $row['illnessID'];
            $query = "INSERT INTO `medication` (`medicineID`, `illnessID`, `userID`, `doctorID`, `medicine`, `dosage`, `notes`, `schedule`, `prescription_date`, `prescription_notes`) 
            VALUES (NULL, '$illnessID', '$patientID', '$doctorID', '$med', '$dosage', '$daily', '$instructions', '2023-07-12', 'Prescribed');";
            mysqli_query($con, $query); 
        }
    }
}


// insert to lab result
$labtest = $_POST['laboratory-edit']; 
$labres = $_POST['result-edit'];
$labdate = $_POST['lab-date-edit'];
$range = $_POST['range-edit'];

if(!empty($labtest) && !empty($labres) && !empty($labdate) && !empty($range)){
    $query = "INSERT INTO `lab_results` (`labresultID`, `doctorID`, `userID`, `date`, `lab_test`, `lab_result`, `normal_range`) VALUES (NULL, '$doctorID', '$patientID', '$labdate', '$labtest', '$labres', '$range')";
    mysqli_query($con, $query); 
}


// update
// $_POST['age-edit'];
// $_POST['blood-edit'];
// $_POST['height-edit'];
// $_POST['weight-edit'];
// $_POST['temperature-edit'];
// $_POST['oxygen-edit'];
// $_POST['pulse-rate-edit'];
// $_POST['blood-pressure-edit'];

// insert to notes
// $_POST['note-edit'];

// insert to illness
// $_POST['diagnosis-edit']; 
// $_POST['date-edit'];
// $_POST['treatment-edit'];

// insert to lab reults
// $_POST['laboratory-edit']; 
// $_POST['result-edit'];
// $_POST['lab-date-edit'];
// $_POST['range-edit'];

// insert to medication
// $_POST['medication-edit']; //medication
// $_POST['dosage-edit'];
// $_POST['daily-basis-edit'];
// $_POST['instruction-edit'];