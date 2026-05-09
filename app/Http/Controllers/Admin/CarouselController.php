<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\CarouselSlide;
use App\Models\Event;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function index()
    {
        $slides = CarouselSlide::with('event')->orderBy('sort_order')->get();
        $events = Event::where('published', true)->orderBy('title')->get();
        return view('admin.carousel.index', compact('slides', 'events'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tag'                 => 'required|string|max:100',
            'headline'            => 'required|string|max:255',
            'sub_text'            => 'nullable|string',
            'btn_primary_label'   => 'nullable|string|max:100',
            'btn_secondary_label' => 'nullable|string|max:100',
            'date_display'        => 'nullable|string|max:100',
            'venue_display'       => 'nullable|string|max:100',
            'price_display'       => 'nullable|string|max:100',
            'bg_color'            => 'nullable|string|max:20',
            'sort_order'          => 'integer',
            'event_id'            => 'nullable|exists:events,id',
        ]);
        CarouselSlide::create(array_merge($data, ['active' => true]));
        return back()->with('success', 'Slide created.');
    }

    public function update(Request $request, CarouselSlide $carousel)
    {
        $data = $request->validate([
            'tag'                 => 'required|string|max:100',
            'headline'            => 'required|string|max:255',
            'sub_text'            => 'nullable|string',
            'btn_primary_label'   => 'nullable|string|max:100',
            'btn_secondary_label' => 'nullable|string|max:100',
            'date_display'        => 'nullable|string|max:100',
            'venue_display'       => 'nullable|string|max:100',
            'price_display'       => 'nullable|string|max:100',
            'bg_color'            => 'nullable|string|max:20',
            'sort_order'          => 'integer',
            'active'              => 'boolean',
            'event_id'            => 'nullable|exists:events,id',
        ]);
        $carousel->update($data);
        return back()->with('success', 'Slide updated.');
    }

    public function destroy(CarouselSlide $carousel)
    {
        $carousel->delete();
        return back()->with('success', 'Slide deleted.');
    }
}
