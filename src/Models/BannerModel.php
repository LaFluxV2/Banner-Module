<?php
namespace ExtensionsValley\Banners\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannerModel extends Model
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banners';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'link', 'status', 'category_id', 'ordering', 'media'];

    public static function getNews()
    {

        return self::Where('deleted_at', NULL)->Where('status', 1)->lists('title', 'id');
    }

    public static function getAllBannersWithType($position,$type){

        $result = \DB::table('banner_category as T')
            ->leftjoin('banners as I','I.category_id','=','T.id')
            ->WhereNull('I.deleted_at')
            ->WhereNull('T.deleted_at')
            ->Where('T.status',1)
            ->Where('I.status',1)
            ->Where('I.category_id',$type)
            ->orderBy('ordering','ASC')
            ->get(['I.id','I.name','I.description','I.media','I.link']);
        return $result;
    }

    //Prevent relation breaking
    public static function getRlationstatus($cid)
    {
        return 0;
    }

}
