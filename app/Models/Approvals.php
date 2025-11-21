<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approvals extends Model
{
    use HasFactory;
    protected $table = 'approval_table';

    // Fillable columns
    protected $fillable = [
        'document_id',
        'user_id',
        'approval_type',

        'remarks',
        'status',
    ];

    /**
     * Relationship to Document model
     * approval_table.document_id → documents.document_id
     */
    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id', 'document_id')
            ->with([
                'files',
                'modifications',
                'activities'
            ]);
    }
}
