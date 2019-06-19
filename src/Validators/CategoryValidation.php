<?php
namespace ExtensionsValley\Banners\Validators;

class BannerCategoryValidation
{

    public function getRules()
    {
        return [
            'name' => 'required|max:200|unique:banner_category',
            'description' => 'required',
            'status' => 'required',

        ];
    }

    public function getUpdateRules($banner)
    {
        return [
            'name' => 'required|max:200|unique:banner_category,name,' . $banner->id,
            'status' => 'required',
            'description' => 'required',
        ];
    }

}
