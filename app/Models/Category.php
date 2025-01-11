<?php

namespace App\Models;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Database\Factories\Admin\Category\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
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
    protected $table = 'categories';

    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'created_by',
    ];

    /**
     * Summary of newFactory
     * @return \Database\Factories\Admin\Category\CategoryFactory
     */
    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }

    /**
     * Summary of createdByUser
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function createdByUser(): HasMany
    {
        return $this->hasMany(User::class, 'created_by');
    }

    /**
     * Summary of subCategory
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'category_id', 'id');
    }

    /**
     * Summary of product
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'category_id', 'id');
    }

    /**
     * Summary of getCategories
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function getCategories(): LengthAwarePaginator
    {
        return self::select('categories.*', 'users.name as creator_name')
            ->join('users', 'users.id', '=', 'categories.created_by')
            ->orderBy('categories.id', 'desc')
            ->paginate(10);
    }

    /**
     * Summary of getCategory
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function getCategory(int $id): Model
    {
        return self::select('categories.*')
            ->where('categories.id', '=', $id)
            ->firstOrFail();
    }
}
