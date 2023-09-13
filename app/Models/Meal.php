<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Meal extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','vegan'];

    /**
     * The additives that belong to the meal.
     */
    public function additives(): BelongsToMany
    {
        return $this->belongsToMany(Additive::class);
    }
}
