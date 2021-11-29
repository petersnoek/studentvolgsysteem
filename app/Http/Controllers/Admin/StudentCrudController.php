<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StudentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class StudentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StudentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Student::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/student');
        CRUD::setEntityNameStrings('student', 'students');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addButtonFromView('top', 'AddColumn', 'AddColumnButton', 'end');

        $custom_fields = ['created_at', 'firstname', 'new'];
        foreach($custom_fields as $column){
            CRUD::column($column);
        }

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(StudentRequest::class);

        //CRUD::field('created_at');
        CRUD::field('firstname');
        //CRUD::field('id');
        CRUD::field('lastname');
        CRUD::field('studentnumber');
        CRUD::field('suffix');
        //CRUD::field('updated_at');
        $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
            'label' => "Groups",
            'type' => 'select2_multiple',
            'name' => 'groups', // the method that defines the relationship in your Model
            'entity' => 'groups', // the method that defines the relationship in your Model
            'attribute' => 'code', // foreign key attribute that is shown to user
            'model' => "App\Models\Group", // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            'select_all' => true,
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation(){
//        CRUD::column('id');
        CRUD::column('studentnumber');
        CRUD::column('firstname');
        CRUD::column('suffix');
        CRUD::column('lastname');
//        CRUD::column('created_at');
//        CRUD::column('updated_at');

        $this->crud->addColumn(
            [
                'label' => "Groups",
                'name' => 'groups', // the method that defines the relationship in your Model
                'type' => 'model_function',
                'function_name' => 'getGroupSlugs',
//                'entity' => 'concepts', // the method that defines the relationship in your Model
//                'attribute' => 'name', // foreign key attribute that is shown to user
//                'model' => "App\Models\Concept", // foreign key model
//                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            ]);
    }
}
