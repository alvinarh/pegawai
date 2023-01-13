<div class="row">
	<div class="col-12 grid-margin">
		<div class="card" style="background: #2c2d30;">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col">
						<h4 class="card-title" style="color: #fff;">Data Cuti</h4>
					</div>
				</div>
				<div class="table-responsive text-white">
					<table class="table table-bordered table-hovered table-responsive" id="table">
						<thead>
							<tr style="color: #fff;">
								<th>No</th>
								<th>Nama Lengkap</th>
								<th>Alasan</th>
								<th>Tanggal Diajukan</th>
								<th>Mulai</th>
								<th>Berakhir</th>
								<th>Sisa Cuti</th>
								<th>Perihal Cuti</th>
								<th>Cetak Surat</th>
								<th>Status Cuti</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://rawgit.com/dimsemenov/Magnific-Popup/master/dist/jquery.magnific-popup.js"></script>
<script>
	$(document).ready(function() {
		$(".FlowerLink").each(function() {
			$(this).wrap("<a class=\"FlowerLinkWrapper\" href=\"" + $(this).attr('src') + "\"></a>");
		});
		$('.FlowerLinkWrapper').magnificPopup({
			type: 'image',
			closeOnContentClick: true,
			image: {
				verticalFit: true
			},
			zoom: {
				enabled: true,
				duration: 800 // don't foget to change the duration also in CSS
			}
		});
	});
</script>
