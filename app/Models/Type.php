<?php

namespace App\Models;

use App\Enums\TypeEnum;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'name',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'key' => TypeEnum::class,
    ];

    public function scopeProperty($query)
    {
        $query->where('key', TypeEnum::PropertyType->name);
    }
    public function scopeContract($query)
    {
        $query->where('key', TypeEnum::ContractType->name);
    }
    public function scopeRecieptLine($query)
    {
        $query->where('key', TypeEnum::RecieptLineType->name);
    }
    public function scopeUnit($query)
    {
        $query->where('key', TypeEnum::UnitType->name);
    }
    public function scopeTenant($query)
    {
        $query->where('key', TypeEnum::TenantType->name);
    }
    public function scopeInstallment($query)
    {
        $query->where('key', TypeEnum::InstallmentType->name);
    }
    public function scopeDocument($query)
    {
        $query->where('key', TypeEnum::DocumentType->name);
    }
}
