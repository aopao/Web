<?php
/**
 * TODO.
 * User: jason
 * Date: 2018/9/17
 * Time: 下午4:16
 */

namespace App\Api\V1\Controllers;

use App\Repositories\Eloquent\ProvinceControlScoreRepository;

class ProvinceControlScore extends BaseController
{
    /**
     * @var \App\Repositories\Eloquent\ProvinceControlScoreRepository
     */
    private $provinceControlScoreRepository;

    /**
     * ProvinceControlScore constructor.
     *
     * @param \App\Repositories\Eloquent\ProvinceControlScoreRepository $provinceControlScoreRepository
     */
    public function __construct(ProvinceControlScoreRepository $provinceControlScoreRepository)
    {
        $this->provinceControlScoreRepository = $provinceControlScoreRepository;
    }

    public function parseSubjectCharsByProvinceId($province_id, $subject = null)
    {
        return $this->provinceControlScoreRepository->parseSubjectCharsByProvinceId($province_id, $subject);
    }
}