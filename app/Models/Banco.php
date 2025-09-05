<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Banco extends Model
{
    /** @use HasFactory<\Database\Factories\BancosFactory> */
    use HasFactory;

    protected $table = 'bancos';

    public function contaBancaria(): HasMany
    {
        return $this->hasMany(ContaBancaria::class, 'banco_id');
    }
}
