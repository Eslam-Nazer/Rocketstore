<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Color;
use App\Models\SubCategory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * @use HasFactory<\Database\Factories\UserFactory>
     * @use SoftDeletes<\Database\Eloquent\SoftDeletes>
     */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Summary of brand
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function brand(): HasMany
    {
        return $this->hasMany(
            Brand::class,
            'created_by',
            'id'
        );
    }

    /**
     * Summary of subCategory
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subCategory(): HasMany
    {
        return $this->hasMany(
            SubCategory::class,
            'created_by',
            'id'
        );
    }

    /**
     * Summary of category
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function category(): HasMany
    {
        return $this->hasMany(
            Category::class,
            'created_by',
            'id'
        );
    }

    /**
     * Summary of product
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product(): HasMany
    {
        return $this->hasMany(
            Product::class,
            'created_by',
            'id'
        );
    }

    /**
     * Summary of color
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function color(): HasMany
    {
        return $this->hasMany(
            Color::class,
            'created_by',
            'id'
        );
    }

    /**
     * Summary of getAminds
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function getAminds(): LengthAwarePaginator
    {
        return self::select('users.*')
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    /**
     * Summary of getSingleAdmin
     * @param int $id
     */
    public static function getSingleAdmin(int $id)
    {
        return self::where('id', '=', $id)->firstOrFail();
    }
}
