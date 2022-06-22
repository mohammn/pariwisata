<?php $this->extend('template') ?>

<?php $this->section('content') ?>
<div class="container-fluid page-body-wrapper">
    <!-- partial -->
    <div class="main-panel" style="margin-left: auto; margin-right:auto;">
        <div class="content-wrapper text-center">
            <h2>Data Pengunjung "<?= $wisata["nama"] ?>"</h2>
            <hr>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow rounded" style="width: 18rem;">
                        <div class="card-body p-0">
                            <img src="<?= base_url() ?>/public/img/<?= $wisata["foto"] ?>" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                                <h5><?= $wisata["nama"] ?></h5>
                                <i><?= $wisata["alamat"] ?></i><br>
                                <i>latitude : <?= $wisata["latitude"] ?></i><br>
                                <i>longitude : <?= $wisata["longitude"] ?></i><br>
                                <i><?= $wisata["deskripsi"] ?></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 shadow p-3">
                    <input type="hidden" id="id" name="id">
                    Jumlah : <input type="number" id="jumlah" name="jumlah">
                    <input type="date" id="tanggal" name="tanggal">
                    <button class="btn btn-info" onclick="tambah()" id="tambah">Tambah</button>
                    <button type="button" class="btn btn-secondary" onclick="batalEdit()" id="batal">Batal</button>
                    <br><br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Hari</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody id="tabelPengunjung">

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>

<div class=" modal fade" id="modalHapus" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus User</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" id="idHapus" name="idHapus">
                <p>Apakah anda yakin ingin menghapus data pengunjung tanggal <b id="detailHapus">....</b> ?</p>

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

    function muatData() {
        $("#tambah").html('<i class="fa fa-spinner fa-pulse"></i> Memproses...')
        $.ajax({
            url: '<?= base_url() ?>/pengunjung/muatData',
            method: 'post',
            dataType: 'json',
            success: function(data) {
                var tabel = ''
                for (let i = 0; i < data.length; i++) {
                    tabel += "<tr><td>" + (i + 1) + "</td><td>" + getHari(data[i].tanggal) + "</td><td>" + data[i].tanggal + "</td><td>" + data[i].jumlah + "</td><td><a href='#' class='text-info' id='hapus" + data[i].id + "' onclick='tryHapus(" + data[i].id + ", \"" + data[i].jumlah + "\",\"" + data[i].tanggal + "\")' ><i class='fa fa-trash'></i></a> <a href='#' class='text-info' id='edit" + data[i].id + "' onclick='tryEdit(" + data[i].id + ", \"" + data[i].jumlah + "\",\"" + data[i].tanggal + "\")' ><i class='fa fa-edit'></i></a></td></tr>"

                }
                if (!tabel) {
                    tabel = '<td class="text-center" colspan="2">Data Masih kosong :)</td>'
                }
                $("#tabelPengunjung").html(tabel)

                $("#tambah").html('Tambah')
                $("#batal").hide()
            }
        });
    }

    function tambah() {
        if ($("#jumlah").val() == "") {
            $("#jumlah").focus();
        } else if ($("#tanggal").val() == "") {
            $("#tanggal").focus();
        } else {
            $("#tambah").html('<i class="fa fa-spinner fa-pulse"></i> Memproses...')
            $.ajax({
                type: 'POST',
                data: 'jumlah=' + $("#jumlah").val() + '&tanggal=' + $("#tanggal").val(),
                url: '<?= base_url() ?>/pengunjung/tambah',
                dataType: 'json',
                success: function(data) {
                    $("#jumlah").val("");
                    $("#tanggal").val("");
                    muatData()
                    $("#tambah").html('Tambah')
                }
            });
        }
    }

    function tryEdit(id, jumlah, tanggal) {
        $("#id").val(id);
        $("#jumlah").val(jumlah);
        $("#tanggal").val(tanggal);

        $("#tambah").html("Edit")
        $("#tambah").attr("onclick", "edit()")

        $("#batal").show()
    }

    function batalEdit() {
        $("#tambah").html("Tambah");
        $("#tambah").attr("onclick", "tambah()")

        $("#jumlah").val("");
        $("#tanggal").val("");
        $("#batal").hide()
    }

    function edit() {
        if ($("#jumlah").val() == "") {
            $("#jumlah").focus();
        } else if ($("#tanggal").val() == "") {
            $("#tanggal").focus();
        } else {
            $("#tambah").html('<i class="fa fa-spinner fa-pulse"></i> Memproses...')
            $.ajax({
                type: 'POST',
                data: 'jumlah=' + $("#jumlah").val() + '&tanggal=' + $("#tanggal").val() + '&id=' + $("#id").val(),
                url: '<?= base_url() ?>/pengunjung/edit',
                dataType: 'json',
                success: function(data) {
                    $("#id").val("");
                    $("#jumlah").val("");
                    $("#tanggal").val("");
                    muatData()
                    $("#tambah").html('Tambah')
                }
            });
        }
    }

    function tryHapus(id, jumlah, tanggal) {
        $("#idHapus").val(id)
        $("#detailHapus").html(tanggal + " (jumlah pengunjung : " + jumlah + ") ")
        $("#modalHapus").modal('show')
    }

    function hapus() {
        $("#hapus").html('<i class="fa fa-spinner fa-pulse"></i> Memproses..')
        var id = $("#idHapus").val()
        $.ajax({
            url: '<?= base_url() ?>/pengunjung/hapus',
            method: 'post',
            data: "id=" + id,
            dataType: 'json',
            success: function(data) {
                $("#idHapus").val("")
                $("#detailHapus").html("")
                $("#modalHapus").modal('hide')
                $("#hapus").html('Hapus')

                muatData()
            }
        });
    }

    function getHari(tanggal) {
        days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu']
        const d = new Date(tanggal);
        return days[d.getDay()];
    }
</script>
<?php $this->endSection() ?>