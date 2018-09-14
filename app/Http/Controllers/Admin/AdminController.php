<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminRequest;
use App\Repositories\Eloquent\AdminRepository;
use Illuminate\Http\Request;

class AdminController extends BaseController
{
    private $model;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->model = $adminRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "Admin_Controller";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\AdminRequest $adminRequest
     * @return void
     */
    public function store(AdminRequest $adminRequest)
    {
        $data = $this->model->create($adminRequest->all());
        if ($this->model->create($data)->id) {
            redirect(route('admin.dashboard'))->with('success', '添加成功!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
