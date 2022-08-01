</div>
<!-- End of Main Content -->
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-dark" href="<?= base_url('auth/logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/penjadwalan/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/penjadwalan/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/penjadwalan/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/penjadwalan/') ?>js/sb-admin-2.min.js"></script>

<!-- Check input -->
<script>
    $('.user-akses').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('user_access/changeAccess'); ?>",
            type: 'post',
            data: {
                roleId: roleId,
                menuId: menuId
            },
            success: function() {
                document.location.href = "<?= base_url('user_access'); ?>";
            }
        })
    });
    // $('.dosen-matkul').on('click', function() {
    //     const matkulId = $(this).data('matkul');
    //     const dosenId = $(this).data('dosen');

    //     $.ajax({
    //         url: "PHP base_url('manajemen_matkul/changeAccess'); ?>",
    //         type: 'post',
    //         data: {
    //             dosenId: dosenId,
    //             matkulId: matkulId
    //         },
    //         success: function() {
    //             document.location.href = "PHP base_url('manajemen_matkul'); ?>";
    //         }
    //     })
    // });
</script>
<!-- Datatable excel -->

<script src="<?= base_url('assets/penjadwalan/') ?>DataTables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?= base_url('assets/penjadwalan/') ?>DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?= base_url('assets/penjadwalan/') ?>DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?= base_url('assets/penjadwalan/') ?>DataTables/DataTables-1.10.24/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/penjadwalan/') ?>DataTables/DataTables-1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/penjadwalan/') ?>DataTables/Buttons-1.7.0/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/penjadwalan/') ?>DataTables/Buttons-1.7.0/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/penjadwalan/') ?>DataTables/Buttons-1.7.0/js/buttons.colVis.min.js"></script>
<script src="<?= base_url('assets/penjadwalan/') ?>DataTables/Buttons-1.7.0/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/penjadwalan/') ?>DataTables/Buttons-1.7.0/js/buttons.print.min.js"></script>
<!-- dataTable -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "lengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ]

        });
        var jadwaltable = $('#dataTableJadwalku').DataTable({
            buttons: ['copy', 'excel', 'pdf', 'colvis']
        });
        jadwaltable.buttons().container()
            .appendTo('#dataTableJadwalku_wrapper .col-md-6:eq(0)');

        $('#dataTablePengampu').DataTable({
            "lengthMenu": [
                [10, 25, -1],
                [10, 25, "All"]
            ]

        });
        $('#dataTableD_KartuAkses').DataTable({
            "lengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ]

        });
        $('#dataTablekelas').DataTable({
            "searching": false,
            "lengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ]

        });
        $('#dataTableAngkatan').DataTable({
            "searching": false,
            "lengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ]

        });
        $('#dataTablesemester').DataTable({
            "searching": false,
            "lengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ]

        });
        $('#dataTableprodi').DataTable({
            "searching": false,
            "lengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ]

        });
        $('#dataTableruangan').DataTable({
            "searching": false,
            "lengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ]

        });
        $('#dataTablerfid').DataTable({
            "searching": false,
            "lengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ]

        });
        $('#dataTablejurusan').DataTable({
            "searching": false,
            "lengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ]

        });
        $('#tabelmatkul').DataTable({
            "lengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ]

        });
    });
</script>

<!-- Penjadwalan -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#loading-div-background").css({
            opacity: 0.5
        });
        <?php if (isset($clear_text_box)) { ?>
            $('input[type=text]').each(function() {
                $(this).val('');
            });
        <?php } ?>
    });

    function ShowProgressAnimation() {
        $("#loading-div-background").show();
    }
</script>

<!-- endDatatable -->
<script src="<?= base_url() ?>assets/penjadwalan/js/sweetalert2.all.min.js"></script>
<script src="<?= base_url() ?>assets/penjadwalan/js/myscript.js"></script>

<!-- <script src="<?= base_url('assets/penjadwalan/') ?>vendor/datatables/jquery.dataTables.min.js"></script> -->
<!-- <script src="<?= base_url('assets/penjadwalan/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script> -->



<!-- Page level custom scripts -->
<!-- <script src="<?= base_url('assets/penjadwalan/') ?>js/demo/datatables-demo.js"></script> -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#t_jurusan_id').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?= base_url('data_mahasiswa/get_kelas') ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id_kelas + '>' + data[i].nama_kelas + '</option>';
                    }
                    $('#kelas_id').html(html);
                }
            });
            return false;
        });
        $('#p_matkul').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?= base_url('manajemen_matkul/get_dosen') ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id_dosen + '>' + data[i].nama_dosen + '</option>';
                    }
                    $('#p_dosen').html(html);
                }
            });
            return false;
        });

    });
</script>

</body>

</html>