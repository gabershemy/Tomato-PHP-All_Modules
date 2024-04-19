<?php

namespace Modules\TomatoWallet\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property mixed $name
 * @property mixed $description
 * @property string $color
 * @property string $icon
 * @property string $created_at
 * @property string $updated_at
 * @property Payment[] $payments
 */
class PaymentStatus extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'description'];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment_status';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'color', 'icon', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany('Modules\TomatoWallet\App\Models\Payment');
    }
}
