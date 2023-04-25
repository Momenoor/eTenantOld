<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReceiptLine extends Model
{
    use CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reciept_id',
        'installment_id',
        'amount',
        'narration',
        'received_at',
        'type_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'reciept_id' => 'integer',
        'installment_id' => 'integer',
        'amount' => 'decimal:2',
        'received_at' => 'date',
        'type_id' => 'integer',
    ];

    public function reciept(): BelongsTo
    {
        return $this->belongsTo(Reciept::class);
    }

    public function installment(): BelongsTo
    {
        return $this->belongsTo(Installment::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
