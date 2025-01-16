<?php

namespace App\Models;

use App\Models\Color;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductColor extends Model
{
    /**
     * @use HasFactory<\Illuminate\Database\Eloquent\Factories\HasFactory>
     * @use SoftDeletes<\Illuminate\Database\Eloquent\SoftDeletes>
     */
    use HasFactory, SoftDeletes;

    /**
     * Summary of table
     * @var string
     */
    protected $table = 'product_colors';

    /**
     * Summary of fillable
     * @var array<string>
     */
    protected $fillable = [
        'product_id',
        'color_id'
    ];

    /**
     * Summary of product
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(
            Product::class,
            'product_id'
        );
    }

    /**
     * Summary of color
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(
            Color::class,
            'color_id',
        );
    }
}
