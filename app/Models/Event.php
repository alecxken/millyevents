<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model {
    use HasFactory;
    protected $fillable = [
        'title','slug','description','category','venue','location',
        'start_date','end_date','price','capacity','slots_taken',
        'status','image_url','featured','published','created_by',
    ];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
        'featured'   => 'boolean',
        'published'  => 'boolean',
        'price'      => 'decimal:2',
    ];

    protected static function boot() {
        parent::boot();
        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title) . '-' . Str::random(5);
            }
        });
    }

    public function bookings() { return $this->hasMany(Booking::class); }
    public function notes()    { return $this->hasMany(Note::class); }
    public function slides()   { return $this->hasMany(CarouselSlide::class); }
    public function creator()  { return $this->belongsTo(User::class, 'created_by'); }

    public function getSlotsRemainingAttribute() { return max(0, $this->capacity - $this->slots_taken); }
    public function getSlotPercentAttribute()    { return $this->capacity > 0 ? round(($this->slots_taken / $this->capacity) * 100) : 0; }
    public function getFormattedPriceAttribute() { return 'KES ' . number_format($this->price, 0); }
}
