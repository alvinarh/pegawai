<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col">
            <h4 class="card-title">Edit Profile Pegawai</h4>
          </div>
          <div class="col text-right">
            <a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-primary">Kembali</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
          <?php if (validation_errors()) : ?>
                <div class="alert alert-danger m-2" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <form action="" method="POST" enctype="multipart/form-data">

              <div class="form-group">
                <label for="exampleInputUsername1">NIK</label>
                <input type="text" class="form-control" name="nik" placeholder="masukan NIK Pegawai" value="<?= $data['nik']?>" required>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama" placeholder="masukan Nama Pegawai" value="<?= $data['nama']?>" required>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Alamat</label>
                <textarea name="alamat" class="form-control" id="alamat" name="alamat" placeholder="masukan Alamat" required><?= $data['alamat']?></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Nomor HP</label>
                <input required type="text" class="form-control" name="notelp" placeholder="Masukan Nomer HP" value="<?= $data['no_telp']?>">
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Jenis Kelamin</label>
                <input type="text" class="form-control" name="jeniskel" placeholder="masukan jenis kelamin" value="<?= $data['jenis_kel']?>" required>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Jabatan</label>
                <input type="text" class="form-control" name="jabatan" placeholder="masukan jenis kelamin" value="<?= $data['jabatan']?>" readonly>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Email</label>
                <input required type="email" class="form-control" name="email" placeholder="Masukan Alamat Email" value="<?= $data['email'];?>">
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Password</label>
                <input required type="password" class="form-control" name="password" placeholder="Masukan Password" value="<?= $data['password'];?>">
              </div>
              <input type="hidden" name="kode_pegawai" value="<?= $data['kode_pegawai']?>">
              <div class="text-right">
              <input class="btn btn-success" value="Update Biodata" name="submitData" data-toggle="modal" data-target="#submitModal"></input>
              </div>

              <!-- Modal Submit -->
              <div class="modal fade" id="submitModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="submitModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="submitModalLabel">Peringatan ! </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah anda yakin dengan perubahan ini ? Jika iya anda akan langsung log out dan memulai login ulang
                                    untuk perubahan data
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                    <button type="submit" name="btn" id="submit" class="btn btn-primary">Setuju</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
