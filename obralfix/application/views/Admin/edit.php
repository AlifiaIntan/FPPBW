<?php
$timeNow = time();  ?>  
         <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Profile page</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <a href="https://wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Upgrade to Pro</a>
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Profile Page</li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                
                <div class="row">
                    <div >
                        <div class="white-box">
                            <form method="POST" class="form-horizontal form-material" action="<?= base_url('Admin/update').'/'.$product['id'] ?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-md-12">Tittle</label>
                                    <div class="col-md-12">
                                        <input type="text" name="tittle" placeholder="your product tittle" class="form-control form-control-line" value="<?php echo $product['tittle']?>"> </div>
                                    </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Basic Description</label>
                                    <div class="col-md-12">
                                        <input type="text" value='<?php echo $product['basic_description']?>' name="basic" placeholder="Short description" class="form-control form-control-line" > </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Description</label>
                                    <div class="col-md-12">
                                        <textarea rows="5" value='<?php echo $product['description']?>' name="description" class="form-control form-control-line"></textarea>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Price</label>
                                    <div class="col-md-12">
                                        <input type="text" value='<?php echo $product['price']?>' name="price" placeholder="123 456 7890" class="form-control form-control-line"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Discount</label>
                                    <div class="col-md-12">
                                        <input type="text" value='<?php echo $product['discount']?>' name="discount" placeholder="123 456 7890" class="form-control form-control-line"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">quantity</label>
                                    <div class="col-md-12">
                                        <input type="text"  value='<?php echo $product['quantity']?>' name="quantity" placeholder="123 456 7890" class="form-control form-control-line"> </div>
                                </div>
                                <div class="form-group ">
                                <div class="col-md-12">

                                <label>In Slider</label>
                                <select class="selectpicker" value='<?php echo $product['in_slider']?>' name="in_slider">
                                <option value="1" <?= isset($_POST['in_slider']) && $_POST['in_slider'] == 1 ? 'selected' : '' ?>>Yes</option>
                                <option value="0" <?= isset($_POST['in_slider']) && $_POST['in_slider'] == 0 || !isset($_POST['in_slider']) ? 'selected' : '' ?>>No</option>
                                </select>
                                    </div>
                                
                                </div>
                                
                                <div class="form-group">
                                <div class="col-sm-12">
                                <?php
                                if (isset($_POST['image']) && $_POST['image'] != null) {
                                    $image = 'attachments/shop_images/' . $_POST['image'];
                                    if (!file_exists($image)) {
                                        $image = 'attachments/no-image.png';
                                    }
                                    ?>
                                    <p>Current image:</p>
                                    <div>
                                        <img src="<?= base_url($image) ?>" class="img-responsive img-thumbnail" style="max-width:300px; margin-bottom: 5px;">
                                    </div>
                                    <input type="hidden" name="old_image" value="<?= $_POST['image'] ?>">
                                    <?php if (isset($_GET['to_lang'])) { ?>
                                        <input type="hidden" name="image" value="<?= $_POST['image'] ?>">
                                        <?php
                                    }
                                }

                                ?>
                                <img src="<?= base_url('attachments/shop_images/' . $product['image']) ?>">

                                <label for="userfile">Cover Image</label>
                                <input type="file" id="userfile" name="userfile">
                                </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <?= $otherImgs ?>
                                    </div>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modalMoreImages" class="btn btn-default">Upload more images</a>
                                </div>
                                <input type="hidden" value="<?= isset($_POST['folder']) ? $_POST['folder'] : $timeNow ?>" name="folder">


                              <div class="modal fade" id="modalMoreImages" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Upload more images</h4>
                                        </div>
                                        <div class="modal-body">
                                                <label for="others">Select images</label>
                                                <input type="file" name="others[]" id="others" multiple />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default finish-upload"  data-dismiss="modal" aria-label="Close">
                                                <span class="finish-text">Finish</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="submit" name="" class="btn btn-success" value=" Update Profile">
                                    </div>
                                </div>

                            </form>
                            </div>
                        </div>
                    </div>

                </div>

                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by wrappixel.com </footer>
        </div>
        <script type="text/javascript">
            function removeSecondaryProductImage(image, folder, container) {
            $.ajax({
                type: "POST",
                url: urls.removeSecondaryImage,
                data: {image: image, folder: folder}
            }).done(function (data) {
                $('#image-container-' + container).remove();
            });
        }
        $('.finish-upload').click(function () {
            $('.finish-upload .finish-text').hide();
            $('.finish-upload .loadUploadOthers').show();
            var someFormElement = document.getElementById('uploadImagesForm');
            var formData = new FormData(someFormElement);
            $.ajax({
                url: urls.uploadOthersImages,
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function (data)
                {
                    $('.finish-upload .finish-text').show();
                    $('.finish-upload .loadUploadOthers').hide();
                    reloadOthersImagesContainer();
                    $('#modalMoreImages').modal('hide');
                    document.getElementById("uploadImagesForm").reset();
                }
            });
        });
        function reloadOthersImagesContainer() {
        $('.others-images-container').empty();
        $('.others-images-container').load(urls.loadOthersImages, {"folder": $('[name="folder"]').val()});
        }
        </script>