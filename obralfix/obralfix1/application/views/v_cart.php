<!DOCTYPE html>
<html>
<head>
	<title>Shopping cart dengan codeigniter dan AJAX</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/css/bootstrap.css'?>">
</head>
<body>
<div class="container"><br/>
	<h2>Shopping Cart Dengan Ajax dan Codeigniter</h2>
	<hr/>
	<div class="row">
		<div class="col-md-8">
			<h4>Produk</h4>
			<div class="row">
			<?php foreach ($data as $row) : ?>
				<div class="col-md-4">
					<div class="thumbnail">
						<img width="200" src="">
						<div class="caption">
							<h4><?php echo $row->title;?></h4>
							<div class="row">
								<div class="col-md-7">
									<h4><?php echo 'Rp '.number_format($row->price);?></h4>
								</div>
								<div class="col-md-5">
									<input type="number" name="quantity" id="<?php echo $row->for_id;?>" value="1" class="quantity form-control">
								</div>
							</div>
							<button class="add_cart btn btn-success btn-block" data-produkid="<?php echo $row->for_id;?>" data-produknama="<?php echo $row->title;?>" data-produkharga="<?php echo $row->price;?>">Add To Cart</button>
						</div>
					</div>
				</div>
			<?php endforeach;?>
				
			</div>

		</div>
		<div class="col-md-4">
			<h4>Shopping Cart</h4>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Produk</th>
						<th>Harga</th>
						<th>Qty</th>
						<th>Subtotal</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody id="detail_cart">

				</tbody>

			</table>
		</div>
	</div>
</div>



</body>
</html>