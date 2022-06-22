<?php $this->extend('template') ?>

<?php $this->section('content') ?>
<div class="container-fluid page-body-wrapper">
    <!-- partial -->
    <div class="main-panel" style="margin-left: auto; margin-right:auto;">
        <div class="content-wrapper text-center">
            <h2>Wisata</h2>
            <button class="btn btn-info" onclick="tryTambah()">Tambah</button>
            <hr>
            <div class="row">
                <?php for ($i = 0; $i < count($wisata); $i++) : ?>
                    <div class="col-lg-3 grid-margin stretch-card m-3">
                        <div class="card shadow rounded" style="width: 18rem;">
                            <div class="card-body p-0">
                                <img src="<?= base_url() ?>/public/img/<?= $wisata[$i]["foto"] ?>" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <h5><?= $wisata[$i]["nama"] ?></h5>
                                    <i><?= $wisata[$i]["alamat"] ?></i><br>
                                    <i>latitude : <?= $wisata[$i]["latitude"] ?></i><br>
                                    <i>longitude : <?= $wisata[$i]["longitude"] ?></i>
                                    <br>

                                    <button class="btn btn-info btn-sm btn-fw mt-2" onclick='detail(<?= $wisata[$i]["id"] ?>, "<?= $wisata[$i]["nama"] ?>", "<?= $wisata[$i]["deskripsi"] ?>" )'><i class='fa fa-list'></i></a></button>
                                    <button class="btn btn-info btn-sm btn-fw mt-2" onclick='tryEdit(<?= $wisata[$i]["id"] ?>, "<?= $wisata[$i]["nama"] ?>", "<?= $wisata[$i]["alamat"] ?>", "<?= $wisata[$i]["latitude"] ?>", "<?= $wisata[$i]["longitude"] ?>", "<?= $wisata[$i]["deskripsi"] ?>" )'><i class='fa fa-edit'></i></a></button>
                                    <button class="btn btn-info btn-sm btn-fw mt-2" onclick='tryHapus(<?= $wisata[$i]["id"] ?>, "<?= $wisata[$i]["nama"] ?>" )'><i class='fa fa-trash'></i></a></button>
                                    <button class="btn btn-info btn-sm btn-fw mt-2" onclick='tryUpload(<?= $wisata[$i]["id"] ?>, "<?= $wisata[$i]["nama"] ?>", "<?= $wisata[$i]["foto"] ?>" )'><i class='fa fa-image'></i></a></button>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                endfor; ?>
            </div>
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalDetail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-3">
            <h3 class="h3 text-info" id="namaWisata"></h3>
            Deskripsi : <br>
            <p id="deskripsiWisata"></p>
            <br>
            <br>
            <h5 class="h5 text-info">Data Pengunjung :</h5>
            <div id="tempatTabel">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Hari</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody id="tabelPengunjung">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalTambah">
    <div class="modal-dialog">
        <div class="modal-content p-3">
            <h4 id="judulModal">Tambah Wisata</h4>
            <hr>
            <form>
                <div class="form-group row">
                    <input type="hidden" id="id" name="id">
                    <label for="inputEmail3" class="col-lg-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama" name="nama" onchange="updateUsername()">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-lg-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="alamat" name="alamat">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-lg-3 col-form-label">latitude</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="latitude" name="latitude">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-lg-3 col-form-label">longitude</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="longitude" name="longitude">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-lg-3 col-form-label">Deskripsi</label>
                    <div class="col-sm-9">
                        <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="5"></textarea>
                    </div>
                </div>
            </form>
            <div class="form-group row">
                <div class="col-sm-12 text-center">
                    <button class="btn btn-info" onclick="tambah()" id="tambah">Tambah</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <!-- <button type="button" class="btn btn-secondary" id="batal" onclick="batalEdit()">Batal</button> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class=" modal fade" id="modalHapus" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus User</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" id="idHapus" name="idHapus">
                <p>Apakah anda yakin ingin menghapus <b id="detailHapus">....</b> ?</p>

                <b class="text-danger"><i>*Semua data pengunjung akan dihapus.</i></b>
            </div>
            <div class="modal-footer">
                <button type="button" id="hapus" onclick="hapus()" class="btn btn-info">Hapus</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalUpload" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Foto <b id="namaUploadFoto"></b></h5>
            </div>
            <div class="modal-body text-center">
                <form enctype="multipart/form-data">
                    <input type="hidden" value="" id="idUploadFoto" name="idUpload">
                    <img src="" id="fotoMenu" style="width:50%">
                    <br>
                    <br>
                    <div class='alert alert-danger mt-2 d-none' id="err_file"></div>
                    <div class="alert displaynone" id="responseMsg"></div>
                    <input type="file" id="uploadFotoMenu" class="form-control" name="uploadFotomenu" value="Pilih foto" accept="image/*" onchange="ubahFoto(event)">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="upload()" class="btn btn-info">Upload</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
    function tryUpload(id, nama, foto) {
        $("#idUploadFoto").val(id)

        $("#fotoMenu").attr('src', '<?= base_url() . "/public/img/" ?>' + foto + "?=" + new Date().getTime())
        $("#namaUploadFoto").html(nama)
        $("#modalUpload").modal("show")
    }

    function upload() {
        var files = $('#uploadFotoMenu')[0].files;

        if (files.length > 0) {
            var fd = new FormData();
            fd.append('file', files[0]);
            fd.append('nama', $("#namaUploadFoto").html());
            fd.append('id', $("#idUploadFoto").val());

            $('#responseMsg').hide();

            $.ajax({
                url: '<?= base_url() ?>/wisata/upload',
                method: 'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    $('#err_file').removeClass('d-block');
                    $('#err_file').addClass('d-none');

                    if (response.success == 1) {
                        $('#responseMsg').removeClass("alert-danger");
                        $('#responseMsg').addClass("alert-success");
                        $('#responseMsg').html(response.message);
                        $('#responseMsg').show();

                        $('#responseMsg').hide();
                        $('#uploadFotoMenu').val("")

                        location.reload()
                    } else if (response.success == 2) {
                        $('#responseMsg').removeClass("alert-success");
                        $('#responseMsg').addClass("alert-danger");
                        $('#responseMsg').html(response.message);
                        $('#responseMsg').show();
                    } else {
                        $('#err_file').text(response.message);
                        $('#err_file').removeClass('d-none');
                        $('#err_file').addClass('d-block');
                    }
                },
                error: function(response) {
                    console.log("error : " + JSON.stringify(response));
                }
            });
        } else {
            $('#responseMsg').removeClass("alert-success");
            $('#responseMsg').addClass("alert-danger");
            $('#responseMsg').html("Pilih foto dulu ya.");
            $('#responseMsg').show();
        }
    }

    function ubahFoto(event) {
        $("#fotoMenu").attr("src", URL.createObjectURL(event.target.files[0]))
    }

    function detail(id, nama, deskripsi) {
        $("#modalDetail").modal("show")
        $("#namaWisata").html(nama)
        $("#deskripsiWisata").html(deskripsi)

        $.ajax({
            url: '<?= base_url() ?>/pengunjung/muatData',
            method: 'post',
            data: "id=" + id,
            dataType: 'json',
            success: function(data) {
                var tabel = ''
                for (let i = 0; i < data.length; i++) {
                    tabel += "<tr><td>" + (i + 1) + "</td><td>" + getHari(data[i].tanggal) + "</td><td>" + data[i].tanggal + "</td><td>" + data[i].jumlah + "</td>"

                }
                if (!tabel) {
                    tabel = '<td class="text-center" colspan="2">Data Masih kosong :)</td>'
                }
                $("#tabelPengunjung").html(tabel)
            }
        });
    }

    function tryTambah() {
        $("#judulModal").html("Tambah Data")
        $("#nama").val("");
        $("#alamat").val("");
        $("#latitude").val("");
        $("#longitude").val("");
        $("#deskripsi").val("");
        $("#tambah").html("Tambah")
        $("#modalTambah").modal("show")
        $("#tambah").attr("onclick", "tambah()")
    }

    function tambah() {
        if ($("#nama").val() == "") {
            $("#nama").focus();
        } else if ($("#alamat").val() == "") {
            $("#alamat").focus();
        } else if ($("#latitude").val() == "") {
            $("#latitude").focus();
        } else if ($("#longitude").val() == "") {
            $("#longitude").focus();
        } else if ($("#deskripsi").val() == "") {
            $("#deskripsi").focus();
        } else {
            $.ajax({
                type: 'POST',
                data: 'nama=' + $("#nama").val() + '&alamat=' + $("#alamat").val() + '&latitude=' + $("#latitude").val() + '&longitude=' + $("#longitude").val() + '&deskripsi=' + $("#deskripsi").val(),
                url: '<?= base_url() ?>/wisata/tambah',
                dataType: 'json',
                success: function(data) {
                    $("#nama").val("");
                    $("#alamat").val("");
                    $("#latitude").val("");
                    $("#longitude").val("");
                    $("#deskripsi").val("");
                    location.reload();
                }
            });
        }
    }

    function tryEdit(id, nama, alamat, latitude, longitude, deskripsi) {
        $("#judulModal").html("Edit data : " + nama)
        $("#id").val(id);
        $("#nama").val(nama);
        $("#alamat").val(alamat);
        $("#latitude").val(latitude);
        $("#longitude").val(longitude);
        $("#deskripsi").val(deskripsi);
        $("#tambah").html("Edit")
        $("#tambah").attr("onclick", "edit()")

        $("#modalTambah").modal("show")
    }

    function edit() {
        if ($("#nama").val() == "") {
            $("#nama").focus();
        } else if ($("#alamat").val() == "") {
            $("#alamat").focus();
        } else if ($("#latitude").val() == "") {
            $("#latitude").focus();
        } else if ($("#longitude").val() == "") {
            $("#longitude").focus();
        } else if ($("#deskripsi").val() == "") {
            $("#deskripsi").focus();
        } else {
            $.ajax({
                type: 'POST',
                data: 'id=' + $("#id").val() + '&nama=' + $("#nama").val() + '&alamat=' + $("#alamat").val() + '&latitude=' + $("#latitude").val() + '&longitude=' + $("#longitude").val() + '&deskripsi=' + $("#deskripsi").val(),
                url: '<?= base_url() ?>/wisata/edit',
                dataType: 'json',
                success: function(data) {
                    $("#nama").val("");
                    $("#alamat").val("");
                    $("#latitude").val("");
                    $("#longitude").val("");
                    $("#deskripsi").val("");

                    $("#modalTambah").modal("show")
                    location.reload();
                }
            });
        }
    }

    function getHari(tanggal) {
        days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu']
        const d = new Date(tanggal);
        return days[d.getDay()];
    }

    function tryHapus(id, nama) {
        $("#idHapus").val(id)
        $("#detailHapus").html(nama + " (" + id + ") ")
        $("#modalHapus").modal('show')
    }

    function hapus() {
        $("#hapus").html('<i class="fa fa-spinner fa-pulse"></i> Memproses..')
        var id = $("#idHapus").val()
        $.ajax({
            url: '<?= base_url() ?>/wisata/hapus',
            method: 'post',
            data: "id=" + id,
            dataType: 'json',
            success: function(data) {
                $("#idHapus").val("")
                $("#detailHapus").html("")
                $("#modalHapus").modal('hide')
                $("#hapus").html('Hapus')

                location.reload();
            }
        });
    }
</script>
<?php $this->endSection() ?>