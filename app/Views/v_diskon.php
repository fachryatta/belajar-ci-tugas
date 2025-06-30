<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3>Diskon</h3>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-triangle-fill"></i>
    <?= esc(session()->getFlashdata('errors')) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>


    <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
        Tambah Data
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nominal (Rp)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($diskon as $d) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d['tanggal'] ?></td>
                <td><?= number_format($d['nominal'],0,',','.') ?></td>
                <td>
                    <a href="#" 
                        class="btn btn-success btn-sm btn-edit" 
                        data-id="<?= $d['id'] ?>"
                        data-tanggal="<?= $d['tanggal'] ?>"
                        data-nominal="<?= $d['nominal'] ?>"
                        data-bs-toggle="modal"
                        data-bs-target="#modalEdit"
                    >Ubah</a>
                    <form action="<?= base_url('diskon/delete/'.$d['id']) ?>" method="post" style="display:inline;">
                        <?= csrf_field() ?>
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url(relativePath: 'diskon/store') ?>" method="post">
      <?= csrf_field() ?>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Diskon</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="<?= old('tanggal') ?>" required>
          </div>
          <div class="mb-3">
            <label>Nominal (Rp)</label>
            <input type="number" name="nominal" class="form-control" value="<?= old('nominal') ?>" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formEdit" method="post">
      <?= csrf_field() ?>
      <input type="hidden" name="id" id="edit-id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Diskon</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" id="edit-tanggal" class="form-control" readonly>
          </div>
          <div class="mb-3">
            <label>Nominal (Rp)</label>
            <input type="number" name="nominal" id="edit-nominal" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="modalHapus" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formHapus" method="post">
      <?= csrf_field() ?>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Konfirmasi Hapus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p>Yakin ingin menghapus diskon tanggal <strong id="hapus-tanggal"></strong>?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </div>
    </form>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.btn-edit');
    const hapusButtons = document.querySelectorAll('.btn-hapus');

    // Untuk Edit
    editButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const tanggal = this.dataset.tanggal;
            const nominal = this.dataset.nominal;

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-tanggal').value = tanggal;
            document.getElementById('edit-nominal').value = nominal;

            const form = document.getElementById('formEdit');
            if (form) form.action = `<?= base_url('diskon/update') ?>/${id}`;
        });
    });

    // Untuk Hapus
    hapusButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const tanggal = this.dataset.tanggal;

            document.getElementById('hapus-tanggal').innerText = tanggal;
            const form = document.getElementById('formHapus');
            form.action = `<?= base_url('diskon/delete') ?>/${id}`;
        });
    });
});
</script>


<?= $this->endSection() ?>
