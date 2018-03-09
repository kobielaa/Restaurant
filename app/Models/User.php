<?php
/**
 * User Class Doc Comment
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

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPassword as ResetPasswordNotification;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use EloquentFilter\Filterable;

/**
 * User Class Doc Comment
 * 
 * @category Model
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes, EntrustUserTrait {
        SoftDeletes::restore insteadof EntrustUserTrait;
        EntrustUserTrait::restore insteadof SoftDeletes;
    }
    use Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 
        'gender_id',
        'language_id', 
        'user_type_id',        
        'first_name', 
        'last_name', 
        'birth_date',       
        'phone',
        'fax',
        'website',
        'company',
        'nip',
        'specialization_id',
        'specialization_description',
        'cusine_id',
        'country_id', 
        'city_id', 
        'other_city',
        'zip', 
        'street',
        'home_no', 
        'description', 
        'job_id', 
        'job_desc',
        'job_address',
        'password',
        'enabled',
        'validity_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param string $token security token
     * 
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Returns user avatar.
     *
     * @return string URL
     */
    public function getAvatarUrl()
    {
        return "https://www.gravatar.com/avatar/" . md5($this->email) . "?d=mm";
    }

    /**
     * Get the country that the user belongs to.
     * 
     * @return \App\Models\Country
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    /**
     * Get the city that the user belongs to.
     * 
     * @return \App\Models\City
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    /**
     * Get the user type.
     * 
     * @return \App\Models\UserType
     */
    public function type()
    {
        return $this->belongsTo('App\Models\UserType', 'user_type_id');
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
     * Get the specialization.
     * 
     * @return \App\Models\Specialization
     */
    public function specialization()
    {
        return $this->belongsTo('App\Models\Specialization', 'specialization_id');
    }

    /**
     * Get the gender.
     * 
     * @return \App\Models\Gender
     */
    public function gender()
    {
        return $this->belongsTo('App\Models\Gender', 'gender_id');
    }

    /**
     * Get the job.
     * 
     * @return \App\Models\Job
     */
    public function job()
    {
        return $this->belongsTo('App\Models\Job', 'job_id');
    }

    /**
     * Get the model filter.
     * 
     * @return App\Models\ModelFilters\UserFilter
     */
    public function modelFilter()
    {
        return $this->provideFilter(ModelFilters\UserFilter::class);
    }
}
