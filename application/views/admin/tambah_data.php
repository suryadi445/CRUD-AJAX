<div class="container">
    <div class="card mt-3 shadow-sm bg-white rounded">
        <form class="mt-3" action="<?= base_url('admin/insert') ?>" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="text-center">Form Tambah Data</h2>
                    </div>
                </div>
                <?php if ($this->session->flashdata()) : ?>
                    <?= $this->session->flashdata('flash') ?>
                <?php endif ?>
                <div class="card p-3 shadow-sm p-3 mb-5 bg-white rounded">
                    <div class="form-group row">
                        <label for="kode_customer" class="col-sm-3 col-form-label font-weight-bold">Kode Customer</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control font-weight-bold" name="kode" id="kode" placeholder="Masukkan kode customer" value="<?= set_value('kode') ?>">
                        </div>
                        <div class="text-danger mb-n4 offset-sm-3 col-sm-9"><?= form_error('kode'); ?></div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_customer" class="col-sm-3 col-form-label font-weight-bold">Nama Customer</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control font-weight-bold" name="nama" id="nama" placeholder="Masukkan nama customer" value="<?= set_value('nama') ?>">
                        </div>
                        <div class="text-danger mb-n4 offset-sm-3 col-sm-9"><?= form_error('nama'); ?></div>
                    </div>
                    <div class="form-group row">
                        <label for="kota" class="col-sm-3 col-form-label font-weight-bold">Kota</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control font-weight-bold" name="kota" id="kota" placeholder="Masukkan kota" value="<?= set_value('kota') ?>">
                        </div>
                        <div class="text-danger mb-n4 offset-sm-3 col-sm-9"><?= form_error('kota'); ?></div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-3 col-form-label font-weight-bold">alamat</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control font-weight-bold" name="alamat" id="alamat" placeholder="Masukkan alamat" value="<?= set_value('alamat') ?>">
                        </div>
                        <div class="text-danger mb-n4 offset-sm-3 col-sm-9"><?= form_error('kota'); ?></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 float-right">
                            <button type="button" class="btn btn-primary" id="tambah">Tambah</button>
                            <a href="<?= base_url('admin/index') ?>" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>