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
        'fakultas',
        'jurusan',
        'semester',
        'ipk',
        'alasan_mendaftar',
        'uploaded_documents',
        'status',
        'rejection_reason',
        'can_resubmit',
        'rejected_at'
    ];

    protected $casts = [
        'can_resubmit' => 'boolean',
        'rejected_at' => 'datetime',
        'uploaded_documents' => 'array'
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
     * Get uploaded documents with proper formatting
     */
    public function getUploadedDocumentsAttribute($value)
    {
        $decoded = json_decode($value, true);
        return is_array($decoded) ? $decoded : [];
    }

    /**
     * Get document by key
     */
    public function getDocument($key)
    {
        return $this->uploaded_documents[$key] ?? null;
    }

    /**
     * Set document
     */
    public function setDocument($key, $filename)
    {
        $documents = $this->uploaded_documents;
        $documents[$key] = $filename;
        $this->uploaded_documents = $documents;
    }

    /**
     * Remove document
     */
    public function removeDocument($key)
    {
        $documents = $this->uploaded_documents;
        unset($documents[$key]);
        $this->uploaded_documents = $documents;
    }

    /**
     * Check if has all required documents
     */
    public function hasAllRequiredDocuments()
    {
        if (!$this->beasiswa || !$this->beasiswa->required_documents) {
            return false;
        }

        foreach ($this->beasiswa->required_documents as $document) {
            if ($document['required'] && empty($this->getDocument($document['key']))) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get missing required documents
     */
    public function getMissingRequiredDocuments()
    {
        $missing = [];

        if (!$this->beasiswa || !$this->beasiswa->required_documents) {
            return $missing;
        }

        foreach ($this->beasiswa->required_documents as $document) {
            if ($document['required'] && empty($this->getDocument($document['key']))) {
                $missing[] = $document;
            }
        }

        return $missing;
    }

    /**
     * Legacy accessors for backward compatibility
     */
    public function getFileTranskripAttribute()
    {
        return $this->getDocument('file_transkrip');
    }

    public function getFileKtpAttribute()
    {
        return $this->getDocument('file_ktp');
    }

    public function getFileKkAttribute()
    {
        return $this->getDocument('file_kk');
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
