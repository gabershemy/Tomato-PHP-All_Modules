<?php

namespace Modules\TomatoPms\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $project_id
 * @property string $key
 * @property mixed $value
 * @property string $type
 * @property string $group
 * @property string $created_at
 * @property string $updated_at
 * @property Project $project
 */
class ProjectsMeta extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['project_id', 'key', 'value', 'type', 'group', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
