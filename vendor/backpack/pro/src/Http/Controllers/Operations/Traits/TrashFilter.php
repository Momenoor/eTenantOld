<?php

namespace Backpack\Pro\Http\Controllers\Operations\Traits;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Arr;

trait TrashFilter
{
    protected function setupTrashFilter()
    {
        if (CRUD::hasFilterWhere('name', 'trashed')) {
            return;
        }

        CRUD::addFilter(
            [
                'type'               => 'trashed',
                'name'               => 'trashed',
                'label'              => 'Trashed',
                'deleteWithoutTrash' => CRUD::getOperationSetting('canDestroyNonTrashedItems'),
            ],
            false,
            function () { // if the filter is active
            CRUD::addBaseClause('onlyTrashed');
                // remove all buttons except trash/bulkTrash operations buttons
                $buttons_to_remove = array_filter(Arr::pluck($this->crud->buttons(), 'name'), function ($item) {
                    return ! in_array($item, ['bulk_trash', 'bulk_restore', 'bulk_destroy', 'destroy', 'restore', 'trash']);
                });

                CRUD::removeButtons($buttons_to_remove);
            },
            function () {
                CRUD::addBaseClause('withoutTrashed');
            }
        );
    }
}
