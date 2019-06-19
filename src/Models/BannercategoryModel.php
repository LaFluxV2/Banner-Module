<?php
namespace ExtensionsValley\Banners\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannercategoryModel extends Model
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banner_category';

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
    protected $fillable = ['name', 'status', 'description'];

    public static function getBannerCategory()
    {

        return self::Where('deleted_at', NULL)->Where('status', 1)->pluck('name', 'id');
    }

    //Prevent relation breaking
    public static function getRlationstatus($cid)
    {

        $count = \DB::table('banners')->WhereIN('category_id', $cid)->WhereNull('deleted_at')->count();

        if ($count > 0) {
            return 1;
        } else {
            return 0;
        }

    }

}
