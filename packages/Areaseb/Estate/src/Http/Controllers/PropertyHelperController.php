<?php

namespace Areaseb\Estate\Http\Controllers;

use Illuminate\Http\Request as PostRequest;
use App\Http\Controllers\Controller;
use Areaseb\Estate\Models\{Area, Contract, Feat, Ownership, Property, Poi, Request, Tag, Type};
use Areaseb\Estate\Models\City;

class PropertyHelperController extends Controller
{


    public function createField(PostRequest $request)
    {
        $model = $this->findClass($request);
        if($model)
        {
            $model->create([$request->field => $request->value]);
            return 'done';
        }

        return 'not found';
    }

    public function updateField(PostRequest $request)
    {
        $model = $this->findModel($request);
        if($model)
        {
            $model->update([$request->field => $request->value]);
            return 'done';
        }

        return 'not found';
    }

    public function findModel($data)
    {
        if ( class_exists('Areaseb\\Estate\\Models\\'.$data->model) )
        {
            $class = 'Areaseb\\Estate\\Models\\'.$data->model;
            return $class::findOrFail($data->id);
        }
        return null;
    }

    public function findClass($data)
    {
        if ( class_exists('Areaseb\\Estate\\Models\\'.$data->model) )
        {
            $class = 'Areaseb\\Estate\\Models\\'.$data->model;
            return new $class;
        }
        return null;
    }


}
