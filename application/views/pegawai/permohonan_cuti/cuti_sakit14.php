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
</div>
</div>
</div>
