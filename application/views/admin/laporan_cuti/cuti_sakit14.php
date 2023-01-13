<div class="row">
  <div class="col-12 grid-margin">
    <div class="card" style="background: #4682B4;">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col">
            <h4 class="card-title" style="color: #fff;">Laporan Cuti</h4>
          </div>
        </div>
        <div class="table-responsive text-white">
          <table class="table table-white" id="table">
            <thead>
              <tr style="color: #fff;">
                <th>No</th>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>Jabatan</th>
                <th>Keterangan Cuti</th>
                <th>Mulai</th>
                <th>Berakhir</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $count = 0;
              foreach ($cuti_sakit14 as $row) {
                $count = $count + 1;
              ?>
                <tr>
                  <td style="color: #fff;"><?php echo $count ?></td>
                  <td style="color: #fff;"><?php echo $row->nik ?></td>
                  <td style="color: #fff;"><?php echo $row->nama ?></td>
                  <td style="color: #fff;"><?php echo $row->jabatan ?></td>
                  <td style="color: #fff;"><?php echo $row->keterangan ?></td>
                  <td style="color: #fff;"><?php echo $row->mulai_cuti ?></td>
                  <td style="color: #fff;"><?php echo $row->akhir_cuti ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
