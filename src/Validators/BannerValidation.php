<?php
namespace ExtensionsValley\Banners\Validators;

class BannerValidation
{

    public function getRules()
    {
        return [
            'name' => 'required|max:200|unique:banners',
            'description' => 'required',
            'status' => 'required',
            'ordering' => 'required|integer',
            'media' => 'required|max:10000|mimes:jpeg,jpg,png,gif',
        ];
    }

    public function getUpdateRules($banner)
    {
        return [
            'name' => 'required|max:200|unique:banners,name,' . $banner->id,
            'description' => 'required',
            'status' => 'required',
            'ordering' => 'required|integer',
            'media' => 'max:10000|mimes:jpeg,jpg,png,gif',
        ];
    }

}
