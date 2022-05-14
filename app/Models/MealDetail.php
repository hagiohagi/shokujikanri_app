<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealDetail extends Model
{
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'meal_detail';

    protected $primaryKey = 'meal_sub_id';
    protected $fillable = [
        'meal_id',
        'food',
        'ingredient',
        'amount',
        'order_num',
        'create_user_id',
        'update_user_id'
    ];

    public function mealRecord()
    {
        return $this->belongsTo(MealRecord::class, 'meal_id', 'meal_id');
    }
}
