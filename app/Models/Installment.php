<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Installment extends Model
{
    use CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'number',
        'date',
        'bank_name',
        'narration',
        'contract_id',
        'status_id',
        'type_id',
        'category_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'amount' => 'decimal:2',
        'date' => 'date',
        'contract_id' => 'integer',
        'status_id' => 'integer',
        'type_id' => 'integer',
        'category_id' => 'integer',
    ];

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'status_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'category_id');
    }

    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }
}
