<div class="row">


	<!-- Cek jika user telah mengajukan cuti dan verifikasi masih menunggu -->
	<div class="col-12 grid-margin">
		<?php if ($this->session->flashdata('message')) {
			echo '<p class="warning mt-2 mb-2">' . $this->session->flashdata('message') . '</p>';
		} ?>

		<?php if (isset($cek_cuti2['kode_pegawai']) != null) { ?>
			<div class="alert alert-danger" role="alert">

				Anda telah mengajukan cuti, mohon menunggu verifikasi dari admin. <br>

			</div>
		<?php } ?>
		<?php if (isset($validasi_cuti['kode_pegawai']) != null) { ?>
			<div class="alert alert-danger" role="alert">

				Anda masih memiliki <?= $validasi_cuti2['keterangan'] ?> pada tanggal <?= $validasi_cuti['mulai_cuti'] ?> s/d <?= $validasi_cuti['akhir_cuti'] ?>. <br>

			</div>
		<?php } ?>
		<?php if (isset($cek_cuti2['kode_pegawai']) == null && isset($validasi_cuti['kode_pegawai']) == null) { ?>

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


							<form action="<?php echo base_url(); ?>pegawai/PermohonanCuti/cutiSakit14" method="POST" enctype="multipart/form-data">
								<input type="hidden" class="form-control" name="kode_pegawai" value="<?= $user->kode_pegawai ?>" required>
								<div class="form-group">
									<label for="perihal">Perihal</label>
									<input type="text" class="form-control" id="perihal" aria-describedby="perihal" name="perihal" required>
								</div>
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

						<button type="submit" style="background: #000000;" class="btn btn-primary">Submit</button>
						</form>
						<?php echo $this->session->flashdata('msg'); ?>
					</div>
				</div>
			</div>

	</div>
<?php } ?>

<h1 id="countdown" class="text-center"></h1>




</div>
</div>
</div>
</div>

<script src="<?php echo base_url(); ?>assets/jquery-3.6.3.min.js"></script>


<script>
	$(document).ready(function() {
		// Menghitung countdown
		var countDownDate = new Date("<?= $validasi_cuti['akhir_cuti'] ?>").getTime();

		var x = setInterval(function() {
			var now = new Date().getTime();
			var distance = countDownDate - now;
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			document.getElementById("countdown").innerHTML = days + " Hari " + hours + " Jam " +
				minutes + " Menit " + seconds + " Detik ";
			if (distance < 0) {
				clearInterval(x);
				document.getElementById("countdown").innerHTML = "EXPIRED";
			}
		}, 1000);
		alert("test");


	});
</script>
