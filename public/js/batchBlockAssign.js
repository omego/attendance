$(document).ready(function() {

  $(function() {

    $("#newModalForm").validate({
      rules: {
        block_id: {
          required: true,
        },
      },
    });
  });

  $('#selectAll').click(function() {
    if ($(this).prop('checked')) {
      $('.stuList').prop('checked', true);
    } else {
      $('.stuList').prop('checked', false);
    }
  });

  $('#loader').css("visibility", "hidden");

  $('select[name="batchList"]').on('change', function(){
    $('#selectAll').prop('checked', false);
    var batchNo = $(this).val();
    var blockID = $('#block_id').val();
    if(batchNo) {
      $.ajax({
        url: '/dynamic/batch/'+batchNo+'/block/'+blockID,
        type:"GET",
        dataType:"json",
        beforeSend: function(){
          $('#loader').css("visibility", "visible");
        },

        success:function(data) {

          $('#assignStuToBlock').empty();

          var result = '<div class="table-responsive"><table class="table table-hover"><thead><tr><th></th><th class="th-lg">Name</th><th class="th-lg">Email</th><th class="th-lg">Badge</th><th class="th-lg">Student No</th><th class="th-lg">Batch</th></tr></thead><tbody>';

          for(var i=0; i<data.length; i++) {
            if (data[i].assigned==1){
              result += '<tr><td><input type="checkbox" name="assignStuToBlock[]" value="'+data[i].id+'" class="stuList" checked></td><td>'+data[i].name+'</td><td>'+data[i].email+'</td><td>'+data[i].badge_number+'</td><td>'+data[i].student_number+'</td><td>'+data[i].batch+'</td></tr>';

            }else{
              result += '<tr><td><input type="checkbox" name="assignStuToBlock[]" value="'+data[i].id+'" class="stuList"></td><td>'+data[i].name+'</td><td>'+data[i].email+'</td><td>'+data[i].badge_number+'</td><td>'+data[i].student_number+'</td><td>'+data[i].batch+'</td></tr>';
            }
          }

          result += '</tbody></table>';

          $('#assignStuToBlock').append(result);

        },
        complete: function(){
          $('#loader').css("visibility", "hidden");
        }
      });
    } else {
      $('#assignStuToBlock').empty();
    }

  });
});
