<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Tenant extends Model
{
    use CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'type_id',
        'gender_id',
        'birth_at',
        'nationality',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type_id' => 'integer',
        'gender_id' => 'integer',
        'birth_at' => 'datetime',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'gender_id');
    }

    public function contracts(): BelongsToMany
    {
        return $this->belongsToMany(Contract::class);
    }

    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
