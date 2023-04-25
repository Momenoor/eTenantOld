<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Document extends Model
{
    use CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_id',
        'issued_at',
        'start_at',
        'expire_at',
        'number',
        
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type_id' => 'integer',
        'issued_at' => 'date',
        'start_at' => 'date',
        'expire_at' => 'date',
    ];

    public function documentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
