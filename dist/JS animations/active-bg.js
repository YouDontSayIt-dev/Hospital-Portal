function toggleActiveClass() {
    var listItems = document.querySelectorAll('#medicationList .item');
    
    listItems.forEach(function(item) {
      item.addEventListener('click', function() {
        // Toggle the active class for the clicked item
        item.classList.remove('bg-background-inactive');
        item.classList.add('bg-white');

        // Remove active class from all list items except the clicked item
        listItems.forEach(function(li) {
            if (li !== item) {
              li.classList.remove('bg-white');
              li.classList.add('bg-background-inactive');
            }
        });
      });
    });
}
  
toggleActiveClass();

function toggleActiveClassTime() {
  var listItemsTime = document.querySelectorAll('#timeSlotList .time');
  var timeSelect = document.getElementById('time-select');

  listItemsTime.forEach(function(time) {
    time.addEventListener('click', function() {
      // Toggle the active class for the clicked item
      time.classList.remove('bg-form-fill');
      time.classList.add('bg-time-active');
      timeValue = time.getAttribute('value');
      timeSelect.setAttribute('value', timeValue);
      console.log(timeValue);
      console.log(timeSelect);

      // Remove active class from all list items except the clicked item
      listItemsTime.forEach(function(li) {
          if (li !== time) {
            li.classList.remove('bg-time-active');
            li.classList.add('bg-form-fill');
          }
      });
    });
  });
}

toggleActiveClassTime();

function toggleActiveDoctorMessage() {
  var listItemsDoctorMessage = document.querySelectorAll('#doctorMessageList .doctorMessage');

  listItemsDoctorMessage.forEach(function(doctorMessage) {
    doctorMessage.addEventListener('click', function() {
      // Toggle the active class for the clicked item
      doctorMessage.classList.remove('bg-background-inactive');
      doctorMessage.classList.add('bg-white');

      // Remove active class from all list items except the clicked item
      listItemsDoctorMessage.forEach(function(li) {
          if (li !== doctorMessage) {
            li.classList.remove('bg-white');
            li.classList.add('bg-background-inactive');
          }
      });
    });
  });
}

toggleActiveDoctorMessage();

function toggleActivePatientMessage() {
  var listItemsPatientMessage = document.querySelectorAll('#patientMessageList .patientMessage');

  listItemsPatientMessage.forEach(function(patientMessage) {
    patientMessage.addEventListener('click', function() {
      // Toggle the active class for the clicked item
      patientMessage.classList.remove('bg-background-inactive');
      patientMessage.classList.add('bg-white');

      // Remove active class from all list items except the clicked item
      listItemsPatientMessage.forEach(function(li) {
          if (li !== patientMessage) {
            li.classList.remove('bg-white');
            li.classList.add('bg-background-inactive');
          }
      });
    });
  });
}

toggleActivePatientMessage();
 