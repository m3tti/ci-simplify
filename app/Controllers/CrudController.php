<?php

namespace App\Controllers;

use ReflectionClass;

abstract class CrudController extends BaseController
{
    protected $modelClassName;
    protected $updateRedirect;

    protected $helpers = [
        'form',
        'string',
        'inflector',
        'session',
    ];

    public function index()
    {
        $model = model($this->modelClassName);
        $data = $model->findAll();
        $name = strtolower($this->modelClassName);
        return view($this->modelClassName . '/index', [plural($name) => $data]);
    }

    public function view($id)
    {
        $model = model($this->modelClassName);
        $data = $model->find($id);

        return view($this->modelClassName . '/view', [strtolower($this->modelClassName) => $data, ...$this->extraData($id)]);
    }

    public function new()
    {
        $name = strtolower($this->modelClassName);
        return view($this->modelClassName . '/new', [$name => [], ...$this->extraData()]);
    }

    public function edit($id)
    {
        $model = model($this->modelClassName);
        $data = $model->find($id);

        $name = strtolower($this->modelClassName);
        return view($this->modelClassName . '/edit', [$name => $data, ...$this->extraData($id)]);
    }

    protected function extraData($id = null)
    {
        return [];
    }

    public function update()
    {
        $model = model($this->modelClassName);
        $model->db->transStart();
        $data = $this->beforeSave($this->request->getPost());
        $model->save($data);
        $afterSave = $this->afterUpdate();
        $model->db->transComplete();

        $session = session();
        if (sizeof($model->errors()) == 0 && $afterSave) {
            $session->setFlashdata('success', lang('saved_successfully'));
        } else {
            $session->setFlashdata('error', $model->errors());
            return redirect()->back()->withInput();
        }

        $customRedirect = $this->updateRedirect($model);
        return $customRedirect
            ? $customRedirect
            : $this->response->redirect(url_to("$this->modelClassName::view", $this->request->getPost('id') ?? $model->getInsertID()));
    }

    protected function beforeSave($data = null)
    {
        return $data;
    }

    protected function updateRedirect($model = null)
    {
        return null;
    }

    protected function afterUpdate()
    {
        return true;
    }

    public function delete()
    {
        $model = model($this->modelClassName);
        $save = $model->delete($this->request->getPost('id'));

        $session = session();
        if ($save) {
            $session->setFlashdata('success', lang('saved_successfully'));
        } else {
            $session->setFlashdata('error', $model->errors());
        }

        $customRedirect = $this->updateRedirect($model);
        return $customRedirect
            ? $customRedirect
            : $this->response->redirect(url_to("$this->modelClassName::index"));
    }

    /**
     * 
     * @param \CodeIgniter\Router\RouteCollection $routes 
     * @return void 
     */
    public static function crudRoutes($routes)
    {
        $ref = new ReflectionClass(get_called_class());
        $name = $ref->getShortName();
        $routes->get('', "$name::index");
        $routes->get('new', "$name::new");
        $routes->get('edit/(:num)', "$name::edit/$1");
        $routes->get('view/(:num)', "$name::view/$1");
        $routes->post('update', "$name::update");
        $routes->post('delete', "$name::delete");
    }
}
