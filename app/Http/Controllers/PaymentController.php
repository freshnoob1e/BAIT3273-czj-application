<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Evaluation;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentController extends Controller
{
    // CRUD
    public function index(){
        $payments = Payment::latest()->with(['evaluation', 'employee'])->get();

        return response()->json(['payments' => $payments]);
    }

    public function store(Request $req){
        $paymentData = $req['paymentData'];
        $payAmnt = $req['payAmnt'];
        $bonus = $req['bonus'];
        $evaluationData = $req['evaluationData'];


        $newPayment = Payment::create([
            'employee_id' => $req['employee_id'],
            'hours_worked' => $paymentData['hours_worked'],
            'overtime_worked' => $paymentData['overtime_worked'],
            'payment_date' => Carbon::now(),
            'amount' => $payAmnt,
            'bonus' => $bonus,
        ]);

        Evaluation::create([
            'payment_id' => $newPayment->id,
            'performance' => $evaluationData['performance'],
            'communication' => $evaluationData['communication'],
            'teamwork' => $evaluationData['teamwork'],
            'dedication' => $evaluationData['dedication'],
            'personality' => $evaluationData['personality'],
        ]);

        return response()->json(['res' => 'OK']);
    }

    // API CALLLS
    public function searchPayments($searchTerm){
        if($searchTerm == 'all')
            $payments = Payment::latest()->with(['evaluation'])->get();
        else
            $payments = Payment::where('id', 'LIKE', "%$searchTerm%")->get()->load('evaluation');

        return response()->json(['payments' => $payments]);
    }
}
