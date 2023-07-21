let specialtyMenu = document.getElementById('specialtyMenu');
let specialtyDropdown = document.getElementById('specialtyDropdown');
let specialtyBox = document.getElementById('specialtyBox');

var doctorSelect = document.getElementById("doctor-select");
var doctorID = document.getElementById("doctor-id");
var specialtySelect = document.getElementById("specialty-select");


specialtyMenu.onclick = function () {
    specialtyDropdown.style.display = specialtyDropdown.style.display === "none" ? "block" : "none";
}

function updateText(value) {
    specialtyBox.value = value;
    specialtySelect.value = value;
    specialtyDropdown.style.display = "none";
}

let doctorMenu = document.getElementById('doctorMenu');
let doctorDropdown = document.getElementById('doctorDropdown');
let doctorBox = document.getElementById('doctorBox');
let doctorSel = document.getElementById('docID')

let appointmentDetails = document.getElementById('appointmentDetails');



doctorMenu.onclick = function () {
    doctorDropdown.style.display = doctorDropdown.style.display === "none" ? "block" : "none";
}

function updateDoctorText(value) {
    doctorBox.value = value;
    doctorSelect.value = value;
    console.log(docID);
    doctorID.value = docID.getAttribute('name');
    doctorDropdown.style.display = "none";
}

function showAppointment(){
    appointmentDetails.style.display = appointmentDetails.style.display === "block" ? "none" : "block";
}


