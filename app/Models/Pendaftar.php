<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pendaftar extends Model
{
    use HasFactory;

    protected $fillable = [
        'beasiswa_id',
        'nama_lengkap',
        'nim',
        'email',
        'no_hp',
        'alasan_mendaftar',
        'file_transkrip',
        'file_ktp',
        'file_kk',
        'status',
        'rejection_reason',
        'can_resubmit',
        'rejected_at'
    ];

    protected $casts = [
        'can_resubmit' => 'boolean',
        'rejected_at' => 'datetime'
    ];

    /**
     * Relationship with Beasiswa
     */
    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }

    /**
     * Check if this application was rejected
     */
    public function isRejected()
    {
        return $this->status === 'ditolak';
    }

    /**
     * Check if user can resubmit after rejection
     */
    public function canResubmit()
    {
        return $this->isRejected() && $this->can_resubmit;
    }

    /**
     * Get formatted rejection date
     */
    public function getRejectionDateAttribute()
    {
        return $this->rejected_at ? $this->rejected_at->format('d M Y H:i') : null;
    }

    /**
     * Scope untuk get aplikasi yang bisa resubmit
     */
    public function scopeCanResubmit($query)
    {
        return $query->where('status', 'ditolak')
                    ->where('can_resubmit', true);
    }

    /**
     * Scope untuk get aplikasi yang ditolak permanen
     */
    public function scopePermanentlyRejected($query)
    {
        return $query->where('status', 'ditolak')
                    ->where('can_resubmit', false);
    }
}
