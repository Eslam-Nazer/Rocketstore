<?php

namespace App\Models;

use App\Enum\StatusEnum;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\Admin\SubCategory\SubCategoryFactory;

class SubCategory extends Model
{
    /**
     * @use HasFactory<\Database\Eloquent\Factories\HasFactory>
     * @use SoftDeletes<\Database\Eloquent\SoftDeletes>
     */
    use HasFactory, SoftDeletes;

    public static function boot()
    {
        parent::boot();
        static::creating(function ($subCategory) {
            $subCategory->slug = Str::slug($subCategory->name);
        });

        static::updating(function ($subCategory) {
            $subCategory->slug = Str::slug($subCategory->name);
        });
    }

    /**
     * Summary of table
     * @var string
     */
    protected $table = 'sub_categories';

    /**
     * Summary of fillable
     * @var array|list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'created_by',
        'category_id'
    ];

    /**
     * Summary of newFactory
     * @return \Database\Factories\Admin\SubCategory\SubCategoryFactory
     */
    protected static function newFactory(): SubCategoryFactory
    {
        return SubCategoryFactory::new();
    }


    /**
     * Summary of product
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product(): HasMany
    {
        return $this->hasMany(
            Product::class,
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

    /**
     * Summary of getSubCategories
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function getSubCategories(): LengthAwarePaginator
    {
        return self::select('sub_categories.*', 'categories.name as category_name', 'users.name as username')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->join('users', 'users.id', '=', 'sub_categories.created_by')
            ->orderBy('id', 'desc')
            ->paginate('10');
    }

    /**
     * Summary of getSubCategory
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function getSubCategory(int $id): Model
    {
        return self::select('sub_categories.*')
            ->where('sub_categories.id', '=', $id)
            ->firstOrFail();
    }

    /**
     * Summary of scopeActive
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $conditions
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive(Builder $query, array $conditions = []): Builder
    {
        if (filled($conditions)) {
            $query->where([$conditions]);
        }

        $query->where('status', '=', StatusEnum::Active);
        return $query;
    }
}
