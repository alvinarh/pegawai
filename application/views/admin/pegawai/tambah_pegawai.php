<div class="row">
  <div class="col-12 grid-margin" style="background: #4682B4;">
    <div class="card" style="background: #4682B4;">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col">
            <h4 class="card-title" style="color: #fff;">Tambah Pegawai</h4>
          </div>
          <div class="col text-right">
            <a href="javascript:void(0)" onclick="window.history.back()" style="background: #000000;" class="btn btn-primary">Kembali</a>
          </div>
        </div>
        <div class="row" >
          <div class="col-md-12" style="background: #4682B4;">

            <form action="" method="POST" enctype="multipart/form-data">


            <div class="form-group" style="color: #fff;">
                <label for="exampleInputUsername1">NIK</label>
                <input type="text" class="form-control" name="nik" placeholder="Masukan NIK Pegawai" value="" required>
              </div>
              <div class="form-group" style="color: #fff;">
                <label for="exampleInputUsername1">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Pegawai" value="" required>
              </div>
              <div class="form-group" style="color: #fff;">
                <label for="exampleInputUsername1">Alamat</label>
                <textarea name="alamat" class="form-control" id="editor" placeholder="Masukan Alamat Pegawai" value="" required></textarea>
              </div>
              <div class="form-group" style="color: #fff;">
                <label for="exampleInputUsername1">Jenis Kelamin</label>
                  <select name="jenis_kel" class="form-control">
                  <option value="" selected disabled>-- Pilih --</option>
                              <?php if ($tipe['jenis_kel'] == 'Perempuan') {
                                echo "Perempuan"
                              ?>
                              <?php } ?>
                               <?php if ($tipe['jenis_kel'] == 'Laki-Laki') {
                                echo "Laki-Laki"
                              ?>
                              <?php } ?>
                             </option>
                              <option value="Perempuan">Perempuan</option>
                              <option value="Laki-Laki">Laki-Laki</option>
                  </select>
              </div>
              <div class="form-group" style="color: #fff;">
                <label for="exampleInputUsername1">Nomor HP</label>
                <input required type="text" class="form-control" name="notelp" placeholder="Masukan Nomor HP" value="">
              </div>
              <div class="form-group" style="color: #fff;">
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
              <div class="form-group" style="color: #fff;">
                <label for="exampleInputUsername1">Email</label>
                <input required type="email" class="form-control" name="email" placeholder="Masukan Alamat Email" value="">
              </div>
              <input type="hidden" name="status" value="Aktif">
              <input type="hidden" name="password" value="user">
              <input type="hidden" name="role" value="3">
              <div class="text-right">
                <button type="submit" style="background: #000000;" class="btn btn-success text-right" name="submitData">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
