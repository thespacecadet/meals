<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Additive extends Model
{

    protected $fillable = ['nr','name'];
    use HasFactory;

    /**
     * The meals that belong to the additive.
     */
    public function meals(): BelongsToMany
    {
        return $this->belongsToMany(Meal::class);
    }
}
