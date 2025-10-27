<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingRole extends Model
{
    protected $table = 'setting_role';
    public $timestamps = false;

    protected $fillable = [
        'role_name',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
