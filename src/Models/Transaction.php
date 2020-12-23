<?php

namespace ArinaSystems\TelrLaravelPayment\Models;

use Illuminate\Database\Eloquent\Model;

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
        'ref',
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
