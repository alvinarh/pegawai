<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col">
            <h4 class="card-title">Edit Data Pegawai</h4>
          </div>
          <div class="col text-right">
            <a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-primary">Kembali</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">

            <form action="" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputUsername1">NIK</label>
                <input type="text" class="form-control" name="nik" placeholder="masukan NIK Pegawai" value="<?php echo $data->nik;?>" required>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama" placeholder="masukan Nama Pegawai" value="<?php echo $data->nama;?>" required>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Alamat</label>
                <textarea name="alamat" class="form-control" id="editor" placeholder="masukan Alamat" value="" required><?= $data->alamat;?></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Jenis Kelamin</label>
                 <select name="jenis_kel" class="form-control">
                 <option value="" selected disabled>-- Pilih --</option>
                              <?php if ($tipe['jenis_kel'] == 'P') {
                                echo "Perempuan"
                              ?>
                              <?php } ?>
                               <?php if ($tipe['jenis_kel'] == 'L') {
                                echo "Laki-Laki"
                              ?>
                              <?php } ?>
                             </option>
                              <option value="Perempuan">Perempuan</option>
                              <option value="Laki-Laki">Laki-Laki</option>
                          </select>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Nomor HP</label>
                <input required type="text" class="form-control" name="notelp" placeholder="Masukan Nomer HP" value="<?= $data->no_telp;?>">
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Jabatan</label>
                 <select name="jabatan" class="form-control">
                 <option value="" selected disabled>-- Pilih --</option>
                              <?php if ($tipe['jabatan'] == 'Humas') {
                                echo "Staff Humas"
                              ?>
                              <?php } ?>
                              <?php if ($tipe['jabatan'] == 'Keuangan') {
                                echo "Staff Keuangan"
                              ?>
                              <?php } ?>
                              <?php if ($tipe['jabatan'] == 'RumahTangga') {
                                echo "Staff Rumah Tangga"
                              ?>
                              <?php } ?>
                              <?php if ($tipe['jabatan'] == 'Umum') {
                                echo "Staff Umum"
                              ?>
                              <?php } ?>
                              <?php if ($tipe['jabatan'] == 'Persidangan') {
                                echo "Staff Persidangan"
                              ?>
                              <?php } ?>
                              <?php if ($tipe['jabatan'] == 'Perlengkapan') {
                                echo "Staff Perlengkapan"
                              ?>
                              <?php } ?>
                             </option>
                              <option value="Staff Humas">Staff Humas</option>
                              <option value="Staff Keuangan">Staff Keuangan</option>
                              <option value="Staff Rumah Tangga">Staff Rumah Tangga</option>
                              <option value="Staff Umum">Staff Umum</option>
                              <option value="Staff Persidangan">Staff Persidangan</option>
                              <option value="Staff Perlengkapan">Staff Perlengkapan</option>
                          </select>
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Email</label>
                <input required type="email" class="form-control" name="email" placeholder="Masukan Alamat Email" value="<?= $data->email;?>">
              </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Status Pegawai</label>
                 <select name="status" class="form-control">
                 <option value="" selected disabled>-- Pilih --</option>
                              <?php if ($status['status'] == 1) {
                                echo "Aktif"
                              ?>
                              <?php } ?>
                              <?php if ($status['status'] == 2) {
                                echo "Tidak Aktif"
                              ?>
                              <?php } ?>
                              <?php if ($status['status'] == 3) {
                                echo "Keluar"
                              ?>
                              <?php } ?>
                             </option>
                              <option value="Aktif">Aktif</option>
                              <option value="Tidak Aktif">Tidak Aktif</option>
                              <option value="Keluar">Keluar</option>
                          </select>
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-success text-right" name="submitData">Simpan</button>
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
