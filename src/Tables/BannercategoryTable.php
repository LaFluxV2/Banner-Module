<?php
namespace ExtensionsValley\Banners\Tables;


class BannercategoryTable
{

    /**
     * The database table used by the model.
     *
     * @var string
     */

    public $page_title = "Banner Categories";

    public $acl_key = "extensionsvalley.banners.bannercategory";

    public $table_name = "banner_category";

    public $namespace = 'ExtensionsValley\Banners\Tables\BannercategoryTable';

    public $model_name = 'ExtensionsValley\Banners\Models\BannercategoryModel';

    public $listable = ['id' => 'ID', 'name' => 'Name',
                         'description' => 'Description',
                         'status' => 'Status',
                         'created_at' => 'Date'];


    public $overrideview = "";

    public $show_toolbar = ['view' => 'Show'
        , 'add' => 'Add'
        , 'edit' => 'Edit'
        , 'publish' => 'Publish'
        , 'unpublish' => 'Unpublish'
        , 'trash' => 'Trash'
        , 'restore' => 'Restore'
        , 'forcedelete' => 'Force Delete'
    ];

    public $routes = [
        'add_route' => 'extensionsvalley/banners/addbannercategory'
        , 'edit_route' => 'extensionsvalley/banners/editbannercategory'
        , 'view_route' => 'extensionsvalley/banners/viewbannercategory'
    ];

    public $advanced_filter = ['layout' => ""
            ,'filters' => [
            'filter_trashed' => 'filter_trashed'
        ]
    ];


    public function getQuery()
    {
        $filter_trashed = \Input::get('filter_trashed');

        $bcats = \DB::table('banner_category')
                ->select('id', 'name', 'description', 'status', 'created_at');
        if($filter_trashed == 1){
            $bcats = $bcats->where('deleted_at','<>', NULL);
        }else{
            $bcats = $bcats->where('deleted_at', NULL);
        }

        return \Datatables::of($bcats)
            ->editColumn('sl', '<input type="checkbox" name="cid[]" value="{{$id}}" class="cid_checkbox"/>')
            ->editColumn('created_at', '{{date("M-j-Y",strtotime($created_at))}}')
            ->editColumn('status', '@if($status==1) <span class="glyphicon glyphicon-ok"> Published</span> @else <span class="glyphicon glyphicon-remove"> Unpublished</span> @endif')
            ->make(true);
    }

}
