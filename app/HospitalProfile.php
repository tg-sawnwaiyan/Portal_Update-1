<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HospitalProfile extends Model
{
    protected $table = 'hospital_profiles';
    protected $fillable = ['profile_id','access','medical_department','specialist','gallery','details_info','subject','closed_day','facilities','website','special_features','latitude','longitude','congestion'];
}
