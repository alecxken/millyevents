<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model {
    use HasFactory;
    protected $fillable = ['user_id','event_id','reference','quantity','total_amount','status','payment_method'];
    protected static function boot() {
        parent::boot();
        static::creating(function ($b) {
            if (empty($b->reference)) $b->reference = 'BK-' . strtoupper(Str::random(8));
        });
    }
    public function user()  { return $this->belongsTo(User::class); }
    public function event() { return $this->belongsTo(Event::class); }
}
