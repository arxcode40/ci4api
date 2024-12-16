<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ProductModel;
use App\Entities\ProductEntity;

class ProductController extends ResourceController
{
    protected $modelName = ProductModel::class;
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = $this->model->findAll();

        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $data = $this->model->find($id);

        if ($data === null) {
            return $this->failNotFound();
        }
        
        return $this->respond($data);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        if (! $this->request->is('post')) {
            return $this->respondNoContent();
        }

        $productEntity = new ProductEntity();
        $productEntity->fill($this->request->getRawInputVar(['name', 'quantity', 'price']));

        if ($this->model->insert($productEntity) === false) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated($productEntity);
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        if (! $this->request->is('put')) {
            return $this->respondNoContent();
        }

        $productEntity = new ProductEntity();
        $productEntity->fill($this->request->getRawInputVar(['name', 'quantity', 'price']));

        if ($this->model->update($id, $productEntity) === false) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond($productEntity);
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        if (! $this->request->is('delete')) {
            return $this->respondNoContent();
        }

        if ($this->model->delete($id)) {
            return $this->respondCreated(['id' => $id]);
        }
    }
}
