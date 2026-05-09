<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestCase extends Model {
    use HasFactory;
    protected $fillable = ['test_plan_id','name','description','preconditions','steps','expected_result','priority','sort_order'];
    public function testPlan() { return $this->belongsTo(TestPlan::class); }
    public function results()  { return $this->hasMany(TestResult::class); }
    public function latestResult() { return $this->hasOne(TestResult::class)->latestOfMany(); }
}
