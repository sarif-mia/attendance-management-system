<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = [
        'user_id', 'action', 'description', 'ip_address'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
