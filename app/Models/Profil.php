<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profil extends Model
{
    use HasFactory;

    protected $table = 'profil';

    protected $fillable = [
        'user_id',
        'no_telepon',
        'kota',
        'kelurahan',
        'kecamatan',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
