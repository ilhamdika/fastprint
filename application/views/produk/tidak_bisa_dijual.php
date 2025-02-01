<div class="container mt-4">
    <h1 class="mb-4">Tidak bisa dijual</h1>

    <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('message'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-3">
            <select class="form-select" aria-label="Default select example" id="kategori" onchange="landing()">
                <option value="" selected>Semua kategori</option>
                <?php foreach ($kategori as $kat): ?>
                    <option value="<?= $kat->id_kategori ?>"><?= htmlspecialchars($kat->nama_kategori) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Kategori produk</th>
                    <th scope="col">Status produk</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody id="produkTableBody">

            </tbody>
        </table>
    </div>
</div>


<script>
    landing();

    function landing() {
        $('#loader').show();
        var kategori = $('#kategori').val();

        $.ajax({
            url: '<?= base_url('data/list_produk'); ?>',
            type: 'POST',
            data: {
                'status': 2,
                'kategori': kategori
            },
            success: function (data) {
                $('#loader').hide();
                data = JSON.parse(data);

                var produk = data.produk;
                $('#produkTableBody').empty();

                produk.forEach(function (item, index) {
                    var hargaRupiah = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(item.harga);
                    var statusBadge = '<span class="badge bg-danger">' + item.nama_status + '</span>';
                    var row = `<tr>
                        <td>${index + 1}</td>
                        <td>${item.nama_produk}</td>
                        <td>${hargaRupiah}</td>
                        <td>${item.nama_kategori}</td>
                        <td>${statusBadge}</td>
                        <td>
                            <a href="<?= base_url('data/edit_produk/') ?>${item.id_produk}" class="btn btn-primary">Edit</a>
                            <a href="<?= base_url('data/delete_produk/') ?>${item.id_produk}" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>`;

                    $('#produkTableBody').append(row);
                });
            }

        })
    }
</script>