<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Qrcode
 * @package App\Models
 * @version December 18, 2019, 3:25 am UTC
 *
 * @property integer user_id
 * @property string website
 * @property string company_name
 * @property string product_name
 * @property string product_url
 * @property string qrcode_path
 * @property string callback_url
 * @property number amount
 * @property boolean status
 */
class Qrcode extends Model
{
    use SoftDeletes;

    public $table = 'qrcodes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'website',
        'company_name',
        'product_name',
        'product_url',
        'qrcode_path',
        'callback_url',
        'amount',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'website' => 'string',
        'company_name' => 'string',
        'product_name' => 'string',
        'product_url' => 'string',
        'qrcode_path' => 'string',
        'callback_url' => 'string',
        'amount' => 'float',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'company_name' => 'required',
        'product_name' => 'required',
        'callback_url' => 'required',
        'amount' => 'required',
        'status' => 'required'
    ];
     /**
     * Get the transactions for the Qrcode.
     */
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }
}
