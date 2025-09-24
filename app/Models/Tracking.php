<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Tracking extends Model {
    protected $fillable = ['user_id', 'activity', 'location', 'tracked_at'];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
