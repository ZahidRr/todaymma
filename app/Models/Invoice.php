<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    // Bebaskan pengisian massal
    protected $guarded = [];

    // Tagihan ini milik siapa?
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Tagihan ini diverifikasi oleh Admin siapa?
    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}