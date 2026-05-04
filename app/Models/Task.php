<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    // Tugas ini milik pelanggan siapa?
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Tugas ini dikerjakan oleh teknisi (user) siapa?
    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }
}