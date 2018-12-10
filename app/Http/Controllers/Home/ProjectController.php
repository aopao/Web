<?php

namespace App\Http\Controllers\Home;

use App\Models\Major;
use App\Models\College;
use App\Models\ProvinceControlScore;

class ProjectController extends BaseController
{
    /**
     * @var \App\Models\College
     */
    private $college;

    /**
     * @var \App\Models\Major
     */
    private $major;

    /**
     * @var \App\Models\ProvinceControlScore
     */
    private $provinceControlScore;

    /**
     * ProjectController constructor.
     *
     * @param \App\Models\College              $college
     * @param \App\Models\Major                $major
     * @param \App\Models\ProvinceControlScore $provinceControlScore
     */
    public function __construct(College $college, Major $major, ProvinceControlScore $provinceControlScore)
    {
        $this->college = $college;
        $this->major = $major;
        $this->provinceControlScore = $provinceControlScore;
    }

    public function index()
    {
        return view("home.index");
    }

    public function college()
    {
        $data = $this->college->with("province", "collegeDiplomas", "collegeCategory")->paginate(30)->toArray();
        print_r($data);
    }

    public function major()
    {
        $data = $this->major->paginate(30)->toArray();
        print_r($data);
    }

    public function ProvinceScore()
    {
        $data = $this->provinceControlScore->with('province')->orderBy("year", "desc")->paginate(30)->toArray();
        print_r($data);
    }



}
