<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Pagination\LengthAwarePaginator;

class Color extends Model
{
    /**
     * @use HasFactory<\database\Eloquent\Factories\HasFactory>
     * @use SoftDeletes<\database\Eloquent\softDelete>
     */
    use HasFactory, SoftDeletes;

    /**
     * Summary of table
     * @var string
     */
    protected $table = 'colors';

    /**
     * Summary of fillable
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'code',
        'status',
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
     * Summary of getColors
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function getColors(): LengthAwarePaginator
    {
        return self::select('colors.*', 'users.name as creator_name')
            ->join('users', 'users.id', '=', 'colors.created_by')
            ->orderBy('id', 'desc')
            ->paginate('10');
    }

    /**
     * Summary of getColor
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function getColor(int $id): Model
    {
        return self::select('colors.*')
            ->where('id', '=', $id)
            ->firstOrFail();
    }
}
