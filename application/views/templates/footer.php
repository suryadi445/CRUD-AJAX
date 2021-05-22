    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- swal -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>

    </html>

    <script>
        // alert untuk hapus
        $('.hapus').click(function(e) {
            e.preventDefault()
            var link = $(this).attr('href')
            Swal.fire({
                title: 'Apa Anda Yakin?',
                text: "Data yang sudah dihapus tidak bisa dikembalikan. Setuju?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: 'silver',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = link
                }
            })
        })

        // berfungsi untuk mengambil data dari db
        getData();

        // fungsi get data
        function getData() {
            $.ajax({
                url: '<?= base_url('admin/get_ajax'); ?>',
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    // console.log(data[index].id);
                    var no = 1;
                    var baris = '';
                    for (let index = 0; index < data.length; index++) {
                        baris +=
                            '<tr>' +
                            '<td>' + no++ + '</td>' +
                            '<td>' + data[index].kode_kustomer + '</td>' +
                            '<td>' + data[index].nama_customer + '</td>' +
                            '<td>' + data[index].kota + '</td>' +
                            '<td>' + data[index].alamat + '</td>' +
                            '<td>' +
                            `<div class="row justify-content-center">
                                    <div class="col">
                                        <button class="btn btn-warning mr-3" data-toggle="modal" data-target="#modal_insert" id="btn-edit" onclick="submit(` + data[index].id + `)">Edit</button>
                                        <button class="btn btn-danger hapus" onclick ="hapus(` + data[index].id + `)">Delete</button>
                                    </div>
                            </div>` +
                            '</td>' +
                            '</tr>'
                    }
                    $('#table_body').html(baris)
                }
            })
        }

        // fungsi tambah data
        $('#insert').click(function(e) {
            $('#err_mssg').show();
            e.preventDefault();

            var kode = $('#kode').val();
            var nama = $('#nama').val();
            var kota = $('#kota').val();
            var alamat = $('#alamat').val();

            $.ajax({
                url: '<?= base_url('admin/insert_ajax'); ?>',
                type: 'post',
                data: {
                    kode: kode,
                    nama: nama,
                    kota: kota,
                    alamat: alamat
                },
                success: function(data) {
                    var obj = $.parseJSON(data);
                    if (obj.error_message != null) {
                        $('#err_mssg').html(obj['error_message']);
                    } else {
                        $('#modal_insert').modal('hide')
                        $('#kode').val('')
                        $('#nama').val('')
                        $('#kota').val('')
                        $('#alamat').val('')
                        getData();
                    }
                }
            })
        })

        // cek button modal insert atau edit
        // jika bukan tambah maka akan melakukan fungsi edit
        function submit(x) {
            if (x == 'tambah') {
                $('#err_mssg').hide();

                $('#insert').show()
                $('#edit').hide()
            } else {
                $('#err_mssg').hide();
                $('#exampleModalLabel').html('Edit Data')
                $('#insert').hide()
                $('#edit').show()

                $.ajax({
                    url: '<?= base_url('admin/get_id'); ?>',
                    type: 'post',
                    dataType: 'json',
                    data: 'id=' + x,
                    success: function(data) {
                        $('#id').val(data.id)
                        $('#nama').val(data.nama_customer)
                        $('#kode').val(data.kode_kustomer)
                        $('#kota').val(data.kota)
                        $('#alamat').val(data.alamat)
                    }
                })
            }
        }

        // fungsi edit data
        $('#edit').click(function(e) {
            e.preventDefault
            var id = $('#id').val()
            var nama = $('#nama').val()
            var kode = $('#kode').val()
            var kota = $('#kota').val()
            var alamat = $('#alamat').val()

            $.ajax({
                url: '<?= base_url('admin/edit_ajax'); ?>',
                type: 'post',
                data: {
                    id: id,
                    nama: nama,
                    kode: kode,
                    kota: kota,
                    alamat: alamat
                },
                success: function(data) {
                    var obj = $.parseJSON(data);
                    if (obj.error_message != null) {
                        $('#err_mssg').show()
                        $('#err_mssg').html(obj['error_message']);
                    } else {
                        $('#modal_insert').modal('hide')
                    }
                    getData();
                }
            })
        })

        function hapus() {

        }
    </script>