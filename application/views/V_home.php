<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/mystyle.css' ?>">
    <title>Alan Resto</title>
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
            <li class="nav-item">
                <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" style="color: black; font-weight: bold;">Transaksi</a>
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
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('Home/Tambah_data') ?>">
                                        <button type="button" class="btn" style="width: 100%; background-color: #17aaff; color: white;">+ Tambah Data</button>
                                    </a>
                                </div>
                                <br>
                                <table class="table table-striped" style="text-align: center;">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Foto</th>
                                        <th>Harga</th>
                                    </tr>
                                    <?php
                                    $no = 1;
                                    foreach ($makanan as $p) :
                                        $id_makanan = $p['id_makanan'];
                                        $nama = $p['nama'];
                                        $harga = $p['harga'];
                                        $foto = $p['foto'];
                                    ?>
                                        <tr>
                                            <td> <?php echo $no ?> </td>
                                            <td> <?php echo $nama ?> </td>
                                            <td> <img src="<?php echo base_url() ?>assets/img/<?php echo $foto; ?>" style="width: 50px; height: 50px;"></td>
                                            <td> <?php echo number_format($harga) ?> </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="container-fluid">
                <div class="row row_menu">
                    <div class="col-md-8">
                        <div class="row">
                            <?php
                            foreach ($makanan as $p) :
                                $id_makanan = $p['id_makanan'];
                                $nama = $p['nama'];
                                $harga = $p['harga'];
                                $foto = $p['foto'];
                            ?>
                                <div class="col-md-4">
                                    <div class="card card_menu">
                                        <img class="card-img-top" src="<?php echo base_url() ?>assets/img/<?php echo $foto; ?>" alt="Card image" style="height: 200px;">
                                        <div class="card-body">
                                            <center>
                                                <button class="add_cart btn bg-transparent" style="font-weight: bold;" data-productid="<?php echo $id_makanan; ?>" data-productname="<?php echo $nama; ?>" data-productprice="<?php echo $harga; ?>" data-foto="<?php echo $foto; ?>"><?php echo $nama; ?></button>
                                                <p class="card-text" style="color: #17aaff; font-weight: bold;">Rp. <?php echo number_format("$harga", 0, ",", "."); ?></p>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="quantity" id="<?php echo $id_makanan; ?>" value="1" class="quantity form-control">
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card col-md-4" style="margin-bottom: 2%;">
                        <div class="card-body">
                            <center>
                                <img src="<?php echo base_url() ?>assets/logo/foto_polos.png" style="width: 40px; height: 30px;" class="d-inline-block align-top" alt="">
                                <span style="font-size: 16pt; color: black; font-weight: bold;">Pesanan</span>
                                <br><br>
                            </center>
                            <table class="table">

                                <tbody id="detail_cart">

                                </tbody>

                            </table>
                        </div>
                    </div>

                    <!-- Modal Save Bill -->
                    <div id="SaveBill" class="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menyimpan pesanan ini?</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="<?php echo site_url('Home') ?>">
                                        <button type=" button" class="btn btn-primary">Ya</button>
                                    </a>
                                    <button type=" button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Print Bill -->
                    <div id="PrintBill" class="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin mencetak pesanan ini?</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="<?php echo site_url('Home/pdf') ?>">
                                        <button type=" button" class="btn btn-primary">Ya</button>
                                    </a>
                                    <button type=" button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Charge-->
                    <div class="modal fade bd-example-modal-lg" id="ModalCharge" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="modal-header">
                                            <center>
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                                                <span style="color: red;">*Apabila tidak muncul mohon direfresh</span>
                                            </center>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table  table-striped">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Foto</th>
                                                    <th>Harga</th>
                                                </tr>
                                                <?php
                                                $no = 1;
                                                foreach ($this->cart->contents() as $items) {
                                                ?>
                                                    <tr>
                                                        <td style="font-weight: bold;"> <?php echo $no ?> </td>
                                                        <td style="font-weight: bold;"> <?php echo $items['name']; ?> </td>
                                                        <td> <img src="<?php echo base_url() ?>assets/img/<?php echo $items['foto']; ?>" style="width: 100px; height: 100px;"></td>
                                                        <td style="font-weight: bold;"> <?php echo number_format($items['subtotal']) ?> </td>
                                                    </tr>

                                                <?php
                                                    $no++;
                                                } ?>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <center>
                                                <h4>Uang Pembeli</h4>
                                            </center>
                                            <div class="form-group">
                                                <input type="number" id="uang" name="uang" class="form-control" placeholder="Masukan uang pembeli">
                                            </div>
                                            <button type="button" class="btn" style="background-color: #f5f5f5; width: 48%;" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn" style="background-color: #17aaff; width: 48%; color: white;">Pay!</button>
                                            <br><br>
                                            <span id="uang_kembalian"></span>
                                        </div>
                                    </div>
                                </div>
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