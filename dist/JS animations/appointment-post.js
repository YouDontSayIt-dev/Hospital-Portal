var timeSelect = document.getElementById("time-select");
var bookingDate = document.getElementById("booking-date");
var doctorSelect = document.getElementById("doctorBox");
var specialtySelect = document.getElementById("specialtyBox");

console.log(timeSelect);
console.log(bookingDate);
console.log(doctorSelect);
console.log(specialtySelect); 

function dataPost(){

    timeVar = timeSelect.value;
    dateVar = bookingDate.value;
    doctorVar = doctorSelect.value;
    specialtyVar = specialtySelect.value;

    document.cookie = "timeSelect=" + encodeURIComponent(timeVar);
    document.cookie = "bookingDate=" + encodeURIComponent(dateVar);
    document.cookie = "doctorSelect=" + encodeURIComponent(doctorVar);
    document.cookie = "specialtySelect=" + encodeURIComponent(specialtyVar);
    
    console.log(timeVar);
    console.log(dateVar);
    console.log(doctorVar);
    console.log(specialtyVar); 


}

function page_reload(){
    location.reload();
}