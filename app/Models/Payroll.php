<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Payroll extends Model {
    protected $fillable = ['user_id', 'salary', 'tax', 'loan', 'month', 'year', 'status'];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
