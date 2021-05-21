<div class="container">
    <div class="row card mt-3">
        <div class="col">
            <h1 class="text-center mb-3 mt-3">CRUD AJAX</h1>
            <a href="<?= base_url('admin/insert') ?>" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal_insert" id="tambah">Tambah Customer</a>
            <?php if ($this->session->flashdata()) : ?>
                <?= $this->session->flashdata('flash') ?>
            <?php endif ?>
            <table class="table text-center table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Kode Customer</th>
                        <th scope="col">Nama Customer</th>
                        <th scope="col">Kota</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <!-- <tbody>
                    <?php $no = 1;
                    foreach ($result as $hasil) : ?>
                        <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td><?= $hasil['kode_kustomer'] ?></td>
                            <td><?= $hasil['nama_customer'] ?></td>
                            <td><?= $hasil['kota'] ?></td>
                            <td><?= $hasil['alamat'] ?></td>
                            <td>
                                <div class="row justify-content-center">
                                    <div class="col">
                                        <a href="<?= base_url('admin/edit/') . $hasil['id']; ?>" class="btn btn-warning mr-3">Edit</a>
                                        <a href="<?= base_url('admin/delete/') . $hasil['id']; ?>?>" class="btn btn-danger hapus">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody> -->
                <tbody id="table_body">
                    <!-- looping menggunakan ajax -->
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_insert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="err_mssg" class="alert alert-success" role="alert"></div>
            <div class="modal-body">
                <form action="<?= base_url('admin/ajax'); ?>" method="post">
                    <?= $this->session->flashdata('validasi'); ?>
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="insert">Tambah Data</button>
            </div>
        </div>
    </div>
</div>