<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Enum\StatusEnum;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;
use Database\Factories\Admin\Brand\BrandFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    /**
     * @use HasFactory<\Database\Eloquent\Factories\HasFactory>
     * @use SoftDeletes<\Database\Eloquent\SoftDeletes>
     */
    use HasFactory, SoftDeletes;

    public static function boot(): void
    {
        parent::boot();
        static::creating(function ($brand) {
            $brand->slug = Str::slug($brand->name);
        });

        static::updating(function ($brand) {
            $brand->slug = Str::slug($brand->name);
        });
    }

    /**
     * Summary of table
     * @var string
     */
    protected $table = 'brands';

    /**
     * Summary of fillable
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'created_by'
    ];

    /**
     * Summary of newFactory
     * @return \Database\Factories\Admin\Brand\BrandFactory
     */
    protected static function newFactory(): BrandFactory
    {
        return BrandFactory::new();
    }

    /**
     * Summary of product
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product(): HasMany
    {
        return $this->hasMany(
            Product::class,
            'brand_id',
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
            'created_by'
        );
    }

    /**
     * Summary of getBrands
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function getBrands(): LengthAwarePaginator
    {
        return self::select('brands.*', 'users.name as creator_name')
            ->join('users', 'users.id', '=', 'brands.created_by')
            ->orderBy('brands.id', 'desc')
            ->paginate('10');
    }

    /**
     * Summary of getBrand
     * @param int $id
     * @return Model
     */
    public static function getBrand(int $id): Model
    {
        return self::where('id', '=', $id)
            ->firstOrFail();
    }

    /**
     * Summary of scopeActive
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', '=', StatusEnum::Active);
    }
}
