<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;


    protected $fillable = [
        'action',
        'document_id',
        'final_approval',
        'document_control_number',
        'to_external',
        'user_id',
        'routed_to',
        'final_remarks',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id', 'document_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
