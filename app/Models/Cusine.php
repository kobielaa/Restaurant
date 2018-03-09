<?php
/**
 * Cusine Class Doc Comment
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

use App\Models\Advert;
use App\Models\AdvertType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Cusine Class Doc Comment
 * 
 * @category Model
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */
class Cusine extends Model
{
    use SoftDeletes;
    use Sluggable;
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
    ];

    /**
     * Get number of adverts in this category.
     * 
     * @param string $param1 URL segment 2
     * @param string $param2 URL segment 3
     * @param string $param3 URL segment 4
     * @param string $param4 URL segment 5
     * 
     * @return int
     */
    public function advertsCount($param1 = null, $param2 = null, $param3 = null, $param4 = null)
    {
        $query = Advert::query();
        if ($param1 != null && $param1 != 'all') {
            $advertType = AdvertType::where('slug', $param1)->firstOrFail();
            $query = $query->where('advert_type_id', $advertType->id);
        }
        $query = $query->where('cusine_id', '=', $this->id);
        return $query->count();
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
