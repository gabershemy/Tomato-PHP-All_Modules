<?php

namespace Modules\TomatoPms\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\TomatoCategory\App\Models\Type;

/**
 * @property integer $id
 * @property integer $reporter_id
 * @property integer $project_id
 * @property integer $account_id
 * @property integer $closed_by_id
 * @property integer $last_update_by
 * @property integer $sprint_id
 * @property integer $parent_id
 * @property string $type
 * @property string $status
 * @property string $priority
 * @property string $summary
 * @property string $description
 * @property float $points
 * @property string $icon
 * @property string $color
 * @property string $closed_at
 * @property string $last_update_at
 * @property integer $order
 * @property boolean $is_closed
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Account $account
 * @property User $user
 * @property Project $project
 * @property Sprint $sprint
 * @property Type[] $types
 * @property IssuesMeta[] $issuesMetas
 * @property Timer[] $timers
 * @property TimersMeta[] $timersMetas
 */
class Issue extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['reporter_id', 'project_id', 'account_id', 'closed_by_id', 'last_update_by', 'sprint_id', 'parent_id', 'type', 'status', 'priority', 'summary', 'description', 'points', 'icon', 'color', 'closed_at', 'last_update_at', 'order', 'is_closed', 'created_at', 'updated_at', 'deleted_at'];

    public function parent()
    {
        return $this->belongsTo(Issue::class, 'parent_id');
    }

    public function getType()
    {
        return $this->belongsTo(Type::class, 'type', 'key');
    }

    public function getStatus()
    {
        return $this->belongsTo(Type::class, 'status', 'key');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(config('tomato-crm.model'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function closedBy()
    {
        return $this->belongsTo('App\Models\User', 'closed_by_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lastUpdateBy()
    {
        return $this->belongsTo('App\Models\User', 'last_update_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reporter()
    {
        return $this->belongsTo('App\Models\User', 'reporter_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sprint()
    {
        return $this->belongsTo('Modules\TomatoPms\App\Models\Sprint');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function employees()
    {
        return $this->belongsToMany('App\Models\User', 'issues_has_employees', null, 'employee_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function labels()
    {
        return $this->belongsToMany(Type::class, 'issues_has_labels', null, 'label_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function issuesMetas()
    {
        return $this->hasMany('Modules\TomatoPms\App\Models\IssuesMeta');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function linkedMeta()
    {
        return $this->hasMany('Modules\TomatoPms\App\Models\IssuesMeta', 'linked_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timers()
    {
        return $this->hasMany('Modules\TomatoPms\App\Models\Timer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function linkedTimersMetas()
    {
        return $this->hasMany('Modules\TomatoPms\App\Models\TimersMeta', 'linked_id');
    }

    public function logs()
    {
        return $this->morphMany(IssuesUserLog::class, 'model');
    }

    public function childrens()
    {
        return $this->hasMany(Issue::class, 'parent_id');
    }
}
