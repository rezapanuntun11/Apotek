<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id',
        'insurance_price',
        'shipping_price',
        'total_price',
        'transaction_status',
        'code',
        'service',
        'courier',
        'phone_number',
        'country',
        'provinces_id',
        'regencies_id',
        'zip_code',
        'address_one',
        'address_two',
        'resi',
        'midtrans'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    // transaction detail
    public function transactiondetails()
    {
        return $this->hasMany(TransactionDetail::class, 'transactions_id', 'id');
    }
}
