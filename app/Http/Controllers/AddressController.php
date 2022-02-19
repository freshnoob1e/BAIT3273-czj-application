<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AddressController extends Controller
{
    public function edit(Address $address){
        return response()->json(['address' => $address->load('employee')]);
    }

    public function store(Request $req){
        $data = $req->all();
        Address::create($data);

        return response()->json(['res' => 'OK'], 200);
    }

    public function update(Address $address, Request $req){
        $data = $req->all();
        $address->update($data);

        $employee = Employee::where('id', $address->employee_id)->with(['job.department', 'address'])->first();

        return response()->json(['res' => 'OK', 'employee' => $employee]);
    }
}
