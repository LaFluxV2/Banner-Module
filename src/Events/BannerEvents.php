<?php
namespace ExtensionsValley\Banners\Events;

\Event::listen('admin.menu.groups', function ($collection) {

    $collection->put('extensionsvalley.banners', [
        'menu_text' => 'Banner Panel'
        , 'menu_icon' => '<i class="fa fa-flag"></i>'
        , 'acl_key' => 'extensionsvalley.banners.bannerpannel'
        , 'sub_menu' => [
            '0' => [
                'link' => '/admin/ExtensionsValley/Banners/list/bannercategory'
                , 'menu_text' => 'Manage Banner Category'
                , 'acl_key' => 'extensionsvalley.banners.bannercategory'
            ],
            '1' => [
                'link' => '/admin/ExtensionsValley/Banners/list/banners'
                , 'menu_text' => 'Manage Banners'
                , 'acl_key' => 'extensionsvalley.banners.banners'
            ]
        ],
    ]);
});
