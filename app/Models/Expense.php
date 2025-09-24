<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Expense extends Model {
    protected $fillable = ['title', 'amount', 'description', 'user_id', 'status'];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
