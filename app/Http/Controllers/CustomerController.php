<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return Customer::orderBy('id', 'desc')->offset(0)->limit(100)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => ' ',
            'phone' => 'required',
            'address' => ' ',
            'gender' => ' ',
            'notes' => ' ',
        ]);
 
        $person = Customer::create($request->all());
        return $person;
    }

    public function show($id)
    {
        return Customer::findOrFail($id);
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'email' => '',
            'phone' => 'required',
            'address' => ' ',
            'gender' => ' ',
            'notes' => '',
        ]);
        $customer->update($request->all());
        return $customer;
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json();
    } 


    public function search(Request $request )
    {
        $request->validate([
            'name'=>'required'
        ]);
        $name = $request->name;
        return Customer::where('name','like','%' . $name . '%')->get();
    }

}
