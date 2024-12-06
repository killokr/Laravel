<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UserModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserModel query()
 * @mixin \Eloquent
 */
class UserModel extends Model
{
    use HasFactory;
    // 关联数据表
    protected $table = 'info';
    // 主键
    protected $primaryKey = 'id';
    protected $fillable = ['username','email'];
    public $timestamps = false;
}
