<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
     * Summary of createdByUser
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function createdByUser(): HasMany
    {
        return $this->hasMany(User::class, 'created_by');
    }

    /**
     * Summary of getCategories
     * @return \Illuminate\Support\Collection
     */
    public static function getCategories(): Collection
    {
        return self::select('categories.*', 'users.name as creator_name')
            ->join('users', 'users.id', '=', 'categories.created_by')
            ->orderBy('categories.id', 'desc')
            ->get();
    }

    public static function getCategory(int $id)
    {
        return self::select('categories.*', 'users.name as creator_name')
            ->where('categories.id', '=', $id)
            ->join('users', 'users.id', '=', 'categories.id')
            ->first();
    }
}
