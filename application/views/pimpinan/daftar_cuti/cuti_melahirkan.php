<div class="row">
	<div class="col-12 grid-margin">
		<div class="card" style="background: #4682B4;">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col">
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
								<th>Tanggal Diajukan</th>
								<th>Mulai</th>
								<th>Berakhir</th>
								<th>Surat</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<?php
								$count = 0;
								foreach ($cutiMelahirkan as $row) {
									$count = $count + 1;
								?>
									<td style="color: #fff;"><?php echo $count ?></td>
									<td style="color: #fff;"><?php echo $row->nik ?></td>
									<td style="color: #fff;"><?php echo $row->nama ?></td>
									<td style="color: #fff;"><?php echo $row->tanggal_pengajuan ?></td>
									<td style="color: #fff;"><?php echo $row->mulai_cuti ?></td>
									<td style="color: #fff;"><?php echo $row->akhir_cuti ?></td>
									<td> <a class="badge badge-primary" href="<?php echo base_url('assets/data/')  . $row->surat_melahirkan; ?>">Lihat Surat</a></td>
									<?php echo '<td>';
									if (($row->verifikasi == 1) || ($row->verifikasi == 2)) {
										echo '';
									} else {
										echo '<a type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editcutiModal' . $row->id_cuti . '"><i class="fa-solid fa-pen-to-square"></i> <span style="font-size:15px;">Kelola</span></a>&ensp;</a>';
									}
									'</td>'; ?>
									<!-- The Modal -->
									<div class="modal fade" id="editcutiModal<?= $row->id_cuti ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content" style="background-color:#4682B4;">
												<!-- Modal Header -->
												<div class="modal-header">
													<h4 class="modal-title">Konfirmasi Cuti</h4>
												</div>
												<!-- Modal body -->
												<div class="modal-body text-left">
													<form action="<?= base_url('pimpinan/sendEmail/index/' . $row->id_cuti) ?>" method="post">
														<div class="form-group">
															<input type="text" class="form-control" id="nik" name="kode_pegawai" value="<?= $row->kode_pegawai ?>" readonly>
														</div>
														<div class="form-group">
															<label for="nik">NIK</label>
															<input type="text" class="form-control" id="nik" name="nik" value="<?= $row->nik ?>" readonly>
														</div>
														<div class="form-group">
															<label for="nama">Nama Lengkap</label>
															<input type="text" class="form-control" id="nama" name="nama" value="<?= $row->nama ?>" readonly>
														</div>
														<div class="form-group">
															<label for="mulai">Mulai Cuti</label>
															<input type="text" class="form-control" id="mulai" name="mulai" value="<?= $row->mulai_cuti ?>" readonly>
														</div>
														<div class="form-group">
															<label for="berakhir">Berakhir Cuti</label>
															<input type="text" class="form-control" id="berakhir" name="berakhir" value="<?= $row->akhir_cuti ?>" readonly>
														</div>
														<div class="form-group">
															<label for="verifikasi">Verifikasi</label>
															<select class="form-control" id="verifikasi" name="verifikasi">
																<option selected>- Pilih -</option>
																<option value="1">Diterima</option>
																<option value="2">Ditolak</option>
															</select>
														</div>
														<input type="hidden" name="keterangan" value="<?= $row->keterangan ?>">
														<!-- Modal footer -->
														<div class="modal-footer">
															<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
															<button type="submit" class="btn btn-primary" name="submit">Submit</button>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
