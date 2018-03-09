<?php
/**
 * PaymentPrice Class Doc Comment
 * 
 * PHP version 5
 * 
 * @category Model
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * PaymentPrice Class Doc Comment
 * 
 * @category Model
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */
class PaymentPrice extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price', 
        'payment_type_id', 
        'payment_period_id', 
    ];

    /**
     * Get the PaymentType that PaymentPrice belongs to.
     * 
     * @return \App\Models\PaymentType
     */
    public function type()
    {
        return $this->belongsTo('App\Models\PaymentType', 'payment_type_id');
    }

    /**
     * Get the PaymentPeriod that PaymentPrice belongs to.
     * 
     * @return \App\Models\PaymentPeriod
     */
    public function period()
    {
        return $this->belongsTo('App\Models\PaymentPeriod', 'payment_period_id');
    }
}
