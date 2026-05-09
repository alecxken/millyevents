<?php
namespace App\Http\Controllers;
use App\Models\TestCase;
use App\Models\TestResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestResultController extends Controller
{
    public function store(Request $request, TestCase $testCase)
    {
        abort_unless($testCase->testPlan->user_id === Auth::id(), 403);
        $data = $request->validate([
            'status'        => 'required|in:pass,fail,blocked,not_tested',
            'actual_result' => 'nullable|string',
            'notes'         => 'nullable|string',
        ]);
        TestResult::create(array_merge($data, [
            'test_case_id' => $testCase->id,
            'user_id'      => Auth::id(),
            'tested_at'    => now(),
        ]));
        return back()->with('success', 'Result recorded.');
    }
}
