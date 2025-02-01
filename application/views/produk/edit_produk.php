<div class="container mt-4">
    <h1>Edit Produk</h1>

    <form action="<?= base_url('data/update_produk_action/' . $produk->id_produk); ?>" method="POST">
        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                value="<?= htmlspecialchars($produk->nama_produk) ?>" required>
        </div>

        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select class="form-select" id="kategori" name="kategori_id" required>
                <option value="">Pilih Kategori</option>
                <?php foreach ($kategori as $kat): ?>
                    <option value="<?= $kat->id_kategori ?>" <?= $produk->kategori_id == $kat->id_kategori ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($kat->nama_kategori) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status Produk</label>
            <select class="form-select" id="status" name="status_id" required>
                <option value="">Pilih Status</option>
                <?php foreach ($status as $stat): ?>
                    <option value="<?= $stat->id_status ?>" <?= $produk->status_id == $stat->id_status ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($stat->nama_status) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" class="form-control" id="harga" name="harga"
                value="<?= number_format($produk->harga, 0, ',', '.') ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Produk</button>
    </form>
</div>

<script>
    function formatRupiah(angka, prefix = 'Rp ') {
        let number_string = angka.replace(/[^,\d]/g, '').toString();
        let split = number_string.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix + rupiah;
    }

    $('#harga').on('keyup', function () {
        let inputValue = $(this).val();
        $(this).val(formatRupiah(inputValue));
    });

    $(document).ready(function () {
        let harga = $('#harga').val();
        $('#harga').val(formatRupiah(harga));
    });

    $('form').submit(function () {
        var harga = $('#harga').val().replace(/[^0-9]/g, '');
        $('#harga').val(harga);
    });
</script>