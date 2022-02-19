<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class JobController extends Controller
{
    // CRUD
    public function index(){
        return response()->json([
            'jobs' => Job::latest()->with(['department'])->get()
        ]);
    }

    public function show(Job $job){
        $job = $job->load('department');
        return response()->json([
            'job' => $job
        ]);
    }

    // public function create(){
    //     $departments = Department::all();

    //     return Inertia::render('Job/Create', [
    //         'departments' => $departments
    //     ]);
    // }

    public function store(Request $req){
        $data = $req->all();

        Job::create($data);

        return response()->json(['res' => 'OK']);
    }

    public function edit(Job $job){
        return Inertia::render('Job/Edit', [
            'job' => $job->load(['department']),
            'departments' => Department::all(),
        ]);
    }

    public function update(Job $job, Request $req){
        $data = $req->all();

        $job->update($data);

        return response()->json(['res' => 'OK']);
    }

    // API CALLLS
    public function searchJobs($searchTerm){
        if($searchTerm == 'all')
            $jobs = Job::latest()->with(['department'])->get();
        else
            $jobs = Job::search($searchTerm)->get()->load('department');

        return response()->json(['jobs' => $jobs]);
    }
}
