<?php

namespace App\Models;

use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'slug',
        'price',
        'old_price',
        'short_description',
        'description',
        'additional_information',
        'shipping_returns',
        'status',
        'category_id',
        'sub_category_id',
        'created_by'
    ];

    /**
     * Summary of brand
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function brand(): HasMany
    {
        return $this->hasMany(Brand::class, "brand_id");
    }

    /**
     * Summary of subCategory
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subCategory(): HasMany
    {
        return $this->hasMany(SubCategory::class, 'sub_category_id');
    }

    /**
     * Summary of category
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function category(): HasMany
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    /**
     * Summary of user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'created_by');
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
