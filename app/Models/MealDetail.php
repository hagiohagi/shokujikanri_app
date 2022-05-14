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
    protected $guarded = ['meal_id'];

    public function mealRecord()
    {
        return $this->belongsTo(MealRecord::class, 'meal_id', 'meal_id');
    }
}
