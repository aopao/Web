<?php
/**
 * 省份模块服务类
 * User: jason
 * Date: 2018/9/17
 * Time: 上午8:41
 */

namespace App\Services;

use App\Repositories\Eloquent\ProvinceRepository;

class ProvinceService
{
    /**
     * @var \App\Repositories\Eloquent\ProvinceRepository
     */
    private $provinceRepository;

    /**
     * ProvinceService constructor.
     *
     * @param \App\Repositories\Eloquent\ProvinceRepository $provinceRepository
     */
    public function __construct(ProvinceRepository $provinceRepository)
    {

        $this->provinceRepository = $provinceRepository;
    }

    /**
     * 获取所有省份Options
     *
     * @param $province_id
     * @return mixed
     */
    public function getAllProvincesOptions($province_id = null)
    {
        $provinces = $this->provinceRepository->getAllProvinces();
        $option = null;
        $selected = null;
        foreach ($provinces as $key => $value) {
            $selected = $province_id != null && $province_id == $value['id'] ? 'selected' : '';
            $option .= "<option ".$selected." value=\"".$value['id']."\">".$value['province_name']."</option>";
        }

        return $option;
    }

    /**
     * 获取所有省份Checkbox
     *
     * @param null $province_ids
     * @return mixed
     */
    public function getAllProvincesCheckbox($province_ids = null)
    {
        $provinces = $this->provinceRepository->getAllProvinces();
        $checkbox = null;
        $checked = null;
        foreach ($provinces as $key => $value) {
            $checked = $province_ids != null && in_array($value['id'], $province_ids) ? 'checked' : '';
            $checkbox .= "<input ".$checked." type=\"checkbox\" value=\"".$value['id']."\" name=\"provinces[]\" title=\"".$value['province_name']."\">";
        }

        return $checkbox;
    }
}