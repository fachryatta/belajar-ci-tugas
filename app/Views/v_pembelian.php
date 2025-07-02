<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<?php helper('number'); ?>

<h1>Pembelian</h1>
<table class="table datatable">
    <thead>
        <tr>
            <th>ID Pembelian</th>
            <th>Username</th>
            <th>Waktu Pembelian</th>
            <th>Total Bayar</th>
            <th>Alamat</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pembelian as $row) : ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['username'] ?></td>
                <td><?= $row['created_at'] ?></td>
                <td><?= number_to_currency($row['total_harga'], 'IDR') ?></td>
                <td><?= $row['alamat'] ?></td>
                <td>
                    <?php if ($row['status'] == 1) : ?>
                        <span class="badge bg-success">Sudah Selesai</span>
                    <?php else : ?>
                        <span class="badge bg-danger">Belum Selesai</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= base_url('pembelian/ubahStatus/' . $row['id']) ?>" class="btn btn-warning btn-sm">Ubah</a>
                    <a href="<?= base_url('pembelian/detail/' . $row['id']) ?>" class="btn btn-success btn-sm">Detail</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
