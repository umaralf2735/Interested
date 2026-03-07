<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueueTicket extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'queue_number', 'status', 'called_at'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
