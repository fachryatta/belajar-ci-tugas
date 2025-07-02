<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php helper('number'); ?>

<h2>Detail Data</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Foto</th>
            <th>Nama Produk</th>
            <th>Harga Awal</th>
            <th>Diskon</th>
            <th>Jumlah</th>
            <th>Subtotal Harga</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item) : ?>
            <tr>
                <td>
                    <img src="<?= base_url('img/' . $item['foto']) ?>" width="100" alt="Gambar">
                </td>
                <td><?= esc($item['nama']) ?></td>
                <td><?= number_to_currency($item['harga_awal'], 'IDR') ?></td>
                <td><?= number_to_currency($item['diskon'], 'IDR') ?></td>
                <td><?= $item['jumlah'] ?></td>
                <td><?= number_to_currency($item['subtotal_harga'], 'IDR') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="<?= base_url('pembelian') ?>" class="btn btn-secondary">Kembali</a>

<?= $this->endSection() ?>
