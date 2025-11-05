<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $table = 'office_table';
    protected $primaryKey = 'office_id';
    public $timestamps = false;

    protected $fillable = [
        'office_name',
        'office_code',
        'created_at',
    ];
}
