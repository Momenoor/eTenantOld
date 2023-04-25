<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Contract extends Model
{
    use CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number',
        'property_id',
        'type_id',
        'status_id',
        'start_at',
        'expire_at',
        'grace_start_at',
        'grace_expire_at',
        'annual_value',
        'value',
        'discount',
        'atesting_document_number',
        'remarks',
        'conditions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'property_id' => 'integer',
        'type_id' => 'integer',
        'status_id' => 'integer',
        'start_at' => 'date',
        'expire_at' => 'date',
        'grace_start_at' => 'date',
        'grace_expire_at' => 'date',
        'annual_value' => 'decimal:2',
        'value' => 'decimal:2',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'status_id');
    }

    public function units(): BelongsToMany
    {
        return $this->belongsToMany(Unit::class);
    }

    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Tenant::class);
    }

    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }
}
