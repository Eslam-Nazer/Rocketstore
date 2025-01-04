<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
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
     * Summary of category
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function category(): HasMany
    {
        return $this->hasMany(Category::class, 'category_id');
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
     */
    public static function getSubCategory(int $id)
    {
        return self::select('sub_categories.*')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->join('users', 'users.id', '=', 'sub_categories.created_by')
            ->where('sub_categories.id', '=', $id)
            ->first();
    }
}
