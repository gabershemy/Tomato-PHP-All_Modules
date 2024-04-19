<?php

namespace Modules\TomatoPms\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\TomatoCategory\App\Models\Type;

/**
 * @property integer $id
 * @property integer $project_id
 * @property integer $issue_id
 * @property integer $account_id
 * @property integer $employee_id
 * @property string $type
 * @property string $status
 * @property string $color
 * @property string $icon
 * @property string $description
 * @property string $start_at
 * @property string $last_stop_at
 * @property string $last_restart_at
 * @property string $end_at
 * @property float $total_time
 * @property float $total_money
 * @property integer $rounds
 * @property boolean $is_running
 * @property boolean $is_done
 * @property boolean $is_billable
 * @property boolean $is_paid
 * @property string $created_at
 * @property string $updated_at
 * @property Account $account
 * @property User $employee
 * @property Issue $issue
 * @property Project $project
 * @property Type[] $types
 * @property TimersMeta[] $timersMetas
 */
class Timer extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['project_id', 'issue_id', 'account_id', 'employee_id', 'type', 'status', 'color', 'icon', 'description', 'start_at', 'last_stop_at', 'last_restart_at', 'end_at', 'total_time', 'total_money', 'rounds', 'is_running', 'is_done', 'is_billable', 'is_paid', 'created_at', 'updated_at'];

    protected $casts = [
        'start_at' => 'datetime',
        'last_stop_at' => 'datetime',
        'last_restart_at' => 'datetime',
        'end_at' => 'datetime',
        'is_running' => 'boolean',
        'is_done' => 'boolean',
        'is_billable' => 'boolean',
        'is_paid' => 'boolean',
    ];
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
    public function employee()
    {
        return $this->belongsTo('App\Models\User', 'employee_id');
    }

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
    public function project()
    {
        return $this->belongsTo('Modules\TomatoPms\App\Models\Project');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Type::class, 'timers_has_tags', null, 'tag_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timersMetas()
    {
        return $this->hasMany('Modules\TomatoPms\App\Models\TimersMeta');
    }
}
