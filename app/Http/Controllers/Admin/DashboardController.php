<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use App\Models\Booking;
use App\Models\TestPlan;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'events'   => Event::count(),
            'users'    => User::count(),
            'bookings' => Booking::count(),
            'revenue'  => Booking::where('status','confirmed')->sum('total_amount'),
        ];
        $recentEvents   = Event::latest()->take(5)->get();
        $recentBookings = Booking::with(['user','event'])->latest()->take(10)->get();
        return view('admin.dashboard', compact('stats', 'recentEvents', 'recentBookings'));
    }
}
