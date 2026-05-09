<?php
namespace App\Http\Controllers;
use App\Models\TestCase;
use App\Models\TestPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestCaseController extends Controller
{
    public function store(Request $request, TestPlan $test)
    {
        abort_unless($test->user_id === Auth::id(), 403);
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'description'     => 'nullable|string',
            'preconditions'   => 'nullable|string',
            'steps'           => 'required|string',
            'expected_result' => 'required|string',
            'priority'        => 'in:low,medium,high,critical',
        ]);
        TestCase::create(array_merge($data, [
            'test_plan_id' => $test->id,
            'sort_order'   => $test->testCases()->count() + 1,
        ]));
        return back()->with('success', 'Test case added.');
    }

    public function destroy(TestCase $testCase)
    {
        abort_unless($testCase->testPlan->user_id === Auth::id(), 403);
        $testCase->delete();
        return back()->with('success', 'Test case deleted.');
    }
}
