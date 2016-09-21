$(document).ready(function()
{
    // Get data nilai
  var listNilai = function()
    {
        $.ajax({
            type:'get',
            url:APP_URL+'/'+'lihat_nilai',
            success: function(data){
                $('#list-nilai').empty().html(data);
            }
        });
    }

    listNilai();

    $(document).on('change','#semester', function(e){
        console.log(e);

        var semester = e.target.value;
        var url =APP_URL+'/';

        //ajax
        $.get(url+'semester?semester='+semester, function(data){
          $('#list-nilai').empty().html(data);
          });
      });

    $(document).on('click', '#btn-refresh', function(){
        listNilai();
    });
});