    <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Basic Table</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <a href="https://wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Upgrade to Pro

                        </a>
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Basic Table</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Basic Table</h3>
                            <p class="text-muted">Add class <code>.table</code></p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>image</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php
                                $i = 0;
                                foreach ($products as $product) {
                                ?>
                                        <tr>
                                            <td><?= $product['id'] ?></td>
                                            <td><?= $product['tittle'] ?></td>
                                            <td><img src="<?= base_url('attachments/shop_images/' . $product['image']) ?>" alt="No Image" class="img-thumbnail" style="height:100px;"></td>
                                            <td><?= $product['price'] ?></td>
                                            <td><?= $product['quantity'] ?></td>

                                        </tr>
                                        <?php
                                         }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

        <!-- /#page-wrapper -->