<?php

namespace Modules\TomatoPms\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $project_id
 * @property integer $created_by
 * @property string $name
 * @property string $description
 * @property string $status
 * @property string $icon
 * @property string $color
 * @property string $start_date
 * @property string $end_date
 * @property string $created_at
 * @property string $updated_at
 * @property Issue[] $issues
 * @property User $user
 * @property Project $project
 */
class Sprint extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['project_id', 'created_by', 'name', 'description', 'status', 'icon', 'color', 'start_date', 'end_date', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function issues()
    {
        return $this->hasMany('Modules\TomatoPms\App\Models\Issue');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
