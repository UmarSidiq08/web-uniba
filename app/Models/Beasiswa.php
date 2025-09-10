<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_beasiswa',
        'deskripsi',
        'jumlah_dana',
        'tanggal_buka',
        'tanggal_tutup',
        'status',
        'persyaratan',
        'required_documents'
    ];

    protected $casts = [
        'tanggal_buka' => 'date',
        'tanggal_tutup' => 'date',
        'required_documents' => 'array'  // This will handle JSON conversion automatically
    ];

    public function pendaftars()
    {
        return $this->hasMany(Pendaftar::class);
    }

    public function isActive()
    {
        return $this->status === 'aktif' &&
            now()->between($this->tanggal_buka, $this->tanggal_tutup);
    }

    public function getFormattedDanaAttribute()
    {
        return 'Rp ' . number_format($this->jumlah_dana, 0, ',', '.');
    }

    /**
     * Get required documents with validation
     */
    public function getRequiredDocumentsAttribute($value)
    {
        // If already an array (from casting), return as is
        if (is_array($value)) {
            return empty($value) ? $this->getDefaultDocuments() : $value;
        }

        // If string (JSON), decode it
        $decoded = json_decode($value, true);

        // Return default documents if none set or invalid
        if (!is_array($decoded) || empty($decoded)) {
            return $this->getDefaultDocuments();
        }

        return $decoded;
    }

    /**
     * Set required documents attribute
     */
    public function setRequiredDocumentsAttribute($value)
    {
        // Ensure it's stored as JSON
        $this->attributes['required_documents'] = is_array($value) ? json_encode($value) : $value;
    }

    /**
     * Get default documents structure
     */
    private function getDefaultDocuments()
    {
        return [
            [
                'name' => 'Transkrip Nilai',
                'key' => 'file_transkrip',
                'icon' => 'fas fa-file-pdf',
                'color' => 'red',
                'formats' => ['pdf'],
                'max_size' => 5,
                'required' => true,
                'description' => 'Transkrip nilai terbaru'
            ],
            [
                'name' => 'KTP',
                'key' => 'file_ktp',
                'icon' => 'fas fa-id-card',
                'color' => 'blue',
                'formats' => ['pdf', 'jpg', 'jpeg', 'png'],
                'max_size' => 5,
                'required' => true,
                'description' => 'Kartu Tanda Penduduk'
            ],
            [
                'name' => 'Kartu Keluarga',
                'key' => 'file_kk',
                'icon' => 'fas fa-users',
                'color' => 'green',
                'formats' => ['pdf', 'jpg', 'jpeg', 'png'],
                'max_size' => 5,
                'required' => true,
                'description' => 'Kartu Keluarga'
            ]
        ];
    }

    /**
     * Get required document keys for validation
     */
    public function getRequiredDocumentKeys()
    {
        return collect($this->required_documents)->pluck('key')->toArray();
    }

    /**
     * Get validation rules for documents
     */
    public function getDocumentValidationRules()
    {
        $rules = [];

        foreach ($this->required_documents as $document) {
            $rule = [];

            if ($document['required']) {
                $rule[] = 'required';
            } else {
                $rule[] = 'nullable';
            }

            $rule[] = 'file';

            if (!empty($document['formats'])) {
                $rule[] = 'mimes:' . implode(',', $document['formats']);
            }

            if (!empty($document['max_size'])) {
                $rule[] = 'max:' . ($document['max_size'] * 1024); // Convert MB to KB
            }

            $rules[$document['key']] = implode('|', $rule);
        }

        return $rules;
    }

    /**
     * Get document validation messages
     */
    public function getDocumentValidationMessages()
    {
        $messages = [];

        foreach ($this->required_documents as $document) {
            $key = $document['key'];
            $name = $document['name'];

            $messages["{$key}.required"] = "Dokumen {$name} wajib diupload.";
            $messages["{$key}.file"] = "File {$name} harus berupa file yang valid.";

            if (!empty($document['formats'])) {
                $formats = implode(', ', array_map('strtoupper', $document['formats']));
                $messages["{$key}.mimes"] = "Format {$name} harus: {$formats}.";
            }

            if (!empty($document['max_size'])) {
                $messages["{$key}.max"] = "Ukuran {$name} maksimal {$document['max_size']}MB.";
            }
        }

        return $messages;
    }
}
