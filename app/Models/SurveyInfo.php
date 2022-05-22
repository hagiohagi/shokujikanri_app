<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyInfo extends Model
{

    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'survey_info';
    
    protected $connection = 'sqlite';

    protected $primaryKey = 'survey_id';

    protected $fillable = [
        'survey_name',
        'term',
        'era',
        'sex',
        'sport',
        'research_number',
        'create_user_id',
        'update_user_id',
    ];



    public function users()
    {
        return $this->belongsToMany(User::class, 'user_survey_mapping');
    }
}
