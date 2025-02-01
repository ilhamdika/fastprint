<div class="container mt-4">
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
                'status': 1,
                'kategori': kategori
            },
            success: function (data) {
                $('#loader').hide();
                data = JSON.parse(data);

                var produk = data.produk;
                $('#produkTableBody').empty();

                produk.forEach(function (item, index) {
                    var row = `<tr>
                        <td>${index + 1}</td>
                        <td>${item.nama_produk}</td>
                        <td>${item.harga}</td>
                        <td>${item.nama_kategori}</td>
                        <td>${item.nama_status}</td>
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