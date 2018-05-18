<?php

class M_admin extends CI_Model{


  public function getSliderProducts()
    {
        $this->db->where('visibility', 1);
        $this->db->where('in_slider', 1);
        $query = $this->db->get('products');
        return $query->result_array();
    }

    public function getNewProducts()
    {
        $this->db->where('products.in_slider', 0);
        $this->db->where('visibility', 1);
        $this->db->order_by('products.id', 'desc');
        $this->db->limit(5);
        $query = $this->db->get('products');
        return $query->result_array();
    }

    public function setToCart($post)
    {
        if (!is_numeric($post['article_id'])) {
            return false;
        }
        $query = $this->db->insert('shopping_cart', array(
            'session_id' => session_id(),
            'article_id' => $post['article_id'],
            'time' => time()
        ));
        return $query;
    }

    public function getShopItems($array_items)
    {
        $this->db->select('products.id, products.image, products.url, products.quantity, products_translations.price, products_translations.title');
        $this->db->from('products');
        if (count($array_items) > 1) {
            $i = 1;
            $where = '';
            foreach ($array_items as $id) {
                $i == 1 ? $open = '(' : $open = '';
                $i == count($array_items) ? $or = '' : $or = ' OR ';
                $where .= $open . 'products.id = ' . $id . $or;
                $i++;
            }
            $where .= ')';
            $this->db->where($where);
        } else {
            $this->db->where('products.id =', current($array_items));
        }
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'inner');
        $query = $this->db->get();
        return $query->result_array();
    }



    public function getOneProduct($id)
    {
        $this->db->where('products.id', $id);
        $this->db->where('visibility', 1);
        $query = $this->db->get('products');
        return $query->row_array();
    }


  public function sameCagegoryProducts($categorie, $noId, $vendor_id = false)
    {
        $this->db->where('products.id !=', $noId);
        $this->db->where('products.shop_categorie =', $categorie);
        $this->db->where('visibility', 1);
        $this->db->order_by('products.id', 'desc');
        $this->db->limit(5);
        $query = $this->db->get('products');
        return $query->result_array();
    }



    function tampil_data(){
    $query = $this->db->get('products');
    return $query->result_array();
    }

  function input_data($data,$table){
  $this->db->insert($table,$data);
  }

function hapus_data($where,$table){
  $this->db->where($where);
  $this->db->delete($table);
  }

function edit_data($where,$table){
  return $this->db->get_where($table,$where);
  }

function update_data($where,$data,$table){
  $this->db->where($where);
  $this->db->update($table,$data);
  }	

}
