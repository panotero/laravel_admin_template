<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents'; // optional if table name matches model

    // Make sure the primary key is 'id' and auto-incrementing
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    // Fillable fields for mass assignment
    protected $fillable = [
        'document_code',
        'document_control_number',
        'date_received',
        'particular',
        'office_origin',
        'destination_office',
        'user_id',
        'document_form',
        'document_type',
        'date_of_document',
        'due_date',
        'signatory',
        'remarks',
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
    public function activities()
    {
        return $this->hasMany(Activity::class, 'document_control_number', 'document_control_number');
    }
}
