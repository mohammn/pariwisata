<?php $this->extend('template') ?>

<?php $this->section('content') ?>

<div class="row">

    <div class="col-md-6 mt-2">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="h3 mb-2 text-gray-800">Data User</h1>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-responsive">
                    <thead class=" text-info">
                        <th>
                            ID
                        </th>
                        <th>
                            Nama
                        </th>
                        <th>
                            Username
                        </th>
                        <th>
                            Jabatan
                        </th>
                        <th>
                            Tindakan
                        </th>
                    </thead>
                    <tbody id="tabelUser">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6 mt-2">
        <div class="card  shadow">
            <div class="card-header">
                <h4 class="card-title" id="judulTambah">Tambah User</h4>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group row">
                        <input type="hidden" id="id" name="id">
                        <label for="inputEmail3" class="col-lg-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama" name="nama" onchange="updateUsername()">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-lg-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="username" name="username" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-lg-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-lg-3 col-form-label">Wisata</label>
                        <div class="col-lg-9">
                            <select name="wisata" id="wisata" class="form-control">

                            </select>
                            <input type="hidden" name="wisataLama" id="wisataLama">
                        </div>
                    </div>
                </form>
                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <button class="btn btn-info" onclick="tambah()" id="tambah">Tambah</button>
                        <button type="button" class="btn btn-secondary" id="batal" onclick="batalEdit()">Batal</button>
                    </div>
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
            </div>
            <div class="modal-footer">
                <button type="button" id="hapus" onclick="hapus()" class="btn btn-info">Hapus</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>


<script>
    muatData()
    $("#batal").hide()

    function muatData() {
        $("#tambah").html('<i class="fa fa-spinner fa-pulse"></i> Memproses...')
        muatWisata()
        $.ajax({
            url: '<?= base_url() ?>/user/muatData',
            method: 'post',
            dataType: 'json',
            success: function(data) {
                var tabel = ''
                for (let i = 0; i < data.length; i++) {
                    tabel += "<tr><td>" + data[i].id + "</td><td>" + data[i].nama + "</td><td>" + data[i].username + "</td><td>"
                    if (data[i].rule == 1) {
                        tabel += "Admin"
                    } else {
                        tabel += "Karyawan"
                    }
                    tabel += "</td><td><a href='#' class='text-info' id='hapus" + data[i].id + "' onclick='tryHapus(" + data[i].id + ", \"" + data[i].nama + "\")' ><i class='fa fa-trash'></i></a> <a href='#' class='text-info' id='edit" + data[i].id + "' onclick='tryEdit(" + data[i].id + ")' ><i class='fa fa-edit'></i></a></td></tr>"

                }
                if (!tabel) {
                    tabel = '<td class="text-center" colspan="2">Data Masih kosong :)</td>'
                }
                $("#tabelUser").html(tabel)

                $("#tambah").html('Tambah')
            }
        });
    }

    function tambah() {
        if ($("#nama").val() == "") {
            $("#nama").focus();
        } else if ($("#password").val() == "") {
            $("#password").focus();
        } else if ($("#wisata").val() == null) {
            $("#wisata").focus();
        } else {
            $.ajax({
                type: 'POST',
                data: 'nama=' + $("#nama").val() + '&password=' + $("#password").val() + '&username=' + $("#nama").val().split(" ")[0] + '&wisata=' + $("#wisata").val(),
                url: '<?= base_url() ?>/user/tambah',
                dataType: 'json',
                success: function(data) {
                    console.log(data)
                    $("#nama").val("");
                    $("#password").val("");
                    $("#wisata").val(0);
                    $("#username").val("");
                    muatData();
                }
            });
        }
    }

    function updateUsername() {
        if ($("#nama").val() != "") {
            $("#username").val($("#nama").val().split(" ")[0] + " (ditambah id)")
        } else {
            $("#username").val("")
        }
    }

    function tryEdit(id) {
        muatWisata(id)
        $.ajax({
            url: '<?= base_url() ?>/user/detail',
            method: 'post',
            data: "id=" + id,
            dataType: 'json',
            success: function(data) {
                console.log(data)
                $("#judulTambah").html("Edit Data : " + data.nama)
                $("#tambah").html("Edit");
                $("#tambah").attr("onclick", "edit()")
                $("#batal").show();

                $("#id").val(data.id);
                $("#nama").val(data.nama);
                $("#wisata").val(data.wisata);
                $("#wisataLama").val(data.wisata);
                $("#username").val(data.username);
            }
        });
    }

    function batalEdit() {
        muatWisata()
        $("#judulTambah").html("Tambah Data")
        $("#tambah").html("Tambah");
        $("#tambah").attr("onclick", "tambah()")
        $("#batal").hide();

        $("#id").val("");
        $("#nama").val("");
        $("#wisata").val(0);
        $("#username").val("");
    }

    function edit() {
        if ($("#nama").val() == "") {
            $("#nama").focus();
        } else {
            $.ajax({
                type: 'POST',
                data: 'id=' + $("#id").val() + '&nama=' + $("#nama").val() + '&password=' + $("#password").val() + '&username=' + $("#nama").val().split(" ")[0] + $("#id").val() + '&wisata=' + $("#wisata").val() + '&wisataLama=' + $("#wisataLama").val(),
                url: '<?= base_url() ?>/user/edit',
                dataType: 'json',
                success: function(data) {
                    $("#nama").val("");
                    $("#password").val("");
                    $("#wisata").val(0);
                    $("#username").val("");
                    muatData();
                    batalEdit()
                }
            });
        }
    }

    function tryHapus(id, nama) {
        $("#idHapus").val(id)
        $("#detailHapus").html(nama + " (" + id + ") ")
        $("#modalHapus").modal('show')
    }

    function tutupModal() {
        $("#modalHapus").modal('hide')
    }

    function hapus() {
        $("#hapus").html('<i class="fa fa-spinner fa-pulse"></i> Memproses..')
        var id = $("#idHapus").val()
        $.ajax({
            url: '<?= base_url() ?>/user/hapus',
            method: 'post',
            data: "id=" + id,
            dataType: 'json',
            success: function(data) {
                $("#idHapus").val("")
                $("#detailHapus").html("")
                $("#modalHapus").modal('hide')
                $("#hapus").html('Hapus')
                muatData()
                tutupModal()
            }
        });
    }

    function muatWisata(kecuali = 0) {
        $.ajax({
            url: '<?= base_url() ?>/user/wisataKosong',
            method: 'post',
            data: "kecuali=" + kecuali,
            dataType: 'json',
            success: function(data) {
                var pilihan = '<option disabled selected value = "0" > --Pilih Wisata-- </option>';
                for (let i = 0; i < data.length; i++) {
                    pilihan += '<option value="' + data[i].id + '">' + data[i].nama + '</option>'
                }
                $("#wisata").html(pilihan)
            }
        });

    }
</script>
<?php $this->endSection() ?>