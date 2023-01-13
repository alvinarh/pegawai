<div class="row">
	<div class="col-12 grid-margin">
	<?php if ($this->session->flashdata('message')) {
                                            echo '<p class="warning mt-2 mb-2">' . $this->session->flashdata('message') . '</p>';
                                        } ?>
		<div class="card" style="background: #4682B4;">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col">
						<h4 class="card-title text-white">Permohonan Cuti</h4>
					</div>
					<div class="col text-right">
						<a href="javascript:void(0)" onclick="window.history.back()" style="background: #000000;" class="btn btn-primary">Kembali</a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 text-white" style="background: #4682B4;">

						<form action="<?php echo base_url(); ?>pegawai/PermohonanCuti/cutiMelahirkan" method="POST" enctype="multipart/form-data">
							<input type="hidden" class="form-control" name="kode_pegawai" value="<?= $user->kode_pegawai ?>" required>
							<div class="form-group">
								<label for="mulai">Mulai Cuti</label>
								<input type="date" class="form-control" id="mulai" aria-describedby="mulai" name="mulai" required>
							</div>
							<div class="form-group">
								<label for="berakhir">Berakhir Cuti</label>
								<input type="date" class="form-control" id="berakhir" aria-describedby="berakhir" name="berakhir" required>
							</div>
							<div class="col-md-6 mb-3">
								<label for="surat"><b>File Surat Pengantar</b></label>
								<input type="file" class="form-control-file" name="surat_pengantar" id="surat">
							</div>
					</div>

					<button type="submit" style="background: #000000;" id="btnSubmit" class="btn btn-primary">Submit</button>
					</form>
					<?php echo $this->session->flashdata('msg'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>


<script src="<?php echo base_url(); ?>assets/jquery-3.6.3.min.js"></script>
<script>
	$(document).ready(function() {
		$('#berakhir').change(function() {
			var mulai = $('#mulai').val();
			var berakhir = $('#berakhir').val();
			var date1 = new Date(mulai);
			var date2 = new Date(berakhir);
			var timeDiff = Math.abs(date2.getTime() - date1.getTime());
			var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

			if (diffDays > 90) {
				alert('Periode tanggal tidak boleh lebih dari 3 bulan!');
				$('#btnSubmit').attr('disabled', true);
			} else {
				$('#btnSubmit').attr('disabled', false);
			}

		});
	});
</script>

<script>
	$(document).ready(function() {
		// $('#berakhir').change(function() {
		// 	var mulai = $('#mulai').val();
		// 	var berakhir = $('#berakhir').val();
		// 	var yearMulai = mulai.substring(0, 4);
		// 	var monthMulai = mulai.substring(0, 1);
		// 	var dayMulai = mulai.substring(8, 10);
		// 	var timeDiff = Math.abs(date2.getTime() - date1.getTime());
		// 	var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

		// 	alert('test');

		// 	// if (diffDays > 90) {
		// 	// 	alert('Periode tanggal tidak boleh lebih dari 3 bulan!');
		// 	// 	$('#btnSubmit').attr('disabled', true);
		// 	// } else {
		// 	// 	$('#btnSubmit').attr('disabled', false);
		// 	// }

		// });

		$('#berakhir').change(function() {
			var mulai = $('#mulai').val();
			var berakhir = $('#berakhir').val();

			var tahunMulai = mulai.substring(0, 4);
			var bulanMulai = mulai.substring(5, 7);
			var hariMulai = mulai.substring(8, 10);

			var tahunBerakhir = berakhir.substring(0, 4);
			var bulanBerakhir = berakhir.substring(5, 7);
			var hariBerakhir = berakhir.substring(8, 10);

			var tahunSekarang = new Date().getFullYear();

			if (tahunBerakhir > tahunMulai) {
				alert('Pilih tahun berakhir cuti yang valid!');
				$('#btnSubmit').attr('disabled', true);
			} else if (bulanBerakhir < bulanMulai) {
				alert('Pilih bulan berakhir cuti yang valid!');
				$('#btnSubmit').attr('disabled', true);
			} else if (tahunBerakhir > tahunSekarang) {
				alert('Pilih tahun berakhir cuti yang valid!');
				$('#btnSubmit').attr('disabled', true);
			} else if (tahunMulai > tahunSekarang) {
				alert('Pilih tahun mulai cuti yang valid!');
				$('#btnSubmit').attr('disabled', true);
			}


		});

	});
</script>
