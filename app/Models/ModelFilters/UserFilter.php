<?php 
/**
 * UserFilter Class Doc Comment
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
 * UserFilter Class Doc Comment
 * 
 * PHP version 5
 * 
 * @category Filter
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */
class UserFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * Filter by user type
     * 
     * @param int $id user type ID
     * 
     * @return \App\Models\User
     */
    public function type($id)
    {
        return $this->where('user_type_id', $id);
    }

    /**
     * Filter by country
     * 
     * @param int $id country ID
     * 
     * @return \App\Models\User
     */
    public function country($id)
    {
        return $this->where('country_id', $id);
    }

    /**
     * Filter by date from 
     * 
     * @param int $date date from
     * 
     * @return \App\Models\User
     */
    public function from($date)
    {
        return $this->whereDate('validity_date', '>=', Carbon::createFromFormat('d.m.Y', $date)->format('Y-m-d'));
    }

    /**
     * Filter by date to 
     * 
     * @param int $date date to
     * 
     * @return \App\Models\User
     */
    public function to($date)
    {
        return $this->whereDate('validity_date', '<=', Carbon::createFromFormat('d.m.Y', $date)->format('Y-m-d'));
    }

    /**
     * Filter by name
     * 
     * @param int $name user first_name/last_name/company
     * 
     * @return \App\Models\User
     */
    public function name($name)
    {
        return $this->where(
            function ($q) use ($name) {
                return $q->where('first_name', 'LIKE', "%$name%")
                    ->orWhere('last_name', 'LIKE', "%$name%")
                    ->orWhere('company', 'LIKE', "%$name%");
            }
        );
    }
}
