<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavMenu extends Model
{
    protected $table = 'nav_menus';   // Explicitly set table name if it’s not plural
    protected $fillable = [
        'title',
        'icon',
        'link',
        'allowed_roles',
        'parent_menu',
    ];
}
