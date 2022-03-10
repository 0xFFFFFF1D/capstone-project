(function($){
  $(function(){

    $('.sidenav').sidenav();

  }); // end of document ready
})(jQuery); // end of jQuery name space

$(document).ready(function () {
  $('.modal').modal();
});


$(document).ready(function () {
  $('select').formSelect();
});

function changeForm(event_form, schedule_form) {
  if (document.getElementById("type").value === "2") {
    schedule_form.style.display = 'none';
    event_form.style.display = 'block';
  }
  else if (document.getElementById("type").value === "1") {
    event_form.style.display = 'none';
    schedule_form.style.display = 'block';
  }
}
