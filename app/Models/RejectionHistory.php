<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectionHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'pendaftar_id',
        'rejection_reason',
        'can_resubmit',
        'rejected_by',
        'rejected_at'
    ];

    protected $casts = [
        'can_resubmit' => 'boolean',
        'rejected_at' => 'datetime'
    ];

    /**
     * Relationship with Pendaftar
     */
    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class);
    }

    /**
     * Get formatted rejection date
     */
    public function getFormattedRejectedAtAttribute()
    {
        return $this->rejected_at->format('d M Y H:i');
    }

    /**
     * Get resubmit text
     */
    public function getResubmitTextAttribute()
    {
        return $this->can_resubmit ? 'Dapat submit ulang' : 'Ditolak permanen';
    }
}
