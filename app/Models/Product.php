<?php

namespace App\Models;

use App\Models\Services\{Sale, Searchable};
use App\Models\Services\{SearchableTrait, SaleTrait, ImageTrait};
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models
 */
class Product extends Model implements Searchable, Sale
{
    use SearchableTrait, SaleTrait {
        SaleTrait::getId insteadof SearchableTrait;
    }
    use ImageTrait;

    protected $fillable = ['id', 'name', 'images', 'description', 'price', 'category_id'];

    protected $hidden = ['updated_at'];

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPriceAttribute($value): float
    {
        return (float) $value;
    }
}
