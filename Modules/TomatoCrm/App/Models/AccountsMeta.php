<?php

namespace Modules\TomatoCrm\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $account_id
 * @property integer $model_id
 * @property string $model_type
 * @property string $key
 * @property mixed $value
 * @property string $created_at
 * @property string $updated_at
 * @property Account $account
 */
class AccountsMeta extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['account_id', 'model_id', 'model_type', 'key', 'value', 'created_at', 'updated_at'];

    protected $casts = [
        'value' => 'array',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo('Modules\TomatoCrm\App\Models\Account');
    }
}
