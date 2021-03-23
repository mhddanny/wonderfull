<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Kategori;
use App\Produk;
use Validator;
use Storage;

class ShopController extends Controller
{
  public function index()
  {
    $produk = Produk::inRandomOrder()->get();
    $kategories = Kategori::with(['child'])->withCount(['child'])->getParent()->orderBy('kategori', 'ASC')->get();

     return view('web.shop', compact('produk', 'kategories'));
  }

  public function shop(Request $request)
  {
      $produk = Produk::all();
      $kategori = Kategori::all();
      // $filterkeyword = $request->get('keyword');
      // $nama_kategori = '';
      //
      // if($filterkeyword)
      // {
      //     //dijalankan jika ada pencarian
      //     $produk = Produk::where('nama_produk','LIKE',"%$filterkeyword%")->paginate(5);
      // }
      //
      // $filter_by_kategori = $request->get('kd_kategori');
      // if ($filter_by_kategori) {
      //    $produk = Produk::where('kd_kategori',$filter_by_kategori)->paginate(5);
      //
      //    $data_kategori = Kategori::find($filter_by_kategori);
      //    $nama_kategori = $data_kategori->kategori;
      // }

      return view('web.shop', compact('produk','kategori'));
  }

  public function cart()
  {
    return view('web.cart');
  }

  public function addcard($id)
  {
         // print_r($id);
        // $prevCart = $request->session()->get('cart');
        // $cart = new Cart($prevCart);
        // $cart->addItem($id, $produk);

        $produk = Produk::find($id);
        if (!$produk) {
            return view('web.404');
        }
        $cart = session()->get('cart');
        // dump($cart);

        if (!$cart) {

              $cart = [
                    $id => [
                      "kode"          => $produk->kode,
                      "name"          => $produk->nama_produk,
                      "quantity"      => 1,
                      "harga"         => $produk->harga,
                      "ket"           => $produk->ket,
                      "gambar_produk" => $produk->gambar_produk,
                    ]
              ];

            session()->put('cart', $cart);

            return redirect()->back()->with('status', 'Produk Berhasil ditambahkan');
        }
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('status', 'Produk Berhasil ditambahkan');
  }

  public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }


}
