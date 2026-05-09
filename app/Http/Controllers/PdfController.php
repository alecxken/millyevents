<?php
namespace App\Http\Controllers;
use App\Models\TestPlan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PdfController extends Controller
{
    public function testPlan(TestPlan $test)
    {
        abort_unless($test->user_id === Auth::id() || Auth::user()->is_admin, 403);
        $test->load(['testCases.latestResult.user', 'user']);
        $pdf = Pdf::loadView('pdf.test-plan', compact('test'))->setPaper('a4', 'portrait');
        return $pdf->download("test-plan-{$test->id}.pdf");
    }

    public function projectDoc()
    {
        $pdf = Pdf::loadView('pdf.project-doc')->setPaper('a4', 'portrait');
        return $pdf->download('milyvents-project-documentation.pdf');
    }
}
