<?php

namespace App\Models;

use Backpack\MenuCRUD\app\Models\MenuItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends MenuItem
{
    use HasFactory;

    protected $with = ['parent','children'];
    public function hasChildren()
    {
        return $this->children()->exists();
    }
}
