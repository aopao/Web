<?php
/**
 * 地域 APi 接口类
 * User: jason
 * Date: 2018/9/14
 * Time: 上午9:36
 */

namespace App\Api\V1\Controllers;

use App\Api\V1\Serializers\CustomSerializer;
use App\Api\V1\Transformers\AreaTransformer;
use App\Api\V1\Transformers\CityTransformer;
use App\Api\V1\Transformers\ProvinceTransformer;
use App\Repositories\Eloquent\AreaRepository;
use App\Repositories\Eloquent\CityRepository;
use App\Repositories\Eloquent\ProvinceRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RegionController extends BaseController
{
    private $province;

    private $city;

    private $area;

    /**
     * RegionController constructor.
     * 依赖注入 ProvinceRepository CityRepository AreaRepository
     *
     * @param \App\Repositories\Eloquent\ProvinceRepository $provinceRepository
     * @param \App\Repositories\Eloquent\CityRepository     $cityRepository
     * @param \App\Repositories\Eloquent\AreaRepository     $areaRepository
     */
    public function __construct(ProvinceRepository $provinceRepository, CityRepository $cityRepository, AreaRepository $areaRepository)
    {
        $this->province = $provinceRepository;
        $this->city = $cityRepository;
        $this->area = $areaRepository;
    }

    /**
     * 临时使用
     * 临时生成所有城市的 ID
     */
    public function Js()
    {
        $data = [];
        $provinces = $this->province->getAllProvinces();
        foreach ($provinces as $key => $value) {
            $data[$key]['value'] = "{$value['id']}";
            $data[$key]['text'] = $value['province_name'];
            $cities = $this->province->getAllCityByProvinceId($value['id']);
            foreach ($cities as $ke => $va) {
                $data[$key]['children'][$ke]['value'] = "{$va['id']}";
                $data[$key]['children'][$ke]['text'] = $va['city_name'];
                $areas = $this->province->getAllAreaByCityId($va['id']);
                foreach ($areas as $k => $v) {
                    $data[$key]['children'][$ke]['children'][$k]['value'] = "{$v['id']}";
                    $data[$key]['children'][$ke]['children'][$k]['text'] = $v['area_name'];
                }
            }
        }

        return $data;
    }

    /**
     * 获取所有省份
     *
     * @throws \ErrorException
     */
    public function getAllProvinces()
    {
        $provinces = $this->province->getAllProvinces();

        return $this->collection($provinces, new ProvinceTransformer, function ($resource, $fractal) {
            $fractal->setSerializer(new CustomSerializer);
        });
    }

    /**
     * 根据省份 ID 获取所有的城市列表
     *
     * @param $id
     * @return mixed
     * @throws \ErrorException
     */
    public function getAllCityByProvinceId($id)
    {
        /* 判断传入的省份 ID 是否存在,不存在抛出异常 */
        if (! $this->province->findById($id)) {
            throw new NotFoundHttpException('Not Found!');
        }
        $cities = $this->province->getAllCityByProvinceId($id);

        return $this->collection($cities, new CityTransformer, function ($resource, $fractal) {
            $fractal->setSerializer(new CustomSerializer);
        });
    }

    /**
     * 根据城市 ID 获取所有的地区列表
     *
     * @param $id
     * @return mixed
     * @throws \ErrorException
     */
    public function getAllAreaByCityId($id)
    {

        /* 判断传入的省份 ID 是否存在,不存在抛出异常 */
        if (! $this->city->findById($id)) {
            throw new NotFoundHttpException('Not Found!');
        }

        $areas = $this->province->getAllAreaByCityId($id);

        return $this->collection($areas, new AreaTransformer, function ($resource, $fractal) {
            $fractal->setSerializer(new CustomSerializer);
        });
    }
}