<?php
namespace App\Http\Controllers;
use App\Models\TestPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestPlanController extends Controller
{
    public function index()
    {
        $plans = TestPlan::with('testCases')->orderByDesc('created_at')->get();
        return view('tests.index', compact('plans'));
    }

    public function create()  { return view('tests.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'                 => 'required|string|max:255',
            'description'          => 'nullable|string',
            'features_to_test'     => 'nullable|string',
            'features_not_to_test' => 'nullable|string',
            'pass_criteria'        => 'nullable|string',
            'fail_criteria'        => 'nullable|string',
            'approach'             => 'nullable|string',
            'testing_materials'    => 'nullable|string',
            'conclusion'           => 'nullable|string',
            'recommendation'       => 'nullable|string',
        ]);
        $plan = TestPlan::create(array_merge($data, ['user_id' => Auth::id()]));
        return redirect()->route('tests.show', $plan)->with('success', 'Test plan created.');
    }

    public function show(TestPlan $test)
    {
        abort_unless($test->user_id === Auth::id() || Auth::user()->is_admin, 403);
        $test->load(['testCases.results.user', 'testCases.latestResult']);
        return view('tests.show', compact('test'));
    }

    public function edit(TestPlan $test)
    {
        abort_unless($test->user_id === Auth::id() || Auth::user()->is_admin, 403);
        return view('tests.edit', compact('test'));
    }

    public function update(Request $request, TestPlan $test)
    {
        abort_unless($test->user_id === Auth::id() || Auth::user()->is_admin, 403);
        $data = $request->validate([
            'name'                 => 'required|string|max:255',
            'description'          => 'nullable|string',
            'features_to_test'     => 'nullable|string',
            'features_not_to_test' => 'nullable|string',
            'pass_criteria'        => 'nullable|string',
            'fail_criteria'        => 'nullable|string',
            'approach'             => 'nullable|string',
            'testing_materials'    => 'nullable|string',
            'conclusion'           => 'nullable|string',
            'recommendation'       => 'nullable|string',
            'status'               => 'in:draft,active,completed',
        ]);
        $test->update($data);
        return redirect()->route('tests.show', $test)->with('success', 'Test plan updated.');
    }

    public function destroy(TestPlan $test)
    {
        abort_unless($test->user_id === Auth::id() || Auth::user()->is_admin, 403);
        $test->delete();
        return redirect()->route('tests.index')->with('success', 'Test plan deleted.');
    }
}
