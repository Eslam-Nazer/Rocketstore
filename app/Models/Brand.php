<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
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
     * Summary of user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'created_by');
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
}
