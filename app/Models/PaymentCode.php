<?php
/**
 * PaymentCode Class Doc Comment
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
use EloquentFilter\Filterable;

/**
 * PaymentCode Class Doc Comment
 * 
 * @category Model
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */
class PaymentCode extends Model
{
    use Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'agent_id',
        'country_id',
        'enabled',
        'usage_date',
        'payment_type_id',
        'payment_period_id',
        'user_id', 
        'advert_id', 
        'batch',
        'multicode', 
        'from_date',
        'to_date',
        'counter',
    ];

    /**
     * Get the agent that is bound to this code.
     * 
     * @return \App\Models\User
     */
    public function agent()
    {
        return $this->belongsTo('App\Models\User', 'agent_id');
    }

    /**
     * Get the user that user used.
     * 
     * @return \App\Models\User
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Get the PaymentType that Code belongs to.
     * 
     * @return \App\Models\PaymentType
     */
    public function type()
    {
        return $this->belongsTo('App\Models\PaymentType', 'payment_type_id');
    }

    /**
     * Get the PaymentPeriod that Code belongs to.
     * 
     * @return \App\Models\PaymentPeriod
     */
    public function period()
    {
        return $this->belongsTo('App\Models\PaymentPeriod', 'payment_period_id');
    }

    /**
     * Get the Advertisment that Code was used to.
     * 
     * @return \App\Models\PaymentPeriod
     */
    public function advert()
    {
        return $this->belongsTo('App\Models\Advert', 'advert_id');
    }

    /**
     * Get the Advertisment that Code was used to.
     * 
     * @return \App\Models\PaymentPeriod
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    /**
     * Get the model filter.
     * 
     * @return App\Models\ModelFilters\PaymentCodeFilter
     */
    public function modelFilter()
    {
        return $this->provideFilter(ModelFilters\PaymentCodeFilter::class);
    }
}
