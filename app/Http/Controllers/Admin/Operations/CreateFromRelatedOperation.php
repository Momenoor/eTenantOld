<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Models\Landlord;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Route;

trait CreateFromRelatedOperation
{
    protected $createdFrom;

    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupCreateFromRelatedRoutes($segment, $routeName, $controller)
    {


        Route::get($segment . '/{related}/' . $this->createdFrom, [
            'as'        => $routeName . '.createFromRelated',
            'uses'      => $controller . '@createFromRelated',
            'operation' => 'create',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupCreateFromRelatedDefaults()
    {

        CRUD::operation('create', function () {
            CRUD::loadDefaultOperationSettingsFromConfig();
        });
    }


    public function createFromRelated($related)
    {
        CRUD::hasAccessOrFail('create');

        $this->data['route'] = $this->createdFrom . '.showTableInRelatedForm';
        $relatedModel = 'App\\Models\\' . ucfirst($this->createdFrom);

        if (class_exists($relatedModel)) {
            $relatedModel = new $relatedModel;
            $relatedEntry = $relatedModel->findOrFail($related);
        }

        CRUD::modifyField($this->createdFrom, ['type' => 'hidden', 'value' => $relatedEntry->id]);
        $this->data['crud'] = $this->crud;
        $this->data['related'] = $relatedEntry;
        $this->data['saveAction'] = $this->crud->getSaveAction();
        $this->data['title'] = $this->crud->getTitle() ?? trans('backpack::crud.add') . ' ' . $this->crud->entity_name;

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view('crud::create_with_show_related_table', $this->data);
    }
}
