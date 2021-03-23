<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use Validator;
use Storage;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
         $kategori = Kategori::with(['parent'])->orderBy('created_at', 'DESC')->paginate(10);
         $parent = Kategori::getParent()->orderBy('kategori', 'ASC')->get();
         // $filterkeyword = $request->get('keyword');
         // if($filterkeyword)
         // {
         //     //dijalankan jika ada pencarian
         //     $kategori = Kategori::where('kategori','LIKE',"%$filterkeyword%")->paginate(5);
         // }
         return view('wonderful.kategori.index', compact('parent', 'kategori'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent = kategori::getParent()->orderBy('kategori', 'ASC')->get();
        return view('wonderful.kategori.create', compact('parent'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->request->add(['slug' => $request->kategori]);
        $input = $request->all();
        $validator = Validator::make($input,[
          'kategori' => 'required|max:50|unique:kategori',
          'gambar_kategori' => 'required|image|mimes:jpeg,jpg,png|max:2048',
          // 'slug' => 'required'
        ]);

        if ($validator->fails()) {
          return redirect()->route('kategori.create')->withErrors($validator)->withInput();
        }


        // dd($input);
        $gambar_kategori = $request->file('gambar_kategori');
        $extention = $gambar_kategori->getClientOriginalExtension();

        if ($request->file('gambar_kategori')->isValid()) {
            $namaFoto = "Kategori/".date('YmdHis').".".$extention;
            $upload_path = 'public/uploads/kategori';
            $request->file('gambar_kategori')->move($upload_path,$namaFoto);
            $input['gambar_kategori'] = $namaFoto;
        }


        Kategori::create($input);
        return redirect()->route('kategori.index')->with('status', 'Kategori Berhasil disimpan');
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
        $kategori = Kategori::findOrFail($id);
        $parent = Kategori::getParent()->orderBy('kategori', 'ASC')->get(); //INI SAMA DENGAN QUERY YANG ADA PADA METHOD INDEX
        return view('wonderful.kategori.edit',compact('parent', 'kategori'));
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
        $kategori = Kategori::findOrFail($id);

        $input = $request->all();

        $validator = Validator::make($input,[
          'kategori' => 'required|max:255',
          'gambar_kategori' => 'sometimes|nullable|image|mimes:jpeg,jpg.png|max:2048'
        ]);

        if ($validator->fails())
        {
            return redirect()->route('kategori.edit',[$id])->withErrors($validator)->withInput();
        }

        if ($request->hasfile('gambar_kategori'))
        {
          if ($request->file('gambar_kategori')->isValid())
          {
            Storage::disk('upload')->delete($kategori->gambar_kategori);

            $gambar_kategori = $request->file('gambar_kategori');
            $extention = $gambar_kategori->getClientOriginalExtension();
            $namaFoto = "Kategori/".date('YmdHis').".".$extention;
            $upload_path = 'public/uploads/kategori';
            $request->file('gambar_kategori')->move($upload_path,$namaFoto);
            $input['gambar_kategori'] = $namaFoto;
          }
        }
        $kategori->update($input);
        return redirect()->route('kategori.index')->with('status', 'Kategori Berhasil diupdate');
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::withCount(['child'])->findOrFail($id);
        if ($kategori->child_count == 0) {
          // code...
          $kategori->delete();
          Storage::disk('upload')->delete($kategori->gambar_kategori);
          return redirect()->route('kategori.index')->with('status', 'Kategori Berhasil dihapus');
        }
        return redirect()->route('kategori.index')->with('error', 'Kategori ini Memiliki Anak Kategori');

    }

}
