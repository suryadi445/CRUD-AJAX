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
                                        <button class="btn btn-warning mr-3" onclick = "update_data(` + data[index].id + `)">Edit</button>
                                        <button class="btn btn-danger hapus" onclick = "delete_data(` + data[index].id + `)">Delete</button>
                                    </div>
                            </div>` +
                            '</td>' +
                            '</tr>'
                    }
                    $('#table_body').html(baris)
                }
            })
        }

        $('#tambah').click(function() {
            $('#err_mssg').hide();
        })

        $('#insert').click(function(e) {
            $('#err_mssg').show();
            e.preventDefault();

            var kode = $('#kode').val();
            var nama = $('#nama').val();
            var kota = $('#kota').val();
            var alamat = $('#alamat').val();

            $.ajax({
                url: '<?= base_url('admin/ajax'); ?>',
                type: 'post',
                data: {
                    kode: kode,
                    nama: nama,
                    kota: kota,
                    alamat: alamat
                },
                success: function(data) {
                    var obj = $.parseJSON(data);
                    // console.log(obj.error_message);
                    // return false
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
    </script>