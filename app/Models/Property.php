<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Property extends Model
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
        'code',
        'floor_count',
        'makani',
        'premises',
        'condition',
        'address',
        'emirate',
        'description',
        'type_id',
        'landlord_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type_id' => 'integer',
        'landlord_id' => 'integer',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function landlord(): BelongsTo
    {
        return $this->belongsTo(Landlord::class);
    }

    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }
}
