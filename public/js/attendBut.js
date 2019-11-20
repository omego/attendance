$(document).ready(function() {
  $.ajax({
    url: '/checkAttendanceTime/',
    type:"GET",
    dataType:"json",
    beforeSend: function(){
      $("#attendBtn").prop('disabled', true);
    },

    success:function(data){
      if (data ==1)
      $("#attendBtn").prop('disabled', false);
      else
      $("#attendBtn").prop('disabled', true);

  },
  complete: function(){

  }
});
});
