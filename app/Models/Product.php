<?php

namespace App\Models;

use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductSize;
use App\Models\SubCategory;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    /**
     * @use HasFactory<\Database\Eloquent\Factories\HasFactory>
     * @use SoftDeletes<\Database\Eloquent\SoftDeletes>
     */
    use HasFactory, SoftDeletes;

    /**
     * Summary of table
     * @var string
     */
    protected $table = 'products';

    /**
     * Summary of fillable
     * @var array|list<string>
     */
    protected $fillable = [
        'title',
        'sku',
        'slug',
        'price',
        'old_price',
        'short_description',
        'description',
        'additional_information',
        'shipping_returns',
        'status',
        'brand_id',
        'category_id',
        'sub_category_id',
        'created_by'
    ];

    /**
     * Summary of productImages
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productImages(): HasMany
    {
        return $this->hasMany(
            ProductImage::class,
            'product_id',
            'id'
        );
    }

    /**
     * Summary of productSize
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productSize(): HasMany
    {
        return $this->hasMany(
            ProductSize::class,
            'product_id',
            'id'
        );
    }

    /**
     * Summary of productColor
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productColor(): HasMany
    {
        return $this->hasMany(
            ProductColor::class,
            'product_id',
            'id'
        );
    }

    /**
     * Summary of brand
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(
            Brand::class,
            "brand_id",
            'id'
        );
    }

    /**
     * Summary of subCategory
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(
            SubCategory::class,
            'sub_category_id',
            'id'
        );
    }

    /**
     * Summary of category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(
            Category::class,
            'category_id',
            'id'
        );
    }

    /**
     * Summary of user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'created_by',
            'id'
        );
    }


    public static function getProducts(): LengthAwarePaginator
    {
        return self::select('products.*', 'users.name as creator_name')
            ->join('users', 'users.id', '=', 'products.created_by')
            ->orderBy('id', 'desc')
            ->paginate('10');
    }

    /**
     * Summary of getProduct
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function getProduct(int $id): Model
    {
        return self::select()
            ->where('products.id', "=", $id)
            ->firstOrFail();
    }
}
