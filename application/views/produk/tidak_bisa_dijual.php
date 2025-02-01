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

    <div class="row mb-4">
        <div class="col-md-3">
            <select class="form-select" id="kategori" onchange="landing()">
                <option value="" selected>Semua Kategori</option>
                <?php foreach ($kategori as $kat): ?>
                    <option value="<?= $kat->id_kategori ?>"><?= htmlspecialchars($kat->nama_kategori) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" id="search" placeholder="Cari produk..." onkeyup="cari()">
        </div>
        <div class="col-md-3" id="loadingSearch" style="display: none;">
            <p class="mt-2">sedang mencari ......</p>
        </div>
    </div>

    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Kategori Produk</th>
                    <th scope="col">Status Produk</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody id="produkTableBody">
            </tbody>
        </table>

        <nav aria-label="Page navigation">
            <ul class="pagination" id="pagination">
            </ul>
        </nav>
    </div>
</div>

<script>
    var typingTimer;
    var doneTypingInterval = 2000;
    function cari() {
        $('#loadingSearch').show();
        clearTimeout(typingTimer);
        typingTimer = setTimeout(function () {
            landing();
        }, doneTypingInterval);
    }

    landing();

    function landing(page = 1) {
        $('#loader').show();
        var kategori = $('#kategori').val();
        var search = $('#search').val();

        $.ajax({
            url: '<?= base_url('data/list_produk'); ?>',
            type: 'POST',
            data: {
                'status': 2,
                'kategori': kategori,
                'search': search,
                'page': page
            },
            success: function (data) {
                $('#loader').hide();
                $('#loadingSearch').hide();
                data = JSON.parse(data);

                var produk = data.produk;
                $('#produkTableBody').empty();


                produk.forEach(function (item, index) {
                    var nomorUrut = (page - 1) * 10 + (index + 1);

                    var hargaRupiah = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(item.harga);
                    var statusBadge = '<span class="badge bg-danger">' + item.nama_status + '</span>';
                    var row = `<tr>
                        <td>${nomorUrut}</td>
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


                var total_pages = data.total_pages;
                var pagination = $('#pagination');
                pagination.empty();

                for (var i = 1; i <= total_pages; i++) {
                    var activeClass = (i === data.current_page) ? 'active' : '';
                    pagination.append(`<li class="page-item ${activeClass}">
                        <a class="page-link" href="javascript:void(0)" onclick="landing(${i})">${i}</a>
                    </li>`);
                }
            }
        });
    }
</script>