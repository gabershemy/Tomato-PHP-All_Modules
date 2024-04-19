<?php

namespace Modules\TomatoInvoices\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $invoice_id
 * @property string $key
 * @property mixed $value
 * @property string $type
 * @property string $group
 * @property string $created_at
 * @property string $updated_at
 * @property Invoice $invoice
 */
class InvoiceMeta extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['invoice_id', 'key', 'value', 'type', 'group', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoice()
    {
        return $this->belongsTo('Modules\TomatoInvoices\App\Models\Invoice');
    }
}
