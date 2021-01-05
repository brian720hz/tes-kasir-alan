<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/mystyle.css' ?>">
    <title>Alan Resto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/style.css' ?>">
</head>

<body style="background-color: #f0ebeb;">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #17aaff;">
        <a href="<?php echo site_url('Home') ?>" class="navbar-brand" href="#" style="margin-left: 5%;">
            <img src="<?php echo base_url() ?>assets/logo/logo.png" style="width: 80px; height: 60px;" class="d-inline-block align-top" alt="">
        </a>
        <a href="<?php echo site_url('Home') ?>" style="text-decoration: none;">
            <h4 style="color: white;">Alan Resto</h4>
        </a>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: white;">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="margin-left: 5%;">
            <li class="nav-item">
                <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" style="color: black; font-weight: bold;">Food</a>
            </li>
        </ul>
    </nav>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="container-fluid">
                <div class="row row_menu">
                    <div class="col-md-12">
                        <div class="card card_menu">
                            <div style="margin-left: 3%; margin-right: 3%; margin-top: 3%; margin-bottom: 3%;">
                                <div id="notifications"><?php echo $this->session->flashdata('pesan'); ?></div>
                                <h4 style="color: #17aaff;">Tambahkan Menu</h4><br>
                                <form action="<?php echo site_url('Home/Tambah_data_makanan') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Menu</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Masukan nama makanan">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Upload File</label>
                                        <div class="preview-zone hidden">
                                            <div class="box box-solid">
                                                <div class="box-header with-border">
                                                    <div><b>Preview</b></div>
                                                    <div class="box-tools pull-right">
                                                        <button type="button" class="btn btn-danger btn-xs remove-preview">
                                                            <i class="fa fa-times"></i> Reset
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="box-body"></div>
                                            </div>
                                        </div>
                                        <div class="dropzone-wrapper">
                                            <div class="dropzone-desc">
                                                <i class="glyphicon glyphicon-download-alt"></i>
                                                <div>Choose an image file or drag it here.</div>
                                            </div>
                                            <input type="file" name="foto" class="dropzone" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Harga Menu</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="background-color: #17aaff; color: white;">Rp</div>
                                            </div>
                                            <input type="number" name="harga" class="form-control" placeholder="Masukan harga makanan">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn" style="background-color: #2f9153; color: white; width: 10%; float: right;">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-3.2.1.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js' ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() . 'assets/js/app.js' ?>"></script>

<!-- <script>
    $('#ModalCharge').modal('show');
</script> -->

<script>
    $(document).ready(function() {
        $('#uang').change(function() {
            var uang = $('#uang').val();
            if (uang != '') {
                $.ajax({
                    url: "<?php echo base_url(); ?>Home/cek_kembalian",
                    method: "POST",
                    data: {
                        uang: uang
                    },
                    success: function(data) {
                        $('#uang_kembalian').html(data);
                    }
                });
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.add_cart').click(function() {
            var product_id = $(this).data("productid");
            var product_name = $(this).data("productname");
            var product_price = $(this).data("productprice");
            var foto = $(this).data("foto");
            var quantity = $('#' + product_id).val();
            $.ajax({
                url: "<?php echo site_url('Home/add_to_cart'); ?>",
                method: "POST",
                data: {
                    product_id: product_id,
                    product_name: product_name,
                    product_price: product_price,
                    foto: foto,
                    quantity: quantity
                },
                success: function(data) {
                    $('#detail_cart').html(data);
                }
            });
        });


        // Load shopping cart
        $('#detail_cart').load("<?php echo site_url('Home/load_cart'); ?>");

        //Hapus Item Cart
        $(document).on('click', '.romove_cart', function() {
            var row_id = $(this).attr("id");
            $.ajax({
                url: "<?php echo site_url('Home/delete_cart'); ?>",
                method: "POST",
                data: {
                    row_id: row_id
                },
                success: function(data) {
                    $('#detail_cart').html(data);
                }
            });
        });

        //Clear Item Cart
        $(document).on('click', '.clear_cart', function() {
            $.ajax({
                url: "<?php echo site_url('Home/clear_cart'); ?>",
                method: "POST",
                success: function(data) {
                    $('#detail_cart').html(data);
                }
            });
        });
    });
</script>

</html>