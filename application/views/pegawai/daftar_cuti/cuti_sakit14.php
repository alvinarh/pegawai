<div class="row">
	<div class="col-12 grid-margin">
		<div class="card" style="background: #4682B4;">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col">
						<?php if ($this->session->flashdata('message')) {
							echo '<p class="success mt-2 mb-2">' . $this->session->flashdata('message') . '</p>';
						} ?>
						<h4 class="card-title" style="color: #fff;">Data Cuti</h4>
					</div>
				</div>
				<div class="table-responsive text-white">
					<table class="table table-white" id="table">
						<thead>
							<tr style="color: #fff;">
								<th>No</th>
								<th>NIK</th>
								<th>Nama Lengkap</th>
								<th>Perihal</th>
								<th>Tanggal Diajukan</th>
								<th>Mulai</th>
								<th>Berakhir</th>
								<th>Sisa Cuti</th>
								<th>Status</th>
								<th>Surat Dokter</th>
								<th>Verifikasi</th>
								<th>Cetak Laporan</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<?php
								$count = 0;
								foreach ($cutiSakit14 as $row) {
									$count = $count + 1;
								?>
									<td style="color: #fff;"><?php echo $count ?></td>
									<td style="color: #fff;"><?php echo $row->nik ?></td>
									<td style="color: #fff;"><?php echo $row->nama ?></td>
									<td style="color: #fff;"><?php echo $row->perihal ?></td>
									<td style="color: #fff;"><?php echo $row->tanggal_pengajuan ?></td>
									<td style="color: #fff;"><?php echo $row->mulai_cuti ?></td>
									<td style="color: #fff;"><?php echo $row->akhir_cuti ?></td>
									<td style="color: #fff;">
										<?php
										$tanggalSekarang = date('Y-m-d');
										$akhirCuti = $row->akhir_cuti;
										$sisaCuti = date_diff(date_create($tanggalSekarang), date_create($akhirCuti));
										echo $sisaCuti->format('%a hari');
										?>
									</td>


									<?php
									if ($row->status == 1) {
										echo '<td class= "text-success"> Selesai</td>';
									} else {
										echo '<td  class = "text-warning"> Belum Selesai</td>';
									}
									?>
									</td>
									<td> <a class="badge badge-primary" href="<?php echo base_url('assets/data/')  . $row->surat_dokter14; ?>">Lihat Surat</a></td>
									<?php
									echo '<td>';
									if ($row->verifikasi == 0) {
										echo '<p class="badge badge-info">Sudah Aktif Kembali</p>';
									} else if ($row->verifikasi == 1) {
										echo '<p class="badge badge-success">Diterima</p>';
									} else if ($row->verifikasi == 2) {
										echo '<p class="badge badge-warning">Ditolak</p>';
									} else if ($row->verifikasi == 3) {
										echo '<p class="badge badge-info">Menunggu Konfirmasi</p>';
									};
									'</td>';
									?>

									<?php echo '<td>';
									if ($row->verifikasi == 1) {
										echo '<a class="badge badge-primary" href ="' . base_url("pegawai/LaporanCuti/laporanCutiSakit14/") . $row->id_cuti . '">CETAK</a>';
									} else {
										echo '';
									}
									'</td>'; ?>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
