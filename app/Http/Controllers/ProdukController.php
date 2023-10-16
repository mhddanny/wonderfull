<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProductJob;
use App\Kategori;
use App\Produk;
use Validator;
use Storage;
use App\Jobs\MarketplaceJob;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
         $produk = Produk::all();
         $kategori = Kategori::all();
         $filterkeyword = $request->get('keyword');
         $nama_kategori = '';

         if($filterkeyword)
         {
             //dijalankan jika ada pencarian
             $produk = Produk::where('nama_produk','LIKE',"%$filterkeyword%")->paginate(5);
         }

         $filter_by_kategori = $request->get('kd_kategori');
         if ($filter_by_kategori) {
            $produk = Produk::where('kd_kategori',$filter_by_kategori)->paginate(5);

            $data_kategori = Kategori::find($filter_by_kategori);
            $nama_kategori = $data_kategori->kategori;
         }

         return view('wonderful.produk.index', compact('produk','kategori', 'nama_kategori'));
     }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $kategori = Kategori::all();
            return view('wonderful.produk.create',compact('kategori'));
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
          $input = $request->all();
          // dd($input);
          $validator = Validator::make($input,[
            'nama_produk' => 'required|max:255',
            'kd_kategori' => 'required',
            'kode' => 'required|min:3',
            'weight' => 'required|integer',
            'harga' => 'required|numeric',
            'ket' => 'required',
            'gambar_produk' => 'required|image|mimes:jpeg,jpg,png|max:2048'
          ]);

          if ($validator->fails()) {
            return redirect()->route('produk.create')->withErrors($validator)->withInput();
          }

          if ($request->file('gambar_produk')->isValid()) {
              $gambar_produk = $request->file('gambar_produk');
              $extention = $gambar_produk->getClientOriginalExtension();
              $namaFoto = "produk/".date('YmdHis').".".$extention;
              $upload_path = 'uploads/produk';
              $request->file('gambar_produk')->move($upload_path,$namaFoto);
              $input['gambar_produk'] = $namaFoto;
          }

          $input['stok'] = 0;

          Produk::create($input);
          return redirect()->route('produk.index')->with('status', 'Produk Berhasil disimpan');
        }

        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $kategori = Kategori::all();
            $produk = Produk::findOrFail($id);

            return view('wonderful.produk.edit',compact('kategori','produk'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
          $produk = Produk::findOrFail($id);

          $input = $request->all();

          $validator = Validator::make($input,[
            'nama_produk' => 'required|max:255',
            'kd_kategori' => 'required',
            'kode' => 'required|min:3',
            'weight' => 'required|integer',
            'harga' => 'required|numeric',
            'ket' => 'required',
            'gambar_produk' => 'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048'
          ]);

          if ($validator->fails())
          {
              return redirect()->route('produk.edit',[$id])->withErrors($validator)->withInput();
          }

          if ($request->hasfile('gambar_produk'))
          {
            if ($request->file('gambar_produk')->isValid())
            {
              Storage::disk('upload')->delete($produk->gambar_produk);

              $gambar_produk = $request->file('gambar_produk');
              $extention = $gambar_produk->getClientOriginalExtension();
              $namaFoto = "produk/".date('YmdHis').".".$extention;
              $upload_path = 'uploads/produk';
              $request->file('gambar_produk')->move($upload_path,$namaFoto);
              $input['gambar_produk'] = $namaFoto;
            }
          }

          $produk->update($input);
          return redirect()->route('produk.index')->with('status', 'Produk Berhasil diupdate');
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $produk = Produk::findOrFail($id);
            $produk->delete();
            Storage::disk('upload')->delete($produk->gambar_produk);
            return redirect()->route('produk.index')->with('status', 'Data Produk Berhasil dihapus');
        }

        public function massUploadForm()
          {
            $kategori = Kategori::orderBy('kategori', 'DESC')->get();
            return view('wonderful.produk.bulk', compact('kategori'));
          }

          public function massUpload(Request $request)
          {
            dd($request);
            $this->validate($request, [
              'kd_kategori' => 'required|exists:kategori,kd_kategori',
              'file' => 'required|mimes:xlsx'
            ]);


            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '-produck.' . $file->getClientOriginalExtension();
                $file->storeAs('uploads/produk', $filename); //MAKA SIMPAN FILE TERSEBUT DI STORAGE/APP/PUBLIC/UPLOADS


                //BUAT JADWAL UNTUK PROSES FILE TERSEBUT DENGAN MENGGUNAKAN JOB
                //ADAPUN PADA DISPATCH KITA MENGIRIMKAN DUA PARAMETER SEBAGAI INFORMASI
                //YAKNI KATEGORI ID DAN NAMA FILENYA YANG SUDAH DISIMPAN
                ProductJob::dispatch($request->kd_kategori, $filename);
                return redirect()->route('produk.index')->with('status', 'Produk Berhasil disimpan');

              }

          }

          public function uploadViaMarketplace(Request $request)
          {
              //VALIDASI INPUTAN
              $this->validate($request, [
                  'marketplace' => 'required|string',
                  'username' => 'required|string'
              ]);

              MarketplaceJob::dispatch($request->username, 10); //BUAT JOBS QUEUE
              //PARAMETER PERTAMA ADALAH USERNAME TOKO PADA MARKETPLACE
              //PARAMETER KEDUA ADALAH JUMLAH PRODUK YANG AKAN AMBIL DALAM SEKALI PROSES
              //SAYA SARANKAN MENGGUNAKAN VALUE 10 UNTUK MEMPERCEPAT PROSES
              return redirect()->back()->with(['success' => 'Produk Dalam Antrian']);
          }

    }
