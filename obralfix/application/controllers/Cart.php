<?php

class Cart extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('cart_model');
		$this->load->model('M_admin');
	}

	function index(){
		$data['data']=$this->cart_model->get_all_produk();	
		$this->load->view('header');
		$this->load->view('shopping_cart',$data);
		$this->load->view('footer');
	}

	function add_to_cart(){ //fungsi Add To Cart
		$data = array(
			'id' => $this->input->post('id'), 
			'name' => $this->input->post('tittle'), 
			'price' => $this->input->post('price'), 
			'qty' => $this->input->post('quantity'), 
			//cart sesion dari controller cart
		);

		$this->cart->insert($data);
		echo $this->show_cart(); //tampilkan cart setelah added
	}

	function show_cart(){ //Fungsi untuk menampilkan Cart
		$output = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			$output .='
				<tr>
					<td>'.$items['name'].'</td>
					<td>'.number_format($items['price']).'</td>
					<td>'.$items['qty'].'</td>
					<td>'.number_format($items['subtotal']).'</td>
					<td><button type="button" id="'.$items['rowid'].'" class="hapus_cart btn btn-danger btn-xs">Batal</button></td>
				</tr>
			';
		}
		$output .= '
			<tr>
				<th colspan="3">Total</th>
				<th colspan="2">'.'Rp '.number_format($this->cart->total()).'</th>
			</tr>
		';
		return $output;
	}

	function show_cart_sidebar(){ //Fungsi untuk menampilkan Cart
		$list = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			$list .= '<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="images/item-cart-01.jpg" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								'.$items['name'].'
							</a>

							<span class="header-cart-item-info">
								'.$items['qty'].' x rp'.number_format($items['price']).'
							</span>
						</div>
					</li>';
		}

		$output = '<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
					'.$list.'
				</ul>
				
				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						Total: $'.number_format($this->cart->total()).'
					</div>

					<div class="header-cart-buttons flex-w w-full">
						<a href="shoping-cart.html" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							View Cart
						</a>

						<a href="'.base_url().'cart/recordOrder'.'" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							Check Out
						</a>
					</div>
				</div>
			';
		
		echo $output;
	}


	function get_quantity(){ //Fungsi untuk menampilkan Cart
	
		$total = 0;
		foreach ($this->cart->contents() as $items) {
			$total += $items['qty'];
		}
		
		echo $total;
	}



	function show_notif(){ //Fungsi untuk menampilkan Cart
		$output = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			$output .='
				<tr>
					<td>'.$items['qty'].'</td>
					<td><button type="button" id="'.$items['rowid'].'" class="hapus_cart btn btn-danger btn-xs">Batal</button></td>
				</tr>
			';
		}
	}

	function load_cart(){ //load data cart
		echo $this->show_cart();
	}

	function load_notif(){ //load data cart
	echo $this->show_notif();
	}

	function hapus_cart(){ //fungsi untuk menghapus item cart
		$data = array(
			'rowid' => $this->input->post('row_id'), 
			'qty' => 0, 
		);
		$this->cart->update($data);
		echo $this->show_cart();
	}

	function recordOrder() {
		$items = $this->cart->contents();

		foreach ($items as $item) {
			$data = array(
	        'produk_id' => $item['id'],
	        'produk_nama' => $item['name'],
	        'produk_harga' => $item['price'],
	        'quantity' => $item['qty'],
	        'total' => $item['qty'] * $item['price'],
			);

			$item['qty'] = 0;

			$this->db->insert('tbl_produk', $data);
		}

		
	}

	function add(){
    $firstname = $this->input->post('firstname');
    $email = $this->input->post('email');
    $address = $this->input->post('address');
    $city = $this->input->post('city');
    $discount = $this->input->post('discount');
    $state = $this->input->post('state');
    $zip = $this->input->post('zip');
    $cardname = $this->input->post('cardname');

    $data = array(
            'penerima' => $firstname,
            'Email' => $email,
            'alamat' => $address,
      		'kota' => $city,
      		'provinsi' => $state,
      		'zip' => $zip,
      		'pembayar' => $cardname,

            );
	$this->db->insert('orders', $data);
	$idOrder = $this->db->insert_id();

	$items = $this->cart->contents();

	foreach ($items as $item) {
		$data = array(
        'produk_id' => $item['id'],
        'produk_nama' => $item['name'],
        'produk_harga' => $item['price'],
        'quantity' => $item['qty'],
        'total' => $item['qty'] * $item['price'],
        'order_id' => $idOrder
		);

		$item['qty'] = 0;

		$this->db->insert('tbl_produk', $data);
	}


$items = $this->cart->contents();

$this-> recordOrder();

}
}