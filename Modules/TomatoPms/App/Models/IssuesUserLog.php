<?php

namespace Modules\TomatoPms\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $model_type
 * @property integer $model_id
 * @property string $status
 * @property string $action
 * @property string $description
 * @property mixed $data
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 */
class IssuesUserLog extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'model_type', 'model_id', 'status', 'action', 'description', 'data', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
