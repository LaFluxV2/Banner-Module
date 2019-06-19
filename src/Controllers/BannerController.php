<?php
namespace ExtensionsValley\Banners;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use ExtensionsValley\Banners\Validators\BannerValidation;
use ExtensionsValley\Banners\Models\BannerModel;

class BannerController extends Controller
{

    public function __construct()
    {
    }

    public function addBanner()
    {

        $title = 'Add New Banner';

        return \View::make('Banners::banners.bannerform', compact('title'));
    }

    /**
     * Create a new group instance after a valid registration.
     *
     * @param  array $data
     * @return group
     */
    protected function saveBanner(Request $request)
    {

        $validation = \Validator::make(\Input::all(), with(new BannerValidation)->getRules());

        if ($validation->fails()) {
            return redirect()->route('extensionsvalley.admin.addbanners',['accesstoken'=>\Input::get('accesstoken')])->withErrors($validation)->withInput();
        }

        $name = \Input::get('name');
        $description = \Input::get('description');
        $media = "Null";
        $status = \Input::get('status');
        $ordering = \Input::get('ordering');
        $category_id = \Input::get('category_id');
        $link = \Input::get('link');



        $result = BannerModel::create([
            'name' => $name,
            'status' => $status,
            'description' => $description,
            'media' => $media,
            'category_id' => $category_id,
            'ordering' => $ordering,
            'link' => $link,
        ]);

        //file validation
        if ($request->hasFile('media')) {
            if ($request->file('media')->isValid()) {
                $destination = "packages/extensionsvalley/banners/" . $result->id . "/";
                if (!is_dir($destination)) {
                    mkdir($destination, 0777, true);
                }
                $request->file('media')->move($destination . "/", $result->id . '.' . $request->file('media')->getClientOriginalExtension());
                $file_name = $destination . $result->id . '.' . $request->file('media')->getClientOriginalExtension();
                BannerModel::Where('id', $result->id)->update(['media' => $file_name]);
            }
        }

        return redirect('admin/ExtensionsValley/Banners/list/banners')->with(['message' => 'Details added successfully!']);
    }

    public function editBanner($id)
    {

        $title = 'Edit Banner';
        $banner = BannerModel::findOrFail($id);
        return \View::make('Banners::banners.bannerform', compact('title', 'banner'));
    }

    public function updateBanner(Request $request)
    {

        $banner_id = $request->input('banner_id');
        $name = $request->input('name');
        $description = \Input::get('description');
        $status = \Input::get('status');
        $ordering = \Input::get('ordering');
        $category_id = \Input::get('category_id');
        $link = \Input::get('link');


        $accesstoken = $request->input('accesstoken');

        $banner = BannerModel::findOrFail($banner_id);
        $validation = \Validator::make($request->only('banner_id', 'name', 'status', 'description', 'category_id', 'ordering', 'media')
            , with(new BannerValidation)->getUpdateRules($banner));

        if ($validation->fails()) {
            return redirect()->route('extensionsvalley.admin.editbanners', ['id' => $banner->id,'accesstoken' => $accesstoken])->withErrors($validation)->withInput();
        }

        //file validation
        $file_name = $banner->media;
        if ($request->hasFile('media')) {
            if ($request->file('media')->isValid()) {
                $destination = "packages/extensionsvalley/banners/" . $banner->id . '/';
                $request->file('media')->move($destination, $banner->id . '.' . $request->file('media')->getClientOriginalExtension());
                $file_name = $destination . $banner->id . '.' . $request->file('media')->getClientOriginalExtension();
            }
        }

        BannerModel::Where('id', $banner->id)->update(['name' => $name
            , 'status' => $status
            , 'description' => $description
            , 'category_id' => $category_id
            , 'media' => $file_name
            , 'ordering' => $ordering
            , 'link' => $link
        ]);

        return redirect('admin/ExtensionsValley/Banners/list/banners')
            ->with(['message' => 'Details updated successfully!']);
    }


public function viewBanners($id)
    {

        $title = 'View Banner';
        $banner = BannerModel::findOrFail($id);
        $viewmode = 'view';
        return \View::make('Banners::banners.bannerform', compact('title', 'banner', 'viewmode'));
    }

}
