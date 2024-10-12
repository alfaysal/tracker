<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VaccineCenter extends Model
{
    use HasFactory;

    protected $table = 'vaccine_centers';
    protected $fillable = [
        'name',
        'user_limit_per_day'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
