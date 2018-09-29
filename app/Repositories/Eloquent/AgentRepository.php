<?php
/**
 * Agent 模型数据处理层
 * User: jason
 * Date: 2018/9/15
 * Time: 上午10:31
 */

namespace App\Repositories\Eloquent;

use App\Models\Agent;
use App\Models\AgentProvince;

class AgentRepository extends Repository
{
    /**
     * 实例化 Agent 模型对象
     *
     * @return string
     */
    public function model()
    {
        return Agent::class;
    }

    /**
     * 根据 ID 查询代理商信息
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->find($id);
    }

    /**
     * 获取所有代理商信息总数
     *
     * @param null $request
     * @return mixed
     */
    public function getAllCount($request = null)
    {
        $mobile = $request->get('mobile');
        if ($mobile) {
            return $this->model->where('mobile', 'like', '%'.$mobile.'%')->count();
        } else {
            return $this->model->count();
        }
    }

    /**
     * 代理商信息分页
     *
     * @param $request
     * @return mixed
     */
    public function getAllByPage($request)
    {
        $page = $request->get('page') - 1;
        $limit = $request->get('limit');
        $offset = $page * $limit;
        $mobile = $request->get('mobile');

        $sql = $this->model->skip($offset)->limit($limit);
        if ($mobile) {
            return $sql->where('mobile', 'like', '%'.$mobile.'%')->get();
        } else {
            return $sql->get();
        }
    }

    /**
     * 存储代理商信息信息
     *
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->model->create($data);
    }

    /**
     * 根据 ID 更新代理商信息数据
     *
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        if (! isset($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }
        if (isset($data['mobile'])) {
            if ($this->model->where('mobile', $data['mobile'])->exists()) {
                return 400;
            }
        }

        return $this->model->where('id', $id)->update($data);
    }

    /**
     * 根据代理商 ID 分配省份
     *
     * @param $agent_id
     * @param $request
     * @return bool
     * @throws \Exception
     */
    public function assignAgentProvince($agent_id = 0, $request)
    {
        $data = [];
        $data['agent_id'] = $agent_id;
        $provinces = $request->get('provinces');
        AgentProvince::where('agent_id', $agent_id)->delete();
        foreach ($provinces as $value) {
            $data['province_id'] = $value;
            AgentProvince::Create($data);
        }

        return true;
    }

    /**
     * 根据代理商 ID 获取代理省份
     * @param int $agent_id
     * @return \Illuminate\Support\Collection
     */
    public function getAgentProvince($agent_id = 0)
    {
        return AgentProvince::where('agent_id', $agent_id)->pluck('province_id');
    }

    /**
     * 删除代理商信息信息
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * 批量删除代理商信息
     *
     * @param $ids
     * @return mixed
     */
    public function batchDelete($ids)
    {
        $id_array = array_filter(explode('|', $ids));

        return $this->destroy($id_array);
    }
}