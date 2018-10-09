<?php

namespace App\Http\Controllers\Assessment;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\SerialNumberRepository;

class BaseController extends Controller
{
    /**
     * @var \App\Repositories\Eloquent\SerialNumberRepository
     */
    protected $serialNumberRepository;

    /**
     * PrimaryController constructor.
     *
     * @param \App\Repositories\Eloquent\SerialNumberRepository $serialNumberRepository
     */
    public function __construct(SerialNumberRepository $serialNumberRepository)
    {
        $this->serialNumberRepository = $serialNumberRepository;
    }
}
