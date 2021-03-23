<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Customer;
use App\Cart;
use App\Kategori;
use App\Produk;
use App\Province;
use Validator;
use Storage;
use App\Order;

class ControlerCover extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
      if (request()->kategori) {
        $produk = Produk::with('kategori')->whereHas('kategori', function($query){
                  $query->where('slug', request()->kategori)->get();
                  });
        // $kategories = Kategori::with(['child'])->withCount(['child'])->getParent()->orderBy('kategori', 'ASC')->get();
        // dd($produk);
      }else {
        $produk = Produk::inRandomOrder()->paginate(10);
        // $kategories = Kategori::with(['child'])->withCount(['child'])->getParent()->orderBy('kategori', 'ASC')->get();
      }
      return view('WF_Collection.ecormmence', compact('produk' ));
    }

    public function produk()
    {
        // $kategories = Kategori::with(['child'])->withCount(['child'])->getParent()->orderBy('kategori', 'ASC')->get();
        $produk = Produk::orderBy('created_at', 'DESC')->paginate(8);
        if (request()->slug) {
          $produk = Kategori::where('slug', $slug)->first()->produk()->orderBy('created_at', 'DESC')->paginate('12');

          // $kategories = Kategori::with(['child'])->withCount(['child'])->getParent()->orderBy('kategori', 'ASC')->get();
          // dd($produk);
        }
       //LOAD JUGA DATA KATEGORI YANG AKAN DITAMPILKAN PADA SIDEBAR
       return view('WF_Collection.produk', compact('produk'));
    }

    public function kategoriProduk($slug)
    {
      // dd($slug);
      // $produk = Kategori::where('slug', $slug)->first()->produk()->orderBy('created_at', 'DESC')->paginate('12');
      // $kategories = Kategori::with(['child'])->withCount(['child'])->getParent()->orderBy('kategori', 'ASC')->get();

      // $kategori = Kategori::with('produk')->has('produk')->get();
     $produk = Produk::with('kategori')->whereHas('kategori', function ($query){
        $query->where('slug',request('slug') );
      })->paginate(8);
     // dd($produk);

       return view('WF_Collection.produk', compact('produk'));

    }

    public function show($id)
    {
      $produk = Produk::findOrFail($id);
      // dd($produk);
      // $produk = Produk::with('[kd_kategori]')->where('kd_produk', $kd_produk)->first();
      return view('WF_Collection.produk_single', compact('produk'));

    }

    public function verifyCustomerRegistration($token)
    {
        //JADI KITA BUAT QUERY UNTUK MENGMABIL DATA USER BERDASARKAN TOKEN YANG DITERIMA
        $customer = Customer::where('activate_token', $token)->first();
        if ($customer) {
            //JIKA ADA MAKA DATANYA DIUPDATE DENGNA MENGOSONGKAN TOKENNYA DAN STATUSNYA JADI AKTIF
            $customer->update([
                'activate_token' => null,
                'is_aktif' => 1
            ]);
            //REDIRECT KE HALAMAN LOGIN DENGAN MENGIRIMKAN FLASH SESSION SUCCESS
            return redirect(route('customer.login'))->with(['success' => 'Verifikasi Berhasil, Silahkan Login']);
        }
        //JIKA TIDAK ADA, MAKA REDIRECT KE HALAMAN LOGIN
        //DENGAN MENGIRIMKAN FLASH SESSION ERROR
        return redirect(route('customer.login'))->with(['error' => 'Invalid Verifikasi Token']);
    }

    public function customerSettingForm()
    {
        //MENGAMBIL DATA CUSTOMER YANG SEDANG LOGIN
        $customer = auth()->guard('customer')->user()->load('district');
        //GET DATA PROPINSI UNTUK DITAMPILKAN PADA SELECT BOX
        $provinces = Province::orderBy('name', 'ASC')->get();
        //LOAD VIEW setting.blade.php DAN PASSING DATA CUSTOMER - PROVINCES
        return view('WF_Collection.setting', compact('customer', 'provinces'));
    }

    public function customerUpdateProfile(Request $request)
    {
        //VALIDASI DATA YANG DIKIRIM
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'nohp' => 'required|max:15',
            'alamat' => 'required|string',
            'district_id' => 'required|exists:districts,id',
            'password' => 'nullable|string|min:6'
        ]);

        //AMBIL DATA CUSTOMER YANG SEDANG LOGIN
        $user = auth()->guard('customer')->user();
        //AMBIL DATA YANG DIKIRIM DARI FORM
        //TAPI HANYA 4 COLUMN SAJA SESUAI YANG ADA DI BAWAH
        $data = $request->only('name', 'nohp', 'alamat', 'district_id');
        //ADAPUN PASSWORD KITA CEK DULU, JIKA TIDAK KOSONG
        if ($request->password != '') {
            //MAKA TAMBAHKAN KE DALAM ARRAY
            $data['password'] = $request->password;
        }
        //TERUS UPDATE DATANYA
        $user->update($data);
        //DAN REDIRECT KEMBALI DENGAN MENGIRIMKAN PESAN BERHASIL
        return redirect()->back()->with(['success' => 'Profil berhasil diperbaharui']);
    }

    public function referalProduct($user, $produk)
    {
        $code = $user . '-' . $produk; //KITA MERGE USERID DAN PRODUCTID
        $produk = Produk::find($produk); //FIND PRODUCT BERDASARKAN PRODUCTID
        $cookie = cookie('wf-afiliasi', json_encode($code), 1440); //BUAT COOKIE DENGAN NAMA DW-AFILIASI DAN VALUENYA ADALAH CODE YANG SUDAH DI-MERGE
        //KEMUDIAN REDIRECT KE HALAMAN SHOW PRODUCT DAN MENGIRIMKAN COOKIE KE BROWSER
        return redirect(route('show_produk_web', $produk->kd_produk))->cookie($cookie);
    }
    public function listCommission()
    {
        $user = auth()->guard('customer')->user(); //AMBIL DATA USER YANG LOGIN
        //QUERY BERDASARKAN ID USER DARI DATA REF YANG ADA DIORDER DENGAN STATUS 4 ATAU SELESAI
        $orders = Order::where('ref', $user->id)->where('status', 4)->get();
        //LOAD VIEW AFFILIATE.BLADE.PHP DAN PASSING DATA ORDERS
        return view('WF_Collection.affiliate', compact('orders'));
    }

}
