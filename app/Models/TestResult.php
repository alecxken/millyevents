<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model {
    use HasFactory;
    protected $fillable = ['test_case_id','user_id','status','actual_result','notes','tested_at'];
    protected $casts    = ['tested_at' => 'datetime'];
    public function testCase() { return $this->belongsTo(TestCase::class); }
    public function user()     { return $this->belongsTo(User::class); }
}
