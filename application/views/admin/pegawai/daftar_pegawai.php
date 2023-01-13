<div class="row">
  <div class="col-12 grid-margin">
    <div class="card" style="background: #4682B4;">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col">
            <h4 class="card-title" style="color: #fff;">Data Pegawai</h4>
          </div>
        </div>
        <div class="table-responsive text-white">
          <table class="table table-bordered table-hovered table-responsive" id="table">
                    <thead>
                            <tr>
                                <th style="color: #fff;">No</th>
                                <th style="color: #fff;">NIK</th>
                                <th style="color: #fff;">Nama Lengkap</th>
                                <th style="color: #fff;">Jenis Kelamin</th>
                                <th style="color: #fff;">No Telp</th>
                                <th style="color: #fff;">Alamat</th>
                                <th style="color: #fff;">Jabatan</th>
                                <th style="color: #fff;">Email</th>
                                <th style="color: #fff;">Status</th>
                                <th style="color: #fff;">Aksi</th>
                            </tr>
                    </thead>
                    <tbody>
                            <tr>
                              <?php
                $count = 0;
                foreach ($dataPegawai as $row) {
                  $count = $count + 1;
                ?>
                                <td style="color: #fff;"><?php echo $count ?></td>
                                <td style="color: #fff;"><?php echo $row->nik ?></td>
                                <td style="color: #fff;"><?php echo $row->nama ?></td>
                                <td style="color: #fff;"><?php echo $row->jenis_kel?></td>
                                <td style="color: #fff;"><?php echo $row->no_telp ?></td>
                                <td style="color: #fff;"><?php echo $row->alamat ?></td>
                                <td style="color: #fff;"> <?php echo $row->jabatan ?></td>
                                <td style="color: #fff;"> <?php echo $row->email ?></td>
                                <td style="color: #fff;"><?php echo $row->status ?></td>
                                 <td align="center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                      <a href="<?= base_url('admin/Pegawai/edit/') . $row->kode_pegawai; ?>" class="btn btn-warning mr-3 btn-sm">
                                        <i class="mdi mdi-tooltip-edit"></i>
                                      </a>
                                      <a href="<?= base_url('admin/Pegawai/deletePegawai/') . $row->kode_pegawai; ?>" onclick="return confirm('Yakin Hapus data')" class="btn btn-danger btn-sm">
                                        <i class="mdi mdi-delete-forever"></i>
                                      </a>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                    </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

