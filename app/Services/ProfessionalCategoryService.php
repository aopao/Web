<?php
/**
 * 专业模块服务类
 * User: jason
 * Date: 2018/9/17
 * Time: 上午8:41
 */

namespace App\Services;

use App\Repositories\Eloquent\ProfessionalCategoryRepository;

class ProfessionalCategoryService
{
    /**
     * @var \App\Repositories\Eloquent\ProfessionalCategoryRepository
     */
    private $professionalCategoryRepository;

    /**
     * ProvinceService constructor.
     *
     * @param \App\Repositories\Eloquent\ProfessionalCategoryRepository $professionalCategoryRepository
     */
    public function __construct(ProfessionalCategoryRepository $professionalCategoryRepository)
    {
        $this->professionalCategoryRepository = $professionalCategoryRepository;
    }

    /**
     * 获取所有专业大分类
     *
     * @param null $professional_category_id
     * @return mixed
     */
    public function getAllProfessionalCategoryOptions($professional_category_id = null)
    {
        $provinces = $this->professionalCategoryRepository->getAllProfessionalCategories(0);
        $option = null;
        $selected = null;
        if (isset($professional_category_id)) {
            $selected = 'selected';
            $option .= "<option ".$selected." value='0'>根目录</option>";
        }
        foreach ($provinces as $key => $value) {
            $selected = $professional_category_id != null && $professional_category_id == $value['id'] ? 'selected' : '';
            $option .= "<option ".$selected." value=\"".$value['id']."\">".$value['professional_category_name']."</option>";
        }

        return $option;
    }
}