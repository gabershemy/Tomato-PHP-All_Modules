<?php

namespace Modules\TomatoPms\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $timer_id
 * @property integer $user_id
 * @property integer $linked_id
 * @property string $model
 * @property integer $model_id
 * @property string $key
 * @property mixed $value
 * @property string $type
 * @property string $group
 * @property string $created_at
 * @property string $updated_at
 * @property Issue $linkedIssue
 * @property Timer $timer
 * @property User $user
 */
class TimersMeta extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['timer_id', 'user_id', 'linked_id', 'model', 'model_id', 'key', 'value', 'type', 'group', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function linkedIssue()
    {
        return $this->belongsTo('Modules\TomatoPms\App\Models\Issue', 'linked_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function timer()
    {
        return $this->belongsTo('Modules\TomatoPms\App\Models\Timer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
