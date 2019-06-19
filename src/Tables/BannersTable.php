<?php
namespace ExtensionsValley\Banners\Tables;

class BannersTable
{

    /**
     * The database table used by the model.
     *
     * @var string
     */

    public $page_title = "Banners";

    public $acl_key = "extensionsvalley.banners.banners";

    public $table_name = "banners";

    public $namespace = 'ExtensionsValley\Banners\Tables\BannersTable';

    public $model_name = 'ExtensionsValley\Banners\Models\BannerModel';

    public $listable = ['id' => 'ID', 'media' => 'Media', 'name' => 'Name', 'status' => 'Status','ordering' => 'Order By','category_id' => 'Category'];

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
        'add_route' => 'extensionsvalley/banners/addbanners'
        , 'edit_route' => 'extensionsvalley/banners/editbanners'
        , 'view_route' => 'extensionsvalley/banners/viewbanners'
    ];

        public $advanced_filter = ['layout' => "Banners::banners.advancedfilters.bannerfilter"
        , 'filters' => [
            'filter_category' => 'filter_category'
            , 'filter_status' => 'filter_status'
            , 'filter_trashed' => 'filter_trashed'
        ]
    ];


    public function getQuery()
    {

        $search = \Input::get('customsearch');
        $filter_trashed = \Input::get('filter_trashed');
        $filter_category = \Input::get('filter_category');
        $filter_status = \Input::has('filter_status') ? \Input::get('filter_status') : '-1';

          $banners = \DB::table('banners')
              ->select('id', 'media', 'name', 'category_id', 'ordering','status');

        if($filter_trashed == 1){
            $banners = $banners->where('deleted_at','<>', NULL);
        }else{
            $banners = $banners->where('deleted_at', NULL);
        }

        if ($filter_category > 0) {
            $banners = $banners->Where('category_id', $filter_category);
        }
        if ($filter_status != -1) {
            $banners = $banners->Where('status', $filter_status);
        }

        return \Datatables::of($banners)
            ->editColumn('sl', '<input type="checkbox"  name="cid[]" value="{{$id}}" class="cid_checkbox"/>')
            ->editColumn('media', '<span class="col-lg-3 col-centered">@if($media != "")<a href="#" data-toggle="modal" data-target="#popup_{{$id}}"><center><img src="{{Request::root()}}/{{ $media }}/<?php echo "?".rand(1,100); ?>" width="30" height="30" /></a>
				<div id="popup_{{$id}}" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">{{$name}}</h4>
				      </div>
				      <div class="modal-body">
				        @if(isset($media))<center>
				            <img src="{{Request::root()}}/{{ $media }}/<?php echo "?".rand(1,100); ?>" width="500" /></center>
				        @endif
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </div>

				  </div>
				</div>
				@else
				--
				@endif
				</span>')

            ->editColumn('category_id', '{{ExtensionsValley\Banners\Models\BannercategoryModel::Where("id",$category_id)->value("name")}}')
            // ->editColumn('end_date', '{{date("M-j-Y",strtotime($end_date))}}')
            ->editColumn('status', '@if($status==1) <span class="glyphicon glyphicon-ok"> Published</span> @else <span class="glyphicon glyphicon-remove"> Unpublished</span> @endif')
            ->make(true);
    }

}
