<?php
/**
 * Country Class Doc Comment
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

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Country Class Doc Comment
 * 
 * @category Model
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */
class Country extends Model
{
    use Sluggable;
    use \Dimsav\Translatable\Translatable;

    protected $with = ['translations'];
    public $translatedAttributes = [
        'name'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'iso', 
        'iso3', 
        'continent',
        'slug',
    ];

    /**
     * The attributes that should be visible in arrays..
     *
     * @var array
     */
    protected $visible = [
        'id',
        'iso',
        'iso3',
        'continent',
        'name',
        'slug',
    ];

    /**
     * Get cities that belongs to the country.
     * 
     * @return \App\Models\Country
     */
    public function cities()
    {
        // return $this->hasMany('App\Models\City', 'country_id');
        return $this->hasMany('App\Models\City');
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
