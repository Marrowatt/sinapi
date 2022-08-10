<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 'name', 'email', 'password', 'user_type_id', 'gender_id', 'api_token', 
                            'activity_level_id', 'phone', 'weight', 'height', 'birthday', 'active'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function activity_level () {
        return $this->belongsTo(ActivityLevel::class);
    }

    public function user_type () {
        return $this->belongsTo(UserType::class);
    }

    public function gender () {
        return $this->belongsTo(Gender::class);
    }

    public function wishlist () {
        return $this->hasMany(Wishlist::class);
    }

    public function nutritional_guidance () {
        return $this->hasOne(NutritionalGuidance::class);
    }

    // IMC (kg/m²)
    public function bmi () {

        $altura2 = ($this->height / 100) ** 2;

        $return = ($this->weight / 100) / $altura2;

        return round($return, 3);
    }

    // TMB Harris-Benedict (kcal)
    public function bmr_harris_benedict () {

        $weight = $this->weight / 100;
        $height = $this->height / 100;
        $age = Carbon::now()->diffInYears($this->birthday);
        
        if ($this->gender->name == "Masculino") {
            $return = 66 + (13.8 * $weight) + (5.0 * $height) - (6.8 * $age);
            return round($return, 3);
        } else {
            $return = 655 + (9.6 * $weight) + (1.9 * $height) - (4.7 * $age);
            return round($return, 3);
        }
    }

    // TMB Mifflin-St Jeor (kcal)
    public function bmr_mifflin_st_jeor () {

        $weight = $this->weight / 100;
        $height = $this->height;
        $age = Carbon::now()->diffInYears($this->birthday);
        
        if ($this->gender->name == "Masculino") {
            $return = (10 * $weight) + (6.25 * $height) - (5.0 * $age) + 5;
            return round($return, 3);
        } else {
            $return = (10 * $weight) + (6.25 * $height) - (5.0 * $age) - 161;
            return round($return, 3);
        }
    }

    // TMB - FAO / OMS (kcal)
    public function bmr_fao_oms () {

        $weight = $this->weight / 100;
        $age = Carbon::now()->diffInYears($this->birthday);

        if ($this->gender->name == "Masculino") {

            if ($age < 10) {
                $return = 0;
            } elseif ($age >= 10 && $age < 18) {
                $return = (17.686 * $weight) + 658.2;
            } elseif ($age >= 18 && $age < 30) {
                $return = (15.057 * $weight) + 692.2;
            } elseif ($age >= 30 && $age < 60) {
                $return = (11.472 * $weight) + 873.1;
            } else {
                $return = (11.711 * $weight) + 587.7;
            }

            return $return == 0 ? null : round($return, 3);
        } else {
            
            if ($age < 10) {
                $return = 0;
            } elseif ($age >= 10 && $age < 18) {
                $return = (13.384 * $weight) + 692.6;
            } elseif ($age >= 18 && $age < 30) {
                $return = (14.818 * $weight) + 486.6;
            } elseif ($age >= 30 && $age < 60) {
                $return = (8.126 * $weight) + 845.6;
            } else {
                $return = (9.082 * $weight) + 658.5;
            }

            return $return == 0 ? null : round($return, 3);
        }
    }

    // Percentual de Gordura Ideal (%)
    public function ideal_fat_percentage () {

        $sex = $this->gender->name == "Masculino" ? 1 : 0;
        $age = Carbon::now()->diffInYears($this->birthday);

        $imc = $this->bmi();

        $return = (1.20 * $imc) + (0.23 * $age) - (10.8 * $sex) - 5.4;

        return round($return, 3);
    }

    // Consumo ideal de água (L)
    public function ideal_water_consumption () {

        $weight = $this->weight / 100;

        $return = $weight * 35 / 1000;

        return round($return, 3);
    }
}
