$(document).ready(function(e)
{
	//  validasi album
	$(document).on('click','#btn-album',function(){
        var album = $('#album').val();
        if(album==''){
          swal({
            title:'Warning !',
            text:'Nama album tidak boleh kosong',
            type:'error',
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
      });
	//  validasi foto
	$(document).on('click','#btn-foto',function(){
        var keterangan = $('#keterangan-foto').val();
        var foto = $('#foto').val();
        if(keterangan==''){
          swal({
            title:'Warning !',
            text:'Keterangan tidak boleh kosong',
            type:'error',
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }if(foto==''){
          swal({
            title:'Warning !',
            text:'Foto tidak boleh kosong',
            type:'error',
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
      });
	// Validasi agenda
	$(document).on('click','#btn-agenda',function(){

      var judul_agenda = $('#judul_agenda').val();
      var tanggal1 = $('#tanggal1').val();
      var tahun1 = $('#tahun1').val();
      var tempat = $('#tempat').val();
      var jam = $('#jam').val();
      var keterangan = $('textarea#keterangan').val();

      if(judul_agenda =='')
      {
        swal({
          title:"Warning !",
          text:"Tema agenda tidak boleh kosong",
          type:"error",
          timer:1000,
          showConfirmButton:false
        });
          return false;
      }
      if(tanggal1 =='')
      {
        swal({
          title:"Warning !",
          text:"Tanggal mulai tidak boleh kosong",
          type:"error",
          timer:1000,
          showConfirmButton:false
        });
          return false;
      }
      if(tahun1 =='')
      {
        swal({
          title:"Warning !",
          text:"Tanggal selesai tidak boleh kosong",
          type:"error",
          timer:1000,
          showConfirmButton:false
        });
          return false;
      }
      if(tempat =='')
      {
        swal({
          title:"Warning !",
          text:"Tempat tidak boleh kosong",
          type:"error",
          timer:1000,
          showConfirmButton:false
        });
          return false;
      }
      if(jam=='')
      {
        swal({
          title:"Warning !",
          text:"Jam tidak boleh kosong",
          type:"error",
          timer:1000,
          showConfirmButton:false
        });
          return false;
      }
      if(keterangan=='')
      {
        swal({
          title:"Warning !",
          text:"Keterangan tidak boleh kosong",
          type:"error",
          timer:1000,
          showConfirmButton:false
        });
          return false;
      }

    });
	//  Validasi berita
	$(document).on('click','#add-berita',function(){
        var judul = $('#judul_berita').val();
        if(judul==''){
          swal({
            title:'Warning !',
            text:'Judul berita tidak boleh kosong',
            type:'error',
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
      });
	// validasi pengumuman
	$(document).on('click','#add-pengumuman',function(){
        var judul = $('#judul_pengumuman').val();
        if(judul==''){
          swal({
            title:'Warning !',
            text:'Tema pengumuman tidak boleh kosong',
            type:'error',
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
      });
	// Validassi identitas sekolah
	$(document).on('click','#btn-identitas',function(){

      var title = $('#title').val();
      var nama_sekolah = $('#nama_sekolah').val();
      var status_sekolah = $('#status_sekolah').val();
      var alamat = $('#alamat').val();
      var kab_kota = $('#kab_kota').val();
      var telpon = $('#telpon').val();
      var web = $('#web').val();
      var logo = $('#logo').val();

      if(title =='' && nama_sekolah =='' && status_sekolah =='' && alamat =='' && kab_kota=='' && telepon=='' && web=='' && logo=='')
      {
        swal({
          title:"Warning !",
          text:"Data tidak boleh kosong",
          type:"error",
          timer:1000,
          showConfirmButton:false
        });
          return false;
      }
      if(title =='')
      {
        swal({
          title:"Warning !",
          text:"Title tidak boleh kosong",
          type:"error",
          timer:1000,
          showConfirmButton:false
        });
          return false;
      }
      if(nama_sekolah =='')
      {
        swal({
          title:"Warning !",
          text:"Nama sekolah tidak boleh kosong",
          type:"error",
          timer:1000,
          showConfirmButton:false
        });
          return false;
      }
      if(alamat =='')
      {
        swal({
          title:"Warning !",
          text:"Alamat sekolah tidak boleh kosong",
          type:"error",
          timer:1000,
          showConfirmButton:false
        });
          return false;
      }
      if(kab_kota=='')
      {
        swal({
          title:"Warning !",
          text:"Kab-kota tidak boleh kosong",
          type:"error",
          timer:1000,
          showConfirmButton:false
        });
          return false;
      }

    });
	// Validasi add siswa
	$(document).on('click', '#btn-add-siswa', function(){
		var nis = $('#nis').val();
		var nama = $('#nama_siswa').val();
		var tempat = $('#tempat_lahir').val();
		var tgl = $('#tanggal1').val();
		var alamat = $('#alamat').val();
		var agama = $('#agama').val();
		var th = $('#tahun_masuk').val();
		var as = $('#asal_sekolah').val();
		var wali = $('#nama_wali').val();
		var awal = $('#alamat_wali').val();
		if(nis=='' && nama=='' && tempat=='' && tgl=='' && alamat=='' && agama=='' && th=='' && as=='' && wali=='' && awal==''){
			swal({
				title:"Warning !",
				text:"Data tidak boleh kosong",
				type:"error",
				timer:1000,
				showConfirmButton:false
			});
				return false;
		}
		if(nis==''){
			swal({
				title:"Warning !",
				text:"NIS tidak boleh kosong",
				type:"error",
				timer:1000,
				showConfirmButton:false
			});
				return false;
		}
		if(nama==''){
			swal({
				title:"Warning !",
				text:"Nama tidak boleh kosong",
				type:"error",
				timer:1000,
				showConfirmButton:false
			});
				return false;
		}
		if(tempat==''){
			swal({
				title:"Warning !",
				text:"Tempat lahir tidak boleh kosong",
				type:"error",
				timer:1000,
				showConfirmButton:false
			});
				return false;
		}
		if(tgl==''){
			swal({
				title:"Warning !",
				text:"Tanggal lahir tidak boleh kosong",
				type:"error",
				timer:1000,
				showConfirmButton:false
			});
				return false;
		}
		if(alamat==''){
			swal({
				title:"Warning !",
				text:"Alamat tidak boleh kosong",
				type:"error",
				timer:1000,
				showConfirmButton:false
			});
				return false;
		}
		if(agama==''){
			swal({
				title:"Warning !",
				text:"Silakan pilih Agama",
				type:"error",
				timer:1000,
				showConfirmButton:false
			});
				return false;
		}
		if(th==''){
			swal({
				title:"Warning !",
				text:"Silakan pilih Tahun angkatan",
				type:"error",
				timer:1000,
				showConfirmButton:false
			});
				return false;
		}
		if(as==''){
			swal({
				title:"Warning !",
				text:"Asal sekolah tidak boleh kosong",
				type:"error",
				timer:1000,
				showConfirmButton:false
			});
				return false;
		}
		if(wali==''){
			swal({
				title:"Warning !",
				text:"Wali murid tidak boleh kosong",
				type:"error",
				timer:1000,
				showConfirmButton:false
			});
				return false;
		}
		if(awal==''){
			swal({
				title:"Warning !",
				text:"Alamat Wali murid tidak boleh kosong",
				type:"error",
				timer:1000,
				showConfirmButton:false
			});
				return false;
		}
	});
	// Validasi edit siswa
	$(document).on('click', '#btn-edit-siswa', function(){
		var nis = $('#niss').val();
		var nama = $('#nama_siswas').val();
		var tempat = $('#tempat_lahirs').val();
		var tgl = $('#tanggal-lahir').val();
		var alamat = $('#alamats').val();
		var as = $('#asal_sekolahs').val();
		var wali = $('#nama_walis').val();
		var awal = $('#alamat_walis').val();
		if(nis=='' && nama=='' && tempat=='' && tgl=='' && alamat=='' && agama=='' && th=='' && as=='' && wali=='' && awal==''){
			swal({
				title:"Warning !",
				text:"Data tidak boleh kosong",
				type:"error",
				timer:1000,
				showConfirmButton:false
			});
				return false;
		}
		if(nis==''){
			swal({
				title:"Warning !",
				text:"NIS tidak boleh kosong",
				type:"error",
				timer:1000,
				showConfirmButton:false
			});
				return false;
		}
		if(nama==''){
			swal({
				title:"Warning !",
				text:"Nama tidak boleh kosong",
				type:"error",
				timer:1000,
				showConfirmButton:false
			});
				return false;
		}
		if(tempat==''){
			swal({
				title:"Warning !",
				text:"Tempat lahir tidak boleh kosong",
				type:"error",
				timer:1000,
				showConfirmButton:false
			});
				return false;
		}
		if(tgl==''){
			swal({
				title:"Warning !",
				text:"Tanggal lahir tidak boleh kosong",
				type:"error",
				timer:1000,
				showConfirmButton:false
			});
				return false;
		}
		if(alamat==''){
			swal({
				title:"Warning !",
				text:"Alamat tidak boleh kosong",
				type:"error",
				timer:1000,
				showConfirmButton:false
			});
				return false;
		}
		if(as==''){
			swal({
				title:"Warning !",
				text:"Asal sekolah tidak boleh kosong",
				type:"error",
				timer:1000,
				showConfirmButton:false
			});
				return false;
		}
		if(wali==''){
			swal({
				title:"Warning !",
				text:"Wali murid tidak boleh kosong",
				type:"error",
				timer:1000,
				showConfirmButton:false
			});
				return false;
		}
		if(awal==''){
			swal({
				title:"Warning !",
				text:"Alamat Wali murid tidak boleh kosong",
				type:"error",
				timer:1000,
				showConfirmButton:false
			});
				return false;
		}
	});
	// Validasi import excel siswa
	$(document).on('click', '#btn-excel', function(){
		var file = $('#excel').val();
		if(file==''){
			swal({
				title:"Warning !",
				text:"File tidak boleh kosong",
				type:"error",
				timer:1000,
				showConfirmButton:false
			});
				return false;
		}
	});
	// Validasi tambah menu
	$(document).on('click', '#btn-menu', function(){
		var nama = $('#nama_menu').val();
		var link = $('#link_menu').val();
		var aktiv = $('#aktiv_menu').val();
		var parent = $('#parent_menu').val();
		var hak = $('#hak_akses').val();
		if(nama=='' && link=='' && aktiv=='' && parent=='' && hak==''){
			swal({
				title: "Warning !",
				text: "Data tidak boleh kosong",
				type: "error",
				timer: 1000,
				showConfirmButton: false
			});
				return false;
		}
		if(nama==''){
			swal({
				title: "Warning !",
				text: "Nama menu tidak boleh kosong",
				type: "error",
				timer: 1000,
				showConfirmButton: false
			});
				return false;
		}
		if(link==''){
			swal({
				title: "Warning !",
				text: "Link tidak boleh kosong",
				type: "error",
				timer: 1000,
				showConfirmButton: false
			});
				return false;
		}
		if(aktiv==''){
			swal({
				title: "Warning !",
				text: "Silakan pilih Aktivasi menu",
				type: "error",
				timer: 1000,
				showConfirmButton: false
			});
				return false;
		}
		if(parent==''){
			swal({
				title: "Warning !",
				text: "Silakan pilih Parent menu",
				type: "error",
				timer: 1000,
				showConfirmButton: false
			});
				return false;
		}
		if(hak==''){
			swal({
				title: "Warning !",
				text: "Silakan pilih Hak akses menu",
				type: "error",
				timer: 1000,
				showConfirmButton: false
			});
				return false;
		}
	});

	// Validasi edit menu
	$(document).on('click', '#btn-menu-edit', function(){
		var nama = $('#nama').val();
		if(nama==''){
			swal({
				title: "Warning !",
				text: "Nama menu tidak boleh kosong",
				type: "error",
				timer: 1000,
				showConfirmButton: false
			});
			return false;
		}
	});
	// Validasi tambah menu-font
	$(document).on('click', '#menu-front', function(){
		var id_menu = $('#id_menu').val();
		var nama_menu = $('#nama_menu').val();
		var aktiv = $('#aktiv_menu').val();
		var parent = $('#parent_menu').val();
		if(id_menu=='' && nama_menu=='' && aktiv=='' && parent==''){
			swal({
				title: "Warning !",
				text: "Data tidak boleh kosong",
				type: "error",
				timer: 1000,
				showConfirmButton: false
			});
				return false;
		}
		if(id_menu==''){
			swal({
				title: "Warning !",
				text: "ID menu tidak boleh kosong",
				type: "error",
				timer: 1000,
				showConfirmButton: false
			});
				return false;
		}
		if(nama_menu==''){
			swal({
				title: "Warning !",
				text: "Nama menu tidak boleh kosong",
				type: "error",
				timer: 1000,
				showConfirmButton: false
			});
				return false;
		}
		if(aktiv==''){
			swal({
				title: "Warning !",
				text: "Silakan pilih Aktivasi menu",
				type: "error",
				timer: 1000,
				showConfirmButton: false
			});
				return false;
		}
		if(parent==''){
			swal({
				title: "Warning !",
				text: "Silakan pilih Parent menu",
				type: "error",
				timer: 1000,
				showConfirmButton: false
			});
				return false;
		}
	});

	// Validasi edit menu-fornt
	$(document).on('click', '#front', function(){
		var nama = $('#nama_menuu').val();
		if(nama==''){
			swal({
				title: "Warning !",
				text: "Nama menu tidak boleh kosong",
				type: "error",
				timer: 1000,
				showConfirmButton: false
			});
			return false;
		}
	});

// Validasi Add managemen kelas
	$(document).on('click', '#btn-add-kelas', function(){
		var kelas = $('#kelas').val();
		var wali = $('#wali_kelas').val();
		var tahun = $('#tahun').val();
		if(kelas =='' && wali =='' && tahun ==''){
			swal({
                title: "Warning !",
                text: "Silakan pilih Data",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(kelas ==''){
			swal({
                title: "Warning !",
                text: "Silakan pilih Kelas",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(wali ==''){
			swal({
                title: "Warning !",
                text: "Silakan pilih Wali kelas",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(tahun ==''){
			swal({
                title: "Warning !",
                text: "Silakan pilih Tahun ajaran",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
	});


	
// Validasi input tugas 1
	$(document).on('click', '#btn-tugas-1', function(){
		var guru = $('#guru').val();
		if(guru ==''){
			swal({
                title: "Warning !",
                text: "Silakan pilih Guru Mata pelajaran",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
	});

// Validasi Master kelas add
	$(document).on('click', '#btn-master', function(){
		var kelas = $('#kelas-master').val();
		if(kelas ==''){
			swal({
                title: "Warning !",
                text: "Data tidak boleh kosong",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
	});

// Validasi Master kelas edit
	$(document).on('click', '#btn-master-edit', function(){
		var kelas = $('#kelas').val();
		if(kelas ==''){
			swal({
                title: "Warning !",
                text: "Data tidak boleh kosong",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
	});

// Validasi mata pelajaran add
	$(document).on('click', '#btn-matpel', function(){
		var matpel = $('#pel').val();
		var keterangan = $('#ket').val();
		if(matpel =='' && keterangan ==''){
			swal({
                title: "Warning !",
                text: "Data tidak boleh kosong",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(matpel !=='' && keterangan ==''){
			swal({
                title: "Warning !",
                text: "Silakan pilih keterangan Mata pelajaran",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(matpel =='' && keterangan !==''){
			swal({
                title: "Warning !",
                text: "Mata pelajaran tidak boleh kosong",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
	});

// Validasi mata pelajaran edit
	// $(document).on('click', '#btn-matpel-edit', function(){
	// 	var matpel = $('#pelajaran').val();
	// 	var keterangan = $('#keterangan').val();
	// 	if(matpel ==''){
	// 		swal({
 //                title: "Warning !",
 //                text: "Data tidak boleh kosong",
 //                type: "error",
 //                timer: 1000,
 //                showConfirmButton: false
 //            });
	// 			return false;
	// 	}
	// });

// Validasi Upload Jadwal
	$(document).on('click', '#btn-upload-jadwal', function(){
		var kelas = $('#kelas').val();
		var file = $('#upload').val();
		if(kelas =='' && file ==''){
			swal({
                title: "Warning !",
                text: "Data tidak boleh kosong",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(kelas !=='' && file ==''){
			swal({
                title: "Warning !",
                text: "File tidak boleh kosong",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(kelas =='' && file !==''){
			swal({
                title: "Warning !",
                text: "Nama kelas tidak boleh kosong",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
	});

// Validasi Upload Materi
	$(document).on('click', '#btn-upload-materi', function(){
		var kelas = $('#kelas_id').val();
		var matpel = $('#mat_pel').val();
		var keterangan = $('#keterangan').val();
		var file = $('#upload').val();
		if(kelas =='' && matpel =='' && keterangan =='' && file ==''){
			swal({
                title: "Warning !",
                text: "Data tidak boleh kosong",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(kelas ==''){
			swal({
                title: "Warning !",
                text: "Silakan pilih Kelas",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(matpel ==''){
			swal({
                title: "Warning !",
                text: "Silakan pilih Mata pelajaran",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(keterangan ==''){
			swal({
                title: "Warning !",
                text: "Silakan pilih keterangan",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(file ==''){
			swal({
                title: "Warning !",
                text: "File tidak boleh kosong",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
	});

// Validasi Lihat Nilai
	$(document).on('click', '#btn-lihat-nilai', function(){
		var pelajaran = $('#pelajaran').val();
		var semester = $('#semester').val();
		if(pelajaran =='' && semester ==''){
			swal({
                title: "Warning !",
                text: "Silakan pilih Mata pelajaran & Semester",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(pelajaran ==''){
			swal({
                title: "Warning !",
                text: "Silakan pilih Mata pelajaran",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(semester ==''){
			swal({
                title: "Warning !",
                text: "Silakan pilih Semester",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
	});

// Input nilai perkelas & per pelajaran	
	$(document).on('click','#input-nilai', function(){
		var kelas = $(this).attr('data-id');
		var getKelas = APP_URL+'/'+'kelola';
		$('#insert-nilai').prop('href',getKelas);

			$('#matpel').on('change',function(){
				var matpel = $('#matpel').val();
				var getNilai = getKelas+'/'+kelas+'/'+matpel;
				$('#insert-nilai').prop('href',getNilai);

					$('#nilai').on('change',function(){
						var setNilai = $('#nilai').val();
						var setURL = getNilai+'/'+setNilai;
						$('#insert-nilai').prop('href',setURL);

					});
			});
	});

// Validasi managemen kelas
	$('#insert-nilai').click(function(){
		var matpel = $('#matpel').val();
		var setNilai = $('#nilai').val();
		if(matpel=='' && setNilai==''){
			swal({
                title: "Warning !",
                text: "Silakan masukan Data",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(matpel!=='' && setNilai==''){
			swal({
                title: "Warning !",
                text: "Silakan pilih Nilai",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(matpel=='' && setNilai!==''){
			swal({
                title: "Warning !",
                text: "Silakan pilih Mata pelajaran",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
	});

// Validasi tahun ajaran add
	$('#btn-tahun-add').click(function(e){
		var tahun = $('#tahun_ajaran').val();
		if(tahun==''){
			swal({
                title: "Warning !",
                text: "Data tidak boleh kosong",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
	});

// Validasi tahun ajaran edit
	$(document).on('click','#tahun-update',function(){
		var tahun = $('#tahun_ajaran_master').val();
		if(tahun==''){
			swal({
                title: "Warning !",
                text: "Data tidak boleh kosong",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
	});

// Validasi update user
	$(document).on('click','#user-admin',function(){
		var user = $('#data_id_1').val();
		var ps = $('#data_id_2').val();
		if(user=='' && ps==''){
			swal({
                title: "Warning !",
                text: "Data tidak boleh kosong",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(user==''){
			swal({
                title: "Warning !",
                text: "Username boleh kosong",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(ps==''){
			swal({
                title: "Warning !",
                text: "Password tidak boleh kosong",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
	});

// Validasi update profile
	$(document).on('click','#btn-profile-user',function(){
		var pLama = $('#id_1').val();
		var pBaru = $('#id_2').val();
		var pConfirm = $('#id_3').val();
		if(pLama=='' && pBaru=='' && pConfirm==''){
			swal({
                title: "Warning !",
                text: "Data tidak boleh kosong",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(pLama==''){
			swal({
                title: "Warning !",
                text: "Password lama tidak boleh kosong",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(pBaru==''){
			swal({
                title: "Warning !",
                text: "Password Baru tidak boleh kosong",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(pConfirm==''){
			swal({
                title: "Warning !",
                text: "Konfirmasi Password tidak boleh kosong",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(pBaru != pConfirm){
			swal({
                title: "Warning !",
                text: "Password Baru dan Konfirmasi Password harus sama",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
	});

// Validasi update profile siswa
	$(document).on('click','#btn-profile-siswa',function(){
		var pLama = $('#id_1').val();
		var pBaru = $('#id_2').val();
		var pConfirm = $('#id_3').val();
		if(pLama=='' && pBaru=='' && pConfirm==''){
			swal({
                title: "Warning !",
                text: "Data tidak boleh kosong",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(pLama==''){
			swal({
                title: "Warning !",
                text: "Password lama tidak boleh kosong",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(pBaru==''){
			swal({
                title: "Warning !",
                text: "Password Baru tidak boleh kosong",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(pConfirm==''){
			swal({
                title: "Warning !",
                text: "Konfirmasi Password tidak boleh kosong",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
		if(pBaru != pConfirm){
			swal({
                title: "Warning !",
                text: "Password Baru dan Konfirmasi Password harus sama",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
				return false;
		}
	});

// Konfirmasi edit data
	$('#example1').on('click', '#edit', function(event){
		var getLink = $(this).attr('href');
		swal({
			title:'Konfirmasi',
			text:'Edit Data ?',
			type:'warning',
			html:true,
			confirmButtonColor:'#22A7F0',
			showCancelButton:true,  
			closeOnConfirm: false,   
			closeOnCancel: false 
		}, function(isConfirm){  
				if (isConfirm){
					window.location.href = getLink  
				}else{     
					swal("Dibatalkan!", "", "error");   
				} 
		});
		return false;
	});

// Hapus message
	$('.btn-defaulty').click(function(){
		$('#insert-nilai').prop('href','');
			$('.reds').fadeOut();
				$('.data-add').val('');
	});
	$('.btn-pink').click(function(){
		$('.data-add').val('');
			$('.reds').fadeOut();
	});

// Lihat nilai
	$(document).on('click', '#search-nilai', function(){
		var id = $(this).attr('data-id');
			$('#kelas').val(id);
	});

// Update user 
	$(document).on('click', '.user-update', function(){
		var id = $(this).attr('data-id');
			$('#user').val(id);
	});

// Preloader
	$(window).load(function(){
		$('.preload-wrapper').delay().fadeOut('slow');
				$('#matpel').val('');
					$('#nilai').val('');
						$('#insert-nilai').prop('href','');
	});

// add guru & siswa
	$(document).on('click', '#btn_tambah', function(){
		$(this).hide(500);
			$('#import').hide(500);
				$('#drop').hide(500);
					$('#form_tambah').slideToggle();
						$('#table-list').fadeOut('fast');
	});

// Cancel add guru & siswa
	$('#btn_cancel ').click(function(){
		$('#btn_tambah').show();
			$('#import').show();
				$('#drop').show();
					$('#form_tambah').hide();
						$('#table-list').fadeIn(500);
	});

// Import excel
	$('#import').click(function(){
		$(this).hide(500);
			$('#btn_tambah').hide(500);
				$('#form_excel').slideToggle();
					$('#table-list').fadeOut('fast');
	});

// Cancel import excel
	$('#btn-cancel ').click(function(){
		$('#import').show();
			$('#btn_tambah').show();
				$('#form_excel').hide();
					$('#table-list').fadeIn('fast');
	});

// Icon download siswa
	$('.icon-download').mouseenter(function(){
		$(this,('.icon-download')).addClass('fa-pulse');
	});

	$('.icon-download').mouseleave(function(){
		$('.icon-download').removeClass('fa-pulse');
	});

// Btn setALumni	
	$('.cek_alumni').click(function(){
		$('#btn-alumni').css('display', $(this).is(':checked') ? 'block' : 'none');
	});

    $(".select2").select2();

// Summernote
    $('#data_statis').summernote({
      placeholder: 'write here...',
      height:250,
    });

// handle side-menu
	e.preventDefault;
	$('[data-toggle="sidemenu"]').click(function(){
		$('#side-menu').toggleClass('xs-show-menu');
	});

// Datatables
	$("#example1").DataTable();
		$('#example2').DataTable({
		  "paging": true,
		  "lengthChange": false,
		  "searching": false,
		  "ordering": true,
		  "info": true,
		  "autoWidth": false
	});

//Datepicker
	$("#tanggal1").datepicker({
		format:'yyyy-mm-dd'
	});

	$("#tahun1").datepicker({
		format:'yyyy-mm-dd'
	});

//Money Euro
	$("[data-mask]").inputmask();
//check username
// $(document).ready(function(){
// 	$('#check_1').click(function(){
// 		$('#data_id_1').removeAttr('disabled');
// 		$('#data_id_2').removeAttr('disabled');
// 		$('#data_id_2').attr('required','true');
// 	});
// });

//checked password
	$('#check_2').click(function(){
		$('#data_id_1').removeAttr('disabled');
			$('#data_id_2').removeAttr('disabled');
				$('#data_id_2').attr('required','true');

		$('#check_2').click(function(){
			$('#data_id_1,#data_id_2').attr('disabled',$(this).is(':checked') ? 
				$('#data_id_1,#data_id_2').attr('disabled'):$('#data_id_1,#data_id_2').removeAttr('disabled'));
		});
	});

// show pass
	$('#show_pass').click(function(){
		$('#password,#data_id_2').attr('type', $(this).is(':checked') ? 'text' : 'password');
	});

	$('#show_pass_1').click(function(){
		$('#password,#id_1').attr('type', $(this).is(':checked') ? 'text' : 'password');
	});

	$('#show_pass_2').click(function(){
		$('#password,#id_2').attr('type', $(this).is(':checked') ? 'text' : 'password');
	});

	$('#show_pass_3').click(function(){
		$('#password,#id_3').attr('type', $(this).is(':checked') ? 'text' : 'password');
	});

// menu siswa handle
	$('#profil-btn').click(function(){
		$('#profile').toggleClass('visible');
	})

// handle info
	$('#close_info').click(function(){
		$('#info-update').toggleClass('hide');
	})

// Tool tip
	$('.tool-tip').tooltip({
		placement: 'right'
	});

	$('.profile-btn, .user-update').tooltip({
		placement: 'left'
	});
	$('#berita-content',this).summernote({
      placeholder: 'write here...',
	        height:200,
	        width:'90%',
	        minHeight:null,
	        maxHeight:null,
	        dialogInBody:false
	      });
	$('#agenda-content',this).summernote({
      placeholder: 'write here...',
	        height:150,
	        width:'90%',
	        minHeight:null,
	        maxHeight:null,
	        dialogInBody:false
	      });
	$('.modal').on('shown.bs.modal',function(){
		$('input:text:first',this).focus();
		$('#berita-content',this).summernote({
			        height:200,
			        width:'90%',
			        minHeight:null,
			        maxHeight:null,
			        dialogInBody:false
			      });
	});

	$('.link').click(function(){
		$(this).find('.menu-title').toggleClass('col-flat-orange');
		$(this).find('.icon-left-menu i').toggleClass('col-flat-orange');
		$(this).find('.icon-right-menu i').toggleClass('fa-angle-down').toggleClass('col-flat-orange');
		$(this).find('ul .span i').toggleClass('col-flat-orange');
	});

});