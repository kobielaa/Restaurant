<?php
/**
 * PaymentType Class Doc Comment
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
 * PaymentType Class Doc Comment
 * 
 * @category Model
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */
class PaymentType extends Model
{
    use SoftDeletes;
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name'];
}
