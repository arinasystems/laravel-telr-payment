<?php

namespace ArinaSystems\TelrLaravelPayment\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Transaction Model
 *
 * @property string $ref
 * @property float $amount
 * @property string $description
 * @property int $payable_id
 * @property string $payable_type
 * @property string $status
 * @property string $trx_reference
 * @property \stdClass $request
 * @property \stdClass $response
 * @property \Illuminate\Database\Eloquent\Model|null $payable
 * @method \Illuminate\Database\Eloquent\Relations\MorphTo payable() Get the payable model.
 */
class Transaction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'amount',
        'description',
        'payable_id',
        'payable_type',
        'status',
        'trx_reference',
        'request',
        'response',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'request'  => 'object',
        'response' => 'object',
    ];

    /**
     * ----------------------------------------------------------------- *
     * --------------------------- Relations --------------------------- *
     * ----------------------------------------------------------------- *.
     */

    /**
     * Get the payable model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function payable()
    {
        return $this->morphTo('payable');
    }
}
