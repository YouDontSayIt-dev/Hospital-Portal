function getDoctor() {
    var listItems = document.querySelectorAll('#medicationList div');
    listItems.forEach(function(div) {
      div.addEventListener('click', function() {
        divName = div.getAttribute('name');
        var value = divName;  // JavaScript variable value
        document.cookie = "docName=" + encodeURIComponent(value);  // Set the cookie 
        location.reload();
    });
  
  });
  }
  getDoctor();
  
  function getIllness() {
    var listItems = document.querySelectorAll('#medicationList div div ');
    listItems.forEach(function(div) {
      div.addEventListener('click', function() {
        divName = div.getAttribute('name');
        var value = divName;  // JavaScript variable value
        document.cookie = "illnessName=" + encodeURIComponent(value);
    });
  
  });
  }
  getIllness(); 