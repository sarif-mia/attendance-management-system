<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Notice extends Model {
    protected $fillable = ['title', 'body', 'user_id'];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
