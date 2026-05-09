<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarouselSlide extends Model {
    use HasFactory;
    protected $fillable = [
        'tag','headline','sub_text','btn_primary_label','btn_secondary_label',
        'date_display','venue_display','price_display','bg_color','sort_order','active','event_id',
    ];
    protected $casts = ['active' => 'boolean'];
    public function event() { return $this->belongsTo(Event::class); }
}
