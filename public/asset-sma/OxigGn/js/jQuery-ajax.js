
jQuery(document).ready(function()
{
	//  Delete pesan
  $(document).ready(function(){
  $(function(){
    $.ajaxSetup({
      type : "post",
      cache : false,
      datatype : "json"
    });
    $(document).on("click", "#hapus-pesan", function(){
      var id = ($(this).attr('data-id'));
        var url = APP_URL+'/'+'pesan/destroy';
      swal({   
        title: "Apakah Anda yakin?",   
        text: "Tetap menghapus data ini !",   
        type: "warning",
        html: true,   
        showCancelButton: true,   
        // confirmButtonColor: "#DD6B55",   
        confirmButtonColor: "#3edc81",
        confirmButtonText: "Delete",    
        cancelButtonText: "Cancel",   
        closeOnConfirm: false,   
        closeOnCancel: false 
        }, 
        function(isConfirm){   
          if (isConfirm) { 
              $.ajax({
                url :url +'/'+id,
                data : { id:id },
                    beforeSend:function(xhr){
                      var token = $('meta[name="csrf_token"]').attr('content');

                      if(token){
                        return xhr.setRequestHeader('X-CSRF-TOKEN',token);
                      }
                    },
                success : function(data){
                  if(data.success == 'true'){
                  	$("#pesan[data-id='"+id+"']").fadeOut("fast", function(){
	                    $(this).remove();
	                  });
                  }
                }
              });
            //}     
          swal("Terhapus!", "Data berhasil dihapus !", "success");   
        } else {     
          swal("Dibatalkan!", "Data batal dihapus !", "error");   
        } 
      });
    });
  });
});

	$(document).on('change','#tahun', function(e){
	    	console.log(e);

	    	var id = e.target.value;
	    	var url =APP_URL+'/'+'kelas/add';

	    	//ajax
	    	$.get(url+'/tahun?id_tahun='+id, function(data){
	    		$('#kelas').empty();
	    		$.each(data, function(lihat_kelas, setKelas){
	    			$('#kelas').append('<option value="'+setKelas.kode_kelas+'">'+setKelas.kode_kelas+'</option>');
	    		});
	    	});
	    });

//edit master kelas
    $(document).on('click','.edit-kelas', function(e){
    	console.log(e);

    	var id_kelas = $(this).attr('data-id');
    	var url =APP_URL+'/'+'master/kelas/edit';

    	//ajax
    	$.ajax({
    		type:'GET',
    		url:url+'/'+id_kelas,
    		data:{id_kelas:id_kelas},
    		success:function(data){
    			$('#form-edit-kelas').attr('action',url+'/'+data.id_kelas);
    			$('#kode-kelas').empty().attr('value',data.kode_kelas.toUpperCase());
    			$('#kelas').empty().attr('value',data.kelas);
    		}
    	})
    });


// delete kelas ajax success
$(document).ready(function(){
	$(function(){
		$.ajaxSetup({
			type : "post",
			cache : false,
			datatype : "json"
		});
		$(document).on("click", ".hapus_master_kelas", function(){
			var id = ($(this).attr('data-id'));
		    var url = APP_URL+'/'+'master/kelas/destroy';
			swal({   
				title: "Apakah Anda yakin?",   
				text: "Tetap menghapus data ini !",   
				type: "warning",
				html: true,   
				showCancelButton: true,   
				// confirmButtonColor: "#DD6B55",   
				confirmButtonColor: "#3edc81",
				confirmButtonText: "Delete",    
				cancelButtonText: "Cancel",   
				closeOnConfirm: false,   
				closeOnCancel: false 
				}, 
				function(isConfirm){   
					if (isConfirm) { 
							$.ajax({
								url :url +'/'+id,
								data : { id:id },
						        beforeSend:function(xhr){
						          var token = $('meta[name="csrf_token"]').attr('content');

						          if(token){
						            return xhr.setRequestHeader('X-CSRF-TOKEN',token);
						          }
						        },
								success : function(data){
									if(data.success == 'true'){
										$("tr[data-id='"+id+"']").fadeOut("fast", function(){
											$(this).remove();
										});
									}
								}
							});
						//}     
					swal("Terhapus!", "Data berhasil dihapus !", "success");   
				} else {     
					swal("Dibatalkan!", "Data batal dihapus !", "error");   
				} 
			});
		});
	});
});
// delete manage kelas
$(document).ready(function(){
	$(function(){
		$.ajaxSetup({
			type : "post",
			cache : false,
			datatype : "json"
		});
		$(document).on("click", ".hapus_manage_kelas", function(){
			var id = ($(this).attr('data-id'));
		    var url = APP_URL+'/'+'kelas/delete';
			swal({   
				title: "Apakah Anda yakin?",   
				text: "Tetap menghapus data ini !",   
				type: "warning",
				html: true,   
				showCancelButton: true,   
				// confirmButtonColor: "#DD6B55",   
				confirmButtonColor: "#3edc81",
				confirmButtonText: "Delete",    
				cancelButtonText: "Cancel",   
				closeOnConfirm: false,   
				closeOnCancel: false 
				}, 
				function(isConfirm){   
					if (isConfirm) { 
							$.ajax({
								url :url +'/'+id,
								data : { id:id },
						        beforeSend:function(xhr){
						          var token = $('meta[name="csrf_token"]').attr('content');

						          if(token){
						            return xhr.setRequestHeader('X-CSRF-TOKEN',token);
						          }
						        },
								success : function(data){
									if(data.success == 'true'){
										$("tr[data-id='"+id+"']").fadeOut("fast", function(){
											$(this).remove();
										});
									}
								}
							});
						//}     
					swal("Terhapus!", "Data berhasil dihapus !", "success");   
				} else {     
					swal("Dibatalkan!", "Data batal dihapus !", "error");   
				} 
			});
		});
	});
});
// destroy siswa dr kelas
$(document).ready(function(){
	$(function(){
		$.ajaxSetup({
			type : "post",
			cache : false,
			datatype : "json"
		});
		$(document).on("click", ".hapus_siswa_kelas", function(){
			var id = ($(this).attr('data'));
			var kelas = ($(this).attr('data-id'));
		    var url = APP_URL+'/'+'kelas/destroy';
			swal({   
				title: "Apakah Anda yakin?",   
				text: "Tetap menghapus siswa ini !",   
				type: "warning",
				html: true,   
				showCancelButton: true,   
				// confirmButtonColor: "#DD6B55",   
				confirmButtonColor: "#3edc81",
				confirmButtonText: "Delete",    
				cancelButtonText: "Cancel",   
				closeOnConfirm: false,   
				closeOnCancel: false 
				}, 
				function(isConfirm){   
					if (isConfirm) { 
							$.ajax({
								url :url +'/'+kelas+'/'+id,
								data : { id:id },
						        beforeSend:function(xhr){
						          var token = $('meta[name="csrf_token"]').attr('content');

						          if(token){
						            return xhr.setRequestHeader('X-CSRF-TOKEN',token);
						          }
						        },
								success : function(data){
									if(data.success == 'true'){
										$("tr[data='"+id+"']").fadeOut("fast", function(){
											$(this).remove();
										});
									}
								}
							});
						//}     
					swal("Berhasil!", "Siswa telah dihapus dari kelas ini !", "success");   
				} else {     
					swal("Dibatalkan!", "Dibatalkan !", "error");   
				} 
			});
		});
	});
});

// delete download ajax success
$(document).ready(function(){
	$(function(){
		$.ajaxSetup({
			type : "post",
			cache : false,
			datatype : "json"
		});
		$(document).on("click", ".hapus_materi", function(){
			var id = ($(this).attr('data-id'));
		    var url = APP_URL+'/'+'materi/delete';
			swal({   
				title: "Apakah Anda yakin?",   
				text: "Tetap menghapus data ini !",   
				type: "warning",
				html: true,   
				showCancelButton: true,   
				// confirmButtonColor: "#DD6B55",   
				confirmButtonColor: "#3edc81",
				confirmButtonText: "Delete",    
				cancelButtonText: "Cancel",   
				closeOnConfirm: false,   
				closeOnCancel: false 
				}, 
				function(isConfirm){   
					if (isConfirm) { 
							$.ajax({
								url :url +'/'+id,
								data : { id:id },
						        beforeSend:function(xhr){
						          var token = $('meta[name="csrf_token"]').attr('content');

						          if(token){
						            return xhr.setRequestHeader('X-CSRF-TOKEN',token);
						          }
						        },
								success : function(data){
									if(data.success == ''){
										$("tr[data-id='"+id+"']").fadeOut("fast", function(){
											$(this).remove();
										});
									}
								}
							});
						//}     
					swal("Terhapus!", "Data berhasil dihapus !", "success");   
				} else {     
					swal("Dibatalkan!", "Data batal dihapus !", "error");   
				} 
			});
		});
	});
});
// delete jadwal ajax success
$(document).ready(function(){
	$(function(){
		$.ajaxSetup({
			type : "post",
			cache : false,
			datatype : "json"
		});
		$(document).on("click", ".hapus_jadwal", function(){
			var id = ($(this).attr('data-id'));
		    var url = APP_URL+'/'+'jadwal/delete';
			swal({   
				title: "Apakah Anda yakin?",   
				text: "Tetap menghapus data ini !",   
				type: "warning",
				html: true,   
				showCancelButton: true,   
				// confirmButtonColor: "#DD6B55",   
				confirmButtonColor: "#3edc81",
				confirmButtonText: "Delete",    
				cancelButtonText: "Cancel",   
				closeOnConfirm: false,   
				closeOnCancel: false 
				}, 
				function(isConfirm){   
					if (isConfirm) { 
							$.ajax({
								url :url +'/'+id,
								data : { id:id },
						        beforeSend:function(xhr){
						          var token = $('meta[name="csrf_token"]').attr('content');

						          if(token){
						            return xhr.setRequestHeader('X-CSRF-TOKEN',token);
						          }
						        },
								success : function(data){
									if(data.success == 'true'){
										$("tr[data-id='"+id+"']").fadeOut("fast", function(){
											$(this).remove();
										});
									}
								}
							});
						//}     
					swal("Terhapus!", "Data berhasil dihapus !", "success");   
				} else {     
					swal("Dibatalkan!", "Data batal dihapus !", "error");   
				} 
			});
		});
	});
});
// delete guruApp ajax success
$(document).ready(function(){
	$(function(){
		$.ajaxSetup({
			type : "post",
			cache : false,
			datatype : "json"
		});
		$(document).on("click", ".hapus_guru", function(){
			var id = ($(this).attr('data-id'));
		    var url = APP_URL+'/'+'guru/delete';
			swal({   
				title: "Apakah Anda yakin?",   
				text: "Tetap menghapus data ini !",   
				type: "warning",
				html: true,   
				showCancelButton: true,   
				// confirmButtonColor: "#DD6B55",   
				confirmButtonColor: "#3edc81",
				confirmButtonText: "Delete",    
				cancelButtonText: "Cancel",   
				closeOnConfirm: false,   
				closeOnCancel: false 
				}, 
				function(isConfirm){   
					if (isConfirm) { 
							$.ajax({
								url :url +'/'+id,
								data : { id:id },
						        beforeSend:function(xhr){
						          var token = $('meta[name="csrf_token"]').attr('content');

						          if(token){
						            return xhr.setRequestHeader('X-CSRF-TOKEN',token);
						          }
						        },
								success : function(data){
									if(data.success == 'true'){
										$("tr[data-id='"+id+"']").fadeOut("fast", function(){
											$(this).remove();
										});
									}
								}
							});
						//}     
					swal("Terhapus!", "Data berhasil dihapus !", "success");   
				} else {     
					swal("Dibatalkan!", "Data batal dihapus !", "error");   
				} 
			});
		});
	});
});
// delete SiswaApp ajax success
$(document).ready(function(){
	$(function(){
		$.ajaxSetup({
			type : "post",
			cache : false,
			datatype : "json"
		});
		$(document).on("click", ".hapus_siswa", function(){
			var id = ($(this).attr('data-id'));
		    var url = APP_URL+'/'+'siswa/delete';
			swal({   
				title: "Apakah Anda yakin?",   
				text: "Tetap menghapus data ini !",   
				type: "warning",
				html: true,   
				showCancelButton: true,   
				// confirmButtonColor: "#DD6B55",   
				confirmButtonColor: "#3edc81",
				confirmButtonText: "Delete",    
				cancelButtonText: "Cancel",   
				closeOnConfirm: false,   
				closeOnCancel: false 
				}, 
				function(isConfirm){   
					if (isConfirm) { 
							$.ajax({
								url :url +'/'+id,
								data : { id:id },
						        beforeSend:function(xhr){
						          var token = $('meta[name="csrf_token"]').attr('content');

						          if(token){
						            return xhr.setRequestHeader('X-CSRF-TOKEN',token);
						          }
						        },
								success : function(data){
									if(data.success == 'true'){
										$("tr[data-id='"+id+"']").fadeOut("fast", function(){
											$(this).remove();
										});
									} 
								}
							});
						//}     
					swal("Terhapus!", "Data berhasil dihapus !", "success");   
				} else {     
					swal("Dibatalkan!", "Data batal dihapus !", "error");   
				} 
			});
		});
	});
});
// delete menuApp ajax success
$(document).ready(function(){
	$(function(){
		$.ajaxSetup({
			type : "post",
			cache : false,
			datatype : "json"
		});
		$(document).on("click", ".hapus_menu", function(){
			var id = ($(this).attr('data-id'));
		    var url = APP_URL+'/'+'menu/delete';
			swal({   
				title: "Apakah Anda yakin?",   
				text: "Jika menghapus data ini Anda harus membuat pengganti menu !",   
				type: "warning",
				html: true,   
				showCancelButton: true,   
				// confirmButtonColor: "#DD6B55",   
				confirmButtonColor: "#3edc81",
				confirmButtonText: "Delete",    
				cancelButtonText: "Cancel",   
				closeOnConfirm: false,   
				closeOnCancel: false 
				}, 
				function(isConfirm){   
					if (isConfirm) { 
							$.ajax({
								url :url +'/'+id,
								data : { id:id },
						        beforeSend:function(xhr){
						          var token = $('meta[name="csrf_token"]').attr('content');

						          if(token){
						            return xhr.setRequestHeader('X-CSRF-TOKEN',token);
						          }
						        },
								success : function(data){
									if(data.success == 'true'){
										$("tr[data-id='"+id+"'],li[data-id='"+id+"']").fadeOut("fast", function(){
											$(this).remove();
										});
									}
									if(data.success == 'false'){
										swal({   
											title: "Opps !!!",   
											text: "Menu yang Anda hapus memiliki Submenu !",   
											type: "error",
											showConfirmButton:true
										});
									}
								}
							});
						//}     
					swal("Terhapus!", "Data berhasil dihapus !", "success");   
				} else {     
					swal("Dibatalkan!", "Data batal dihapus !", "error");   
				} 
			});
		});
	});
});
// delete TahunApp ajax success
$(document).ready(function(){
	
});
});