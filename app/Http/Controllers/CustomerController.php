<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\User;
use Validator;
use App\Province;
use Illuminate\Support\Arr;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::all();
        return view('wonderful.customer.index', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $provinces = Province::orderBy('name', 'ASC')->get();
        return view('wonderful.customer.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $data = $request->all();
        // $validator = Validator::make($data,[
        //   'nama_customer' => 'required|max:100',
        //   'username' => 'required|min:3|unique:users',
        //   'ktp' => 'required|numeric|min:16|unique:customers',
        //   'no_hp' => 'required|numeric|min:10|unique:customers',
        //   'alamat' => 'required',
        //   'email'=> 'required|email|unique:users',
        //   'password' => 'required',
        // ]);
        //
        // if ($validator->fails()) {
        //     return redirect()->route('customer.create')->withErrors($validator)->withInput();
        // }
         dd($request);
        // dd($request);

        $this->validate($request,[
              'nama_customer' => 'required|max:100',
              'username' => 'required|min:3|unique:users',
              'ktp' => 'required|numeric|min:16|unique:customers',
              'no_hp' => 'required|numeric|min:10|unique:customers',
              'alamat' => 'required',
              'district_id' => 'required|exists:districts,id',
              'email'=> 'required|email|unique:users',
              'password' => 'required|string|min:6',
        ]);

        $data['password'] = password_hash($request->input('password'), PASSWORD_DEFAULT);
        //insert ke table users
        $user = new User;
        $user->username = $request->username;
        $user->level = 'customer';
        $user->name = $request->nama_customer;
        $user->email = $request->email;
        $user->Password = $data['password'];
        $user->save();

        $request->request->add(['user_id' => $user->id]);

        Customer::create($request->all());
        return redirect()->route('customer.index')->with('sukses', 'Data Customer Berhasil ditambahkan');
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
        $customer = Customer::findOrFail($id);
        $provinces = Province::orderBy('name', 'ASC')->get();
        return view('wonderful.customer.edit', compact('customer', 'provinces'));
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
        $customer = Customer::findOrFail($id);
        $data = $request->all();

        $validator = Validator::make($data,[
              'nama_customer' => 'required|max:100',
              'email' => 'required|email|max:225|unique:users,email,'.$id,
              'password' => 'sometimes|nullable|string|min:6',
              'ktp' => 'required|numeric|min:16|unique:customers',
              'no_hp' => 'required|numeric|min:10|unique:customers',
              'district_id' => 'required|exists:districts,id',
              'alamat' => 'required',
        ]);

        if ($validasi->fails()) {
          return redirect()->route('customer.edit',[$id])->withErrors($validasi);
        }

        if ($request->input('password'))
        {
          $data['password'] = bcrypt($data['password']);
        }
        else
        {
          $data = Arr::except($data,['password']);
        }

        $customer->update($data);
        return redirect()->route('customer.index')->with('sukses', ' Data Customer Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('customer.index')->with('sukses', 'Data Customer Berhasil dihapus');
    }
}
