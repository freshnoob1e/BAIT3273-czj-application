<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Job;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    // CRUD
    public function index(){
        $employees = Employee::latest()->with(['job'])->get();
        return response()->json(['employees' => $employees]);
    }

    public function show(Employee $employee){
        $employee = $employee->load(['job.department', 'address']);
        return response()->json(['employee' => $employee]);
    }

    public function edit(Employee $employee){
        $employee = $employee->load(['job']);
        $jobs = Job::all();

        return response()->json([
            'employee' => $employee,
            'jobs' => $jobs
        ]);
    }

    public function update(Request $req, Employee $employee){
        $data = $req->all();
        $employee->update($data);

        return response()->json(['res' => 'OK'], 200);
    }

    public function create(){
        $departments = Department::all();
        $initialJobs = $departments[0]->jobs;

        return Inertia::render('Employee/Create', [
            'departments' => $departments,
            'initialJobs' => $initialJobs
        ]);
    }

    public function store(Request $req){
        $data = $req->all();
        $employee = Employee::create($data);

        return response()->json(['employee' => $employee]);
    }

    // API CALLLS
    public function searchEmployees($searchTerm){
        if($searchTerm == 'all')
            $employees = Employee::latest()->with(['job'])->get();
        else
            $employees = Employee::search($searchTerm)->get()->load('job');

        return response()->json(['employees' => $employees]);
    }
}
