<?php

namespace App\Http\Controllers;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as SupportRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;

trait Manage
{

    protected $modifyTpl = 'create';

    protected $excepts = ['_token', '_method'];

    /**
     * @return Model $model
     */
    protected function model()
    {
        $class = "App\\Models\\" . $this->modelName();
        return new $class();
    }

    protected function modelName()
    {
        $class = array_last(explode('\\', __CLASS__));
        $class = str_replace('Controller', '', $class);
        return ucfirst($class);
    }

    /**
     * @param int $id = 0
     * @return array
     */
    protected function beforeData($id = 0)
    {
        return [];
    }

    protected function data($id = 0)
    {
        $data = [
            'tpl' => $this->getTpl(),
        ];
        $sData = $this->beforeData($id);
        $sData = is_array($sData) ? $sData : (array)$sData;
        $data = array_merge($data, $sData);
        if ($id > 0) {
            $data["info"] = $this->model()->find($id);
        }
        $data["action"] = !empty($data["info"]) ? url($data["tpl"] . '/' . $id) : url($data["tpl"]);
        if(SupportRequest::ajax()) {
            return view($this->getTpl() . '.popup.create', $data);
        } else {
            return view($this->getTpl() . '.create', $data);
        }

    }


    public function create()
    {
        return $this->data(0);
    }

    public function edit($id = 0)
    {
        return $this->data($id);
    }

    protected function getTpl()
    {
        return strtolower($this->modelName());
    }

    /**
     * 保存数据
     * @param Request $req
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function store(Request $req)
    {
        $data = $req->except($this->excepts);
        $info = $this->model();
        if(true !== $res = $this->validateStore($data)) {
            return $res;
        }
        $data = $this->beforeStore($data);
        $data = $this->fieldFilter($data);
        foreach ($data as $field => $value) {
            $info->setAttribute($field, $value);
        }
        $result = $info->save();
        if ($result !== false) {
            $this->afterStore($req, $info->id);
            if ($req->ajax()) {
                return response()->json(['status' => 1, 'info' => '保存成功']);
            }
            return redirect($this->getTpl());
        } else {
            if ($req->ajax()) {
                return response()->json(['status' => 0, 'info' => '保存失败,请重试']);
            }
            return redirect($this->getTpl() . '/create');
        }

    }

    /**
     * @param $data
     * @return bool|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function validateStore($data) {
        return true;
    }

    public function beforeStore($data)
    {
        return $data;
    }

    public function afterStore($req, $id)
    {

    }

    public function fieldFilter($data)
    {
        $model = $this->model();
        $columns = $model->columns();
        foreach ($data as $field => $value) {
            if (!$model->inColumns($field, $columns)) {
                unset($data[$field]);
            }
        }
        return $data;
    }

    /**
     * 更新数据
     *
     * @param Request $req
     * @param int $id
     * @return JsonResponse|RedirectResponse|Redirector
     */
    protected function update(Request $req, $id = 0)
    {
        $data = $req->except($this->excepts);
        $info = $this->model()->find($id);
        $data['oid'] = $id;
        if(true !== $res = $this->validateUpdate($data)) {
            return $res;
        }

        $data = $this->beforeUpdate($data);
        $data = $this->fieldFilter($data);
        foreach ($data as $field => $value) {
            $info->setAttribute($field, $value);
        }
        $result = $info->save();
        if ($result !== false) {
            if (method_exists($this, 'afterUpdate')) {
                $this->afterUpdate($req, $id);
            }
            if ($req->ajax()) {
                return response()->json(['status' => 1, 'info' => '更新成功']);
            }
            return redirect($this->getTpl());
        } else {
            if ($req->ajax()) {
                return response()->json(['status' => 0, 'info' => '更新失败,请重试']);
            }
            return redirect($this->getTpl() . '/' . $id . '/edit');
        }

    }

    /**
     * @param $data
     * @return bool|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function validateUpdate($data) {
        return true;
    }

    protected function beforeUpdate($data)
    {
        return $data;
    }

    protected function afterUpdate($req, $id)
    {

    }

    /**
     * 删除数据
     *
     * @param Request $req
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function destroy(Request $req, $id)
    {
        $id = explode(',', $id);
        $this->beforeDestroy($id);
        $result = $this->model()->destroy($id);
        if ($result !== false) {
            $this->afterDestroy($id);
            if ($req->ajax()) {
                return response()->json(['status' => 1, 'info' => '删除成功']);
            }
            $req->session()->flash('destroy', ['status' => 1, 'info' => '删除成功']);
        } else {
            if ($req->ajax()) {
                return response()->json(['status' => 0, 'info' => '删除失败, 请重试']);
            }
            $req->session()->flash('destroy', ['status' => 0, 'info' => '删除失败']);
        }
        return redirect($this->getTpl());
    }

    protected function beforeDestroy(array $ids)
    {
        return true;
    }

    protected function afterDestroy(array $ids)
    {
        return true;
    }

    public function delete(Request $req)
    {
        $ids = $req->get("ids", '');
        if (empty($ids)) {
            return response()->json(['status' => 0, 'info' => '非法操作']);
        }
        return $this->destroy($req, $ids);
    }

    protected function ajaxGetList()
    {

    }
}