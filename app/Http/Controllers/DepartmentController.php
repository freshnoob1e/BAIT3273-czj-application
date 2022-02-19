<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class DepartmentController extends Controller
{
    // CRUD
    public function index(){
        $departments = Department::all()->load('jobs');

        return response()->json(['departments' => $departments]);
    }

    public function show(Department $department){
        return response()->json(['department' => $department]);
    }

    public function store(Request $req){
        $data = $req->all();

        Department::create($data);

        return response()->json(['res', 'OK']);
    }

    public function edit(Department $department){
        $department = $department;

        return response()->json(['department' => $department]);
    }

    public function update(Department $department, Request $req){
        $data = $req->all();

        $department->update($data);

        return response()->json(['res' => 'OK']);
    }

    // API
    public function getJobInDepartment(Department $department){
        $jobs = $department->jobs;
        return response()->json(['jobs' => $jobs]);
    }

    public function searchDepartments($searchTerm){
        if($searchTerm == 'all')
            $departments = Department::latest()->get();
        else
            $departments = Department::search($searchTerm)->get();

        return response()->json(['departments' => $departments]);
    }
}
