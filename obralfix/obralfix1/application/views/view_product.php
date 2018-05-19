<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="product.html" class="stext-109 cl8 hov-cl1 trans-04">
                Shop
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Maybe Lash
            </span>
        </div>
    </div>
        
<div class="container" id="view-product">
    <div class="row top-part">
        <div class="col-sm-4">
            <div <?= $product['folder'] != null ? 'style="margin-bottom:20px;"' : '' ?>>
                <img src="<?= base_url('/attachments/shop_images/' . $product['image']) ?>" style="width:auto; height:auto;" data-num="0" class="other-img-preview img-responsive img-thumbnail img-sl the-image" alt="<?= str_replace('"', "'", $product['title']) ?>">
            </div>
            <?php
            if ($product['folder'] != null) {
                $dir = "attachments/shop_images/" . $product['folder'] . '/';
                ?>
                <div class="row">
                    <?php
                    if (is_dir($dir)) {
                        if ($dh = opendir($dir)) {
                            $i = 1;
                            while (($file = readdir($dh)) !== false) {
                                if (is_file($dir . $file)) {
                                    ?>
                                    <div class="col-xs-4 col-sm-6 col-md-4 text-center">
                                        <img src="<?= base_url($dir . $file) ?>" data-num="<?= $i ?>" class="other-img-preview img-sl img-thumbnail the-image" alt="<?= str_replace('"', "'", $product['title']) ?>">
                                    </div>
                                    <?php
                                    $i++;
                                }
                            }
                            closedir($dh);
                        }
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
            <div class="col-md-6 col-lg-5 p-b-30">
                        <div class="p-r-50 p-t-5 p-lr-0-lg">
                            <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                                <?= $product['title'] ?>
                            </h4>

                            <span class="mtext-106 cl2">
                                <?= $product['price'] ?>              
                            </span>
                                            <?php if ($product['old_price'] != '') { ?>
                    <div class="row row-info">
                        <div class="col-sm-6"><b><?= lang('old_price') ?>:</b></div>
                        <div class="col-sm-6"><?= $product['old_price']?></div>
                        <div class="col-sm-12 border-bottom"></div>
                    </div>
                    <div class="row row-info">
                        <div class="col-sm-6">
                            <b><?= lang('in_stock') ?>:</b>
                        </div>
                        <div class="col-sm-6"><?= $product['quantity'] ?></div>
                        <div class="col-sm-12 border-bottom"></div>
                    </div>
                <?php } ?>
                <div class="row row-info">
                    <div class="col-sm-6"><b><?=('num_added_to_cart') ?>:</b></div>
                    <div class="col-sm-6"><?php
                        @$result = array_count_values($_SESSION['shopping_cart']);
                        if (isset($result[$product['id']]))
                            echo $result[$product['id']];
                        else
                            echo 0;
                        ?></div>
                    <div class="col-sm-12 border-bottom"></div>
                </div>

                    <div class="row row-info">
                        <div class="col-sm-6"><b><?=('added_on') ?>:</b></div>
                        <div class="col-sm-6"><?= date('m.d.Y', $product['time']) ?></div>
                        <div class="col-sm-12 border-bottom"></div>
                    </div>

                <div class="row row-info">
                    <div class="col-sm-6"><b><?= ('in_category') ?>:</b></div>
                    <div class="col-sm-6">
                        <a href="javascript:void(0);" class="go-category btn-blue-round" data-categorie-id="<?= $product['shop_categorie'] ?>">
                            <?= $product['categorie_name'] ?>
                        </a>
                    </div>
                </div>
                    <p class="stext-102 cl3 p-t-23">
                                <div class="header">
                                 <span class="title"><?= ('description') ?></span>
                                 </div>
                                <?= $product['description'] ?>
                    </p>
                        <?php if ($product['quantity'] > 0) { ?>
                            <div>
                               <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">                               
                                <a href="javascript:void(0);" data-id="<?= $product['id'] ?>" data-goto="<?= '/checkout' ?>" class="add-to-cart">
                                   buy_now
                                </a></button>
                            </div>                        
                            <button class="add_cart_one_item flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail" data-produkid="<?php echo $product['id'];?>" data-produknama="<?php echo $product['title'];?>" data-produkharga="<?php echo $product['price'];?>">Add To Cart</button>
                        <?php } else { ?>
                            <div class="alert alert-info"><?= ('out_of_stock_product') ?></div>
                        <?php } ?>
                </div>
            </div>  
                





        <div id="caption"></div>
    </div>
</div>
<script src="<?= base_url('assets/js/image-preveiw.js') ?>"></script>


