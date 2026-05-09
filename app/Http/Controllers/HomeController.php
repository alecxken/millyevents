<?php
namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\CarouselSlide;

class HomeController extends Controller
{
    public function index()
    {
        $slides  = CarouselSlide::where('active', true)->orderBy('sort_order')->get();
        $events  = Event::where('published', true)->orderBy('start_date')->take(6)->get();
        $stats   = [
            'events'   => Event::where('published', true)->count(),
            'bookings' => \App\Models\Booking::count(),
            'venues'   => Event::distinct('location')->count('location'),
            'years'    => 5,
        ];
        return view('welcome', compact('slides', 'events', 'stats'));
    }
}
