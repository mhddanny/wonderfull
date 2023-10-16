<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Produk;
use App\Province;
use App\City;
use App\District;
use App\Customer;
use App\Order;
use App\OrderDetail;
use Illuminate\Support\Str;
use DB;
use App\Mail\CustomerRegisterMail;
use Mail;
use Cookie;
use GuzzleHttp\Client;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
      // dd($request);@rupiah
      //VALIDASI DATA YANG DIKIRIM
      $this->validate($request, [
          'kd_produk' => 'required|exists:produk', //PASTIKAN PRODUCT_IDNYA ADA DI DB
          'qty' => 'required|integer' //PASTIKAN QTY YANG DIKIRIM INTEGER
      ]);

      //AMBIL DATA CART DARI COOKIE, KARENA BENTUKNYA JSON MAKA KITA GUNAKAN JSON_DECODE UNTUK MENGUBAHNYA MENJADI ARRAY
      $carts = json_decode($request->cookie('wf-carts'), true);

      //CEK JIKA CARTS TIDAK NULL DAN PRODUCT_ID ADA DIDALAM ARRAY CARTS
      if ($carts && array_key_exists($request->kd_produk, $carts)) {
          //MAKA UPDATE QTY-NYA BERDASARKAN PRODUCT_ID YANG DIJADIKAN KEY ARRAY
          $carts[$request->kd_produk]['qty'] += $request->qty;
      } else {
          //SELAIN ITU, BUAT QUERY UNTUK MENGAMBIL PRODUK BERDASARKAN PRODUCT_ID
          $produk = Produk::find($request->kd_produk);
          //TAMBAHKAN DATA BARU DENGAN MENJADIKAN PRODUCT_ID SEBAGAI KEY DARI ARRAY CARTS
          $carts[$request->kd_produk] = [
              'qty' => $request->qty,
              'kd_produk' => $produk->kd_produk,
              'kode' => $produk->kode,
              'nama_produk' => $produk->nama_produk,
              'harga' => $produk->harga,
              'gambar_produk' => $produk->gambar_produk,
              'weight' => $produk->weight
          ];
      }

      //BUAT COOKIE-NYA DENGAN NAME WF-CARTS
      //JANGAN LUPA UNTUK DI-ENCODE KEMBALI, DAN LIMITNYA 2800 MENIT ATAU 48 JAM
      $cookie = cookie('wf-carts', json_encode($carts), 1440);
      //STORE KE BROWSER UNTUK DISIMPAN
      return redirect()->back()->cookie($cookie)->with('status', 'Produk Berhasil di Masukan ke dalam Keranjang');

    }

    public function listCart()
    {
        //MENGAMBIL DATA DARI COOKIE
        $carts = json_decode(request()->cookie('wf-carts'), true);
        //UBAH ARRAY MENJADI COLLECTION, KEMUDIAN GUNAKAN METHOD SUM UNTUK MENGHITUNG SUBTOTAL

        // dd($carts);
        $subtotal = collect($carts)->sum(function($q) {
            return $q['qty'] * $q['harga']; //SUBTOTAL TERDIRI DARI QTY * harga
        });
        //LOAD VIEW CART.BLADE.PHP DAN PASSING DATA CARTS DAN SUBTOTAL
        return view('WF_Collection.card', compact('carts', 'subtotal'));
    }

    public function updateCart(Request $request)
    {

        //AMBIL DATA DARI COOKIE
        $carts = json_decode(request()->cookie('wf-carts'), true);
        //KEMUDIAN LOOPING DATA PRODUCT_ID, KARENA NAMENYA ARRAY PADA VIEW SEBELUMNYA
        //MAKA DATA YANG DITERIMA ADALAH ARRAY SEHINGGA BISA DI-LOOPING
        // dd($carts);
        foreach ($request->kd_produk as $key => $row) {
            //DI CHECK, JIKA QTY DENGAN KEY YANG SAMA DENGAN PRODUCT_ID = 0
            if ($request->qty[$key] == 0) {
                //MAKA DATA TERSEBUT DIHAPUS DARI ARRAY
                unset($carts[$row]);
            } else {
                //SELAIN ITU MAKA AKAN DIPERBAHARUI
                $carts[$row]['qty'] = $request->qty[$key];
            }
        }

        //SET KEMBALI COOKIE-NYA SEPERTI SEBELUMNYA
        $cookie = cookie('wf-carts', json_encode($carts), 1440);
        //DAN STORE KE BROWSER.
       // dd($cookie);
        return redirect()->back()->cookie($cookie);
    }

    public function remove(Request $request)
    {
      //AMBIL DATA DARI COOKIE
      $carts = json_decode(request()->cookie('wf-carts'), true);
      // dd($carts);
      //DI CEK CARTS SESUAI ID
      if ($request->id) {
        //TANGAKAP CART SESUAI ID PRODUK YANG INGIN DI HAPUS
        //
        if(isset($carts[$request->id])) {
            unset($carts[$request->id]);
            session()->put('carts', $carts);
        }

        //SET KEMBALI COOKIE-NYA SEPERTI SEBELUMNYA
        $cookie = cookie('wf-carts', json_encode($carts), 1440);
        //DAN STORE KE BROWSER.
        return redirect()->back()->cookie($cookie);
      }
    }

    private function getCarts()
    {
        $carts = json_decode(request()->cookie('wf-carts'), true);
        $carts = $carts != '' ? $carts:[];
        return $carts;
    }

    public function checkout()
    {
      // return 'ok';
        //QUERY UNTUK MENGAMBIL SEMUA DATA PROPINSI
        $provinces = Province::orderBy('created_at', 'DESC')->get();
        $carts = $this->getCarts(); //MENGAMBIL DATA CART
        //MENGHITUNG SUBTOTAL DARI KERANJANG BELANJA (CART)
        $subtotal = collect($carts)->sum(function($q) {
            return $q['qty'] * $q['harga'];
        });
        $weight = collect($carts)->sum(function($q) {
        return $q['qty'] * $q['weight'];
        });
        //ME-LOAD VIEW CHECKOUT.BLADE.PHP DAN PASSING DATA PROVINCES, CARTS DAN SUBTOTAL
        return view('WF_Collection.checkout', compact('provinces', 'carts', 'subtotal', 'weight'));
    }

    public function getCity()
    {
        //QUERY UNTUK MENGAMBIL DATA KOTA / KABUPATEN BERDASARKAN PROVINCE_ID
        $cities = City::where('province_id', request()->province_id)->get();
        //KEMBALIKAN DATANYA DALAM BENTUK JSON
        return response()->json(['status' => 'success', 'data' => $cities]);
    }

    public function getDistrict()
    {
        //QUERY UNTUK MENGAMBIL DATA KECAMATAN BERDASARKAN CITY_ID
        $districts = District::where('city_id', request()->city_id)->get();
        //KEMUDIAN KEMBALIKAN DATANYA DALAM BENTUK JSON
        return response()->json(['status' => 'success', 'data' => $districts]);
    }

    public function processCheckout(Request $request)
    {
         // dd($request);
        //VALIDASI DATANYA
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'nohp' => 'required|max:12|unique:customers',
            'ktp' => 'required',
            'alamat' => 'required|string',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'district_id' => 'required|exists:districts,id',
            'courier' => 'required'
            ]);

    //INISIASI DATABASE TRANSACTION
    //DATABASE TRANSACTION BERFUNGSI UNTUK MEMASTIKAN SEMUA PROSES SUKSES UNTUK KEMUDIAN DI COMMIT AGAR DATA BENAR BENAR DISIMPAN, JIKA TERJADI ERROR MAKA KITA ROLLBACK AGAR DATANYA SELARAS
    DB::beginTransaction();
    try {
      //GET COOKIE DARI BROWSER
        $affiliate = json_decode(request()->cookie('wf-afiliasi'), true);
          //EXPLODE DATA COOKIE UNTUK MEMISAHKAN USERID DAN PRODUCTID
        $explodeAffiliate = explode('-', $affiliate);

        //CHECK DATA CUSTOMER BERDASARKAN EMAIL
        $customer = Customer::where('email', $request->email)->first();
        //JIKA DIA TIDAK LOGIN DAN DATA CUSTOMERNYA ADA
        if (!auth()->guard('customer')->check() && $customer) {
            //MAKA REDIRECT DAN TAMPILKAN INSTRUKSI UNTUK LOGIN
            return redirect()->back()->with(['error' => 'Email Sudah Terdaftar, Silahkan Login Terlebih Dahulu . . . !']);
        }

        //AMBIL DATA KERANJANG
        $carts = $this->getCarts();
        //HITUNG SUBTOTAL BELANJAAN
        $subtotal = collect($carts)->sum(function($q) {
            return $q['qty'] * $q['harga'];
        });


        if (!auth()->guard('customer')->check()) {
          //SIMPAN DATA CUSTOMER BARU
          $password = Str::random(8);
          $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'ktp' => $request->ktp,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'district_id' => $request->district_id,
            'activate_token' => Str::random(30),
            'is_aktif' => false
          ]);
        }

        //SIMPAN DATA ORDER
        $shipping = explode('-', $request->courier);
        $order = Order::create([
            'invoice' => Str::random(4) . '-' . time(), //INVOICENYA KITA BUAT DARI STRING RANDOM DAN WAKTU
            'customer_id' => $customer->id,
            'customer_name' => $customer->name,
            'customer_nohp' => $request->nohp,
            'customer_alamat' => $request->alamat,
            'district_id' => $request->district_id,
            'subtotal' => $subtotal,
            'cost' => $shipping[2], //SIMPAN INFORMASI BIAYA ONGKIRNYA PADA INDEX 2
            'shipping' => $shipping[0] . '-' . $shipping[1], //SIMPAN NAMA KURIR DAN SERVICE YANG DIGUNAKAN
            'ref' => $affiliate != '' && $explodeAffiliate[0] != auth()->guard('customer')->user() ? $affiliate:NULL
        ]);

        //LOOPING DATA DI CARTS
        foreach ($carts as $row) {
            //AMBIL DATA PRODUK BERDASARKAN PRODUCT_ID
            $produk = Produk::find($row['kd_produk']);
            //SIMPAN DETAIL ORDER
            OrderDetail::create([
                'order_id' => $order->id,
                'kd_produk' => $row['kd_produk'],
                'price' => $row['harga'],
                'qty' => $row['qty'],
                'weight' => $produk->weight
            ]);
        }

        //TIDAK TERJADI ERROR, MAKA COMMIT DATANYA UNTUK MENINFORMASIKAN BAHWA DATA SUDAH FIX UNTUK DISIMPAN
        DB::commit();

        $carts = [];
        //KOSONGKAN DATA KERANJANG DI COOKIE
        $cookie = cookie('wf-carts', json_encode($carts), 1440);
        Cookie::queue(Cookie::forget('wf-afiliasi'));

        if (!auth()->guard('customer')->check()) {
          // code...
          Mail::to($request->email)->send(new CustomerRegisterMail($customer, $password)); //TAMBAHKAN CODE INI SAJA
        }

        //REDIRECT KE HALAMAN FINISH TRANSAKSI
        return redirect(route('finish_checkout', $order->invoice))->cookie($cookie);
        } catch (\Exception $e) {
            //JIKA TERJADI ERROR, MAKA ROLLBACK DATANYA
            DB::rollback();
            //DAN KEMBALI KE FORM TRANSAKSI SERTA MENAMPILKAN ERROR
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function checkoutFinish($invoice)
    {
        //AMBIL DATA PESANAN BERDASARKAN INVOICE
        $order = Order::with(['district.city'])->where('invoice', $invoice)->first();
        //LOAD VIEW checkout_finish.blade.php DAN PASSING DATA ORDER
        return view('WF_Collection.checkout_finis', compact('order'));
    }

    public function getCourier(Request $request)
    {
        $this->validate($request, [
        'destination' => 'required',
        'weight' => 'required|integer'
        ]);

        //MENGIRIM PERMINTAAN KE API RUANGAPI UNTUK MENGAMBIL DATA ONGKOS KIRIM
        //BACA DOKUMENTASI UNTUK PENJELASAN LEBIH LANJUT
        $url = 'https://ruangapi.com/api/v1/shipping';
        $client = new Client();
        $response = $client->request('POST', $url, [
            'headers' => [
                'Authorization' => 'w6VnrPU7L2TMTepAe4kZGkEXg2x8CrkYrDPhmCX5'
            ],
            'form_params' => [
                'origin' => 462, //ASAL PENGIRIMAN, 22 = BANDUNG
                'destination' => $request->destination,
                'weight' => $request->weight,
                'courier' => 'jnt,tiki, sicepat' //MASUKKAN KEY KURIR LAINNYA JIKA INGIN MENDAPATKAN DATA ONGKIR DARI KURIR YANG LAIN
            ]
        ]);

        $body = json_decode($response->getBody(), true);
        return $body;
      }
  }
