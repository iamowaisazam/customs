<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class Setting extends Model
{
    public $timestamps = false;

    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'value',
        'section_sorting',
        'section',
        'type',
        'sort',
        'grouping',
    ];

    public static function get_locations()
    {

        $data = Setting::where('section','masters')->pluck('value','field')->toArray();

        $locations = [];
        if(isset($data['locations']) && $data['locations']){
            $locations = json_decode($data['locations']);
        }

        return $locations;
        
    }


    public static function get_pod()
    {
        $data = Setting::where('section','masters')->pluck('value','field')->toArray();
        $pod = [];
        if(isset($data['pod']) && $data['pod']){
            $pod = json_decode($data['pod']);
        }
        return $pod;   
    }

    public static function get_pol()
    {

        $data = Setting::where('section','masters')->pluck('value','field')->toArray();

        $pol = [];
        if(isset($data['pol']) && $data['pol']){
            $pol = json_decode($data['pol']);
        }

        return $pol;
        
    }

    public static function get_documents()
    {

        $data = Setting::where('section','masters')->pluck('value','field')->toArray();

        $documents = [];
        if(isset($data['documents']) && $data['documents']){
            $documents = json_decode($data['documents']);
        }

        return $documents;
        
    }

}
