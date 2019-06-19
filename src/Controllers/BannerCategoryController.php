<?php
namespace ExtensionsValley\Banners;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use ExtensionsValley\Banners\Validators\BannerCategoryValidation;
use ExtensionsValley\Banners\Models\BannercategoryModel;

class BannerCategoryController extends Controller
{

    public function __construct()
    {
    }

    public function addCategory()
    {
        $title = 'Add New Category';
        return \View::make('Banners::banners.categoryform', compact('title'));
    }

    /**
     * Create a new group instance after a valid registration.
     *
     * @param  array $data
     * @return group
     */
    protected function saveCategory()
    {

        $validation = \Validator::make(\Input::all(), with(new BannerCategoryValidation)->getRules());

        if ($validation->fails()) {
            return redirect()->route('extensionsvalley.admin.addbannercategory',['accesstoken'=>\Input::get('accesstoken')])->withErrors($validation)->withInput();
        }

        $name = \Input::get('name');
        $description = \Input::get('description');
        $status = \Input::get('status');

        BannercategoryModel::create([
            'name' => $name,
            'status' => $status,
            'description' => $description,
        ]);


        return redirect('admin/ExtensionsValley/Banners/list/bannercategory')
        ->with(['message' => 'Details added successfully!']);
    }

    public function editCategory($id)
    {
        $title = 'Edit Category';
        $category = BannercategoryModel::findOrFail($id);
        return \View::make('Banners::banners.categoryform', compact('title', 'category'));
    }

    public function updateCategory(Request $request)
    {
        $category_id = $request->input('category_id');
        $name = $request->input('name');
        $description = \Input::get('description');
        $status = \Input::get('status');

        $category = BannercategoryModel::findOrFail($category_id);
        $validation = \Validator::make($request->only('category_id', 'name', 'status', 'description')
            , with(new BannerCategoryValidation)->getUpdateRules($category));
        if ($validation->fails()) {
            return redirect()->route('extensionsvalley.admin.editbannercategory', ['id' => $category->id,'accesstoken'=>\Input::get('accesstoken')])->withErrors($validation)->withInput();
        }

        BannercategoryModel::Where('id', $category->id)->update(['name' => $name
            , 'status' => $status
            , 'description' => $description,

        ]);

        return redirect('admin/ExtensionsValley/Banners/list/bannercategory')
            ->with(['message' => 'Details updated successfully!']);
    }

        public function viewbannerCategory($id)
    {

        $title = 'View Banner Category';
        $category = BannercategoryModel::findOrFail($id);
        $viewmode = 'view';
        return \View::make('Banners::banners.categoryform', compact('title', 'category', 'viewmode'));
    }
}
