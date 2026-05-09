<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestPlan extends Model {
    use HasFactory;
    protected $fillable = [
        'user_id','name','description','features_to_test','features_not_to_test',
        'pass_criteria','fail_criteria','approach','testing_materials',
        'conclusion','recommendation','status',
    ];
    public function user()      { return $this->belongsTo(User::class); }
    public function testCases() { return $this->hasMany(TestCase::class)->orderBy('sort_order'); }
    public function getPassCountAttribute()  { return $this->testCases->flatMap->results->where('status','pass')->count(); }
    public function getFailCountAttribute()  { return $this->testCases->flatMap->results->where('status','fail')->count(); }
    public function getTotalResultsAttribute() { return $this->testCases->flatMap->results->count(); }
}
