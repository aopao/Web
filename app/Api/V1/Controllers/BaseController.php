<?php
/**
 * api 所有控制器的基类.
 * User: jason
 * Date: 2018/9/14
 * Time: 上午8:56
 */

namespace App\Api\V1\Controllers;

use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    use Helpers;
}