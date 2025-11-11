<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $primaryKey = 'document_id';
    protected $fillable = [
        'document_control_number',
        'date_received',
        'particular',
        'office_origin',
        'user_id',
        'document_form',
        'document_type',
        'date_of_document',
        'signatory',
        'date_forwarded',
        'destination_office',
        'involved_office',
        'action_taken',
        'status',
        'confidentiality',
    ];

    protected $casts = [
        'involved_office' => 'array',
    ];

    // A document has many files
    public function files()
    {
        return $this->hasMany(File::class, 'document_id', 'document_id');
    }

    // A document has many modifications
    public function modifications()
    {
        return $this->hasMany(Modification::class, 'document_id', 'document_id');
    }
}
