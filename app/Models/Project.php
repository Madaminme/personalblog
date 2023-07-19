<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'client',
        'url',
        'type_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'completed_at' => 'datetime:Y-m-d'
    ];

    public function types():BelongsToMany
    {
        return $this->belongsToMany(Type::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class,'project_tags');
    }
}
