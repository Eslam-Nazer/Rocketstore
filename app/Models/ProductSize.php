<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSize extends Model
{
    /**
     * @use HasFactory<\Illuminate\Database\Eloquent\Factories\HasFactory>
     * @use SoftDeletes<\Illuminate\Database\Eloquent\SoftDeletes>
     */
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'product_sizes';

    /**
     * @var array<string>
     */
    protected $fillable = [
        'product_id',
        'name',
        'size',
        'price'
    ];

    /**
     * Summary of product
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(
            Product::class,
            'product_id',
            'id'
        );
    }
}
