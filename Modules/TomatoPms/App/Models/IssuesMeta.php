<?php

namespace Modules\TomatoPms\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $issue_id
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
 * @property Issue $issue
 * @property Issue $linkedIssue
 * @property User $user
 */
class IssuesMeta extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['issue_id', 'user_id', 'linked_id', 'model', 'model_id', 'key', 'value', 'type', 'group', 'created_at', 'updated_at'];

    protected $casts = [
        'value' => 'json',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function issue()
    {
        return $this->belongsTo('Modules\TomatoPms\App\Models\Issue');
    }

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
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
