<?php 
/**
 * AdvePaymentCodeFilterrtFilter Class Doc Comment
 * 
 * PHP version 5
 * 
 * @category Filter
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */

namespace App\Models\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;

/**
 * PaymentCodeFilter Class Doc Comment
 * 
 * PHP version 5
 * 
 * @category Filter
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */
class PaymentCodeFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * Filter by country
     * 
     * @param int $id country ID
     * 
     * @return \App\Models\PaymentCode
     */
    public function country($id)
    {
        return $this->where('country_id', $id);
    }

    /**
     * Filter by Payment Type
     * 
     * @param int $id Payment Type ID
     * 
     * @return \App\Models\PaymentCode
     */
    public function paymentType($id)
    {
        return $this->where('payment_type_id', $id);
    }

    /**
     * Filter by Payment Period
     * 
     * @param int $id Payment Period ID
     * 
     * @return \App\Models\PaymentCode
     */
    public function paymentPeriod($id)
    {
        return $this->where('payment_period_id', $id);
    }

    /**
     * Filter by date from 
     * 
     * @param int $date date from
     * 
     * @return \App\Models\PaymentCode
     */
    public function validFrom($date)
    {
        return $this->whereDate('from_date', '>=', Carbon::createFromFormat('d.m.Y', $date)->format('Y-m-d'));
    }

    /**
     * Filter by date to 
     * 
     * @param int $date date to
     * 
     * @return \App\Models\PaymentCode
     */
    public function validTo($date)
    {
        return $this->whereDate('to_date', '<=', Carbon::createFromFormat('d.m.Y', $date)->format('Y-m-d'));
    }

    /**
     * Filter by usage date from
     * 
     * @param int $date date from
     * 
     * @return \App\Models\PaymentCode
     */
    public function usageDateFrom($date)
    {
        return $this->whereDate('usage_date', '>=', Carbon::createFromFormat('d.m.Y', $date)->format('Y-m-d'));
    }

    /**
     * Filter by usage date to
     * 
     * @param int $date date to
     * 
     * @return \App\Models\PaymentCode
     */
    public function usageDateTo($date)
    {
        return $this->whereDate('usage_date', '<=', Carbon::createFromFormat('d.m.Y', $date)->format('Y-m-d'));
    }

    /**
     * Filter by enabled
     * 
     * @param bool $value true/false
     * 
     * @return \App\Models\PaymentCode
     */
    public function enabled($value)
    {
        return $this->where('enabled', $value);
    }

    /**
     * Filter by multicode
     * 
     * @param bool $value true/false
     * 
     * @return \App\Models\PaymentCode
     */
    public function multicode($value)
    {
        return $this->where('multicode', $value);
    }

    /**
     * Filter by usages
     * 
     * @param bool $value int
     * 
     * @return \App\Models\PaymentCode
     */
    public function usageFrom($value)
    {
        return $this->where('usage', '>=', $value);
    }

    /**
     * Filter by usages
     * 
     * @param bool $value int
     * 
     * @return \App\Models\PaymentCode
     */
    public function usageTo($value)
    {
        return $this->where('usage', '<=', $value);
    }

    /**
     * Filter by code
     * 
     * @param string $code 
     * 
     * @return \App\Models\PaymentCode
     */
    public function code($code)
    {
        return $this->where(
            function ($q) use ($name) {
                return $q->where('code', 'LIKE', "%$code%");
            }
        );
    }
}
