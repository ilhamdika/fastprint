<div class="sidebar">
    <div class="list-group">
        <a href="<?= base_url(); ?>"
            class="list-group-item list-group-item-action custom-list-item <?= $this->uri->segment(1) == '' ? 'active' : ''; ?>">
            <i class="fas fa-box"></i> Produk
        </a>

        <a href="<?= base_url('welcome/tidak_bisa_dijual'); ?>"
            class="list-group-item list-group-item-action custom-list-item <?= $this->uri->segment(2) == 'tidak_bisa_dijual' ? 'active' : ''; ?>">
            <i class="fas fa-ban"></i> Tidak Bisa Dijual
        </a>
    </div>
</div>