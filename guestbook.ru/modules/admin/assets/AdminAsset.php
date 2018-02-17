<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;
namespace app\modules\admin\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class    AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
       '/web/admin/css/bootstrap.css',
       '/web/admin/css/bootstrap-theme.css',
    ];
	
	/*public $cssOptions = ['conditon' => 'lte IE8'];*/
	
    public $js = [
        '/web/admin/js/jquery-1.11.1.min.js',
        '/web/admin/js/bootstrap.js',
        '/web/admin/js/func_admin.js',
    ];

}


