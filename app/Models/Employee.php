<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable;

    public function getAuthPassword()
    {
        return $this->password;
    }
    
    public function getRouteKeyName()
    {
        return 'name';
    }
    protected $table = 'employees';
    protected $fillable = [
        'name', 'email', 'password', 'pin_code', 'position', 'must_change_password'
    ];

  
    protected $hidden = [
        'password', 'pin_code', 'remember_token',
    ];


    public function check()
    {
        return $this->hasMany(Check::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
    public function latetime()
    {
        return $this->hasMany(Latetime::class);
    }
    public function leave()
    {
        return $this->hasMany(Leave::class);
    }
    public function overtime()
    {
        return $this->hasMany(Overtime::class);
    }
    public function schedules()
    {
        return $this->belongsToMany('App\Models\Schedule', 'schedule_employees', 'emp_id', 'schedule_id');
    }

    // Roles pivot for employees
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_employees', 'emp_id', 'role_id');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }

        return false;
    }

    public function hasRole($role)
    {
        $roleObj = $this->roles()->first();
        if ($roleObj && $roleObj->slug === $role) {
            return true;
        }
        return false;
    }


}
