<?php
namespace App;

class Cart
{
  public $items;
  public $totalQuantity;
  public $totalHarga;

  public function __construct($prevCart){
    if ($prevCart != null) {
        $this->items =$prevCart->items;
        $this->$totalQuantity = $prevCart->$totalQuantity;
        $this->$totalHarga = $prevCart->$totalHarga;
    }else {
      $this->items = [];
      $this->$totalQuantity = 0;
      $this->$totalHarga = 0;
    }
  }

  public function addItem($id, $produk)
  {
      $harga = (int) str_replace("Rp","", $produk->harga);

      if (array_key_exists($id, $this->items)) {
        $produkAdd = $this->items[$id];
        $produkAdd['quantity']++;
      }else {
        $produkAdd = ['quantity' => 1, 'harga' => $harga , 'data' => $produk];
      }

      $this->items[$id] = $produkAdd;
      $this->totalQuantity++;
      $this->totalHarga = $this->totalHarga + $harga;

  }
}
