<?php
/**
 * Advert Class Doc Comment
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
use EloquentFilter\Filterable;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Advert Class Doc Comment
 * 
 * @category Model
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */
class Advert extends Model
{
    use SoftDeletes;
    use Filterable;
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'advert_type_id',
        'advert_category_id',  
        'user_id',
        'add_date',
        'validity_date',      
        'first_name', 
        'last_name',
        'company', 
        'email',        
        'phone', 
        'mobile', 
        'fax',       
        'website',
        'language_id',
        'country_id',
        'city_id',
        'zip',
        'street',
        'home_no',
        'cusine_id', 
        'wifi', 
        'smoking',
        'text', 
        'promotion',
        'discount',
        'payment_period_id',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'image_5',
        'image_6',
        'show', 
        'enabled',
        'slug',
    ];

    /**
     * Get the country that advert belongs to.
     * 
     * @return \App\Models\Country
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    /**
     * Get the city that advert belongs to.
     * 
     * @return \App\Models\City
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    /**
     * Get the advert type.
     * 
     * @return \App\Models\AdvertType
     */
    public function type()
    {
        return $this->belongsTo('App\Models\AdvertType', 'advert_type_id');
    }
    
    /**
     * Get the language.
     * 
     * @return \App\Models\Language
     */
    public function language()
    {
        return $this->belongsTo('App\Models\Language', 'language_id');
    }

    /**
     * Get the cusine.
     * 
     * @return \App\Models\Cusine
     */
    public function cusine()
    {
        return $this->belongsTo('App\Models\Cusine', 'cusine_id');
    }
    
    /**
     * Get the user that is owner of this advert.
     * 
     * @return \App\Models\User
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Get the advert category.
     * 
     * @return \App\Models\AdvertCategory
     */
    public function category()
    {
        return $this->belongsTo('App\Models\AdvertCategory', 'advert_category_id');
    }

    /**
     * Get the payment pariod.
     * 
     * @return \App\Models\PaymentPeriod
     */
    public function paymentPeriod()
    {
        return $this->belongsTo('App\Models\PaymentPeriod', 'payment_period_id');
    }

    /**
     * Get the model filter.
     * 
     * @return App\Models\ModelFilters\AdvertFilter
     */
    public function modelFilter()
    {
        return $this->provideFilter(ModelFilters\AdvertFilter::class);
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
                'source' => 'company'
            ]
        ];
    }
}
