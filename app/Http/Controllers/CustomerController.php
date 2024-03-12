<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() {
        $customers = Customer::all();
        return view('customers.index', compact(['customers']));
    }

    public function create() {
        return view('customers.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required:min:5',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required'
        ]);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
        return redirect('/customers')->with('success','Data customer berhasil di tambahkan');
    }

    public function edit($id){
        $customer = Customer::find($id);
        return view('customers.edit',compact(['customer']));
    }

    public function update($id, Request $request){
        $customer = Customer::find($id);
        $request->validate([
            'name' => 'required:min:5',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required'
        ]);

        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
        // $customer->update($request->except(['_token','submit']));
        return redirect('/customers')->with('success','Data customer berhasil di ubah');
    }

    public function destroy($id){
        $customer = Customer::find($id);
        $customer->delete();
        return redirect('/customers')->with('success','Data customer berhasil di hapus');
    }
}
