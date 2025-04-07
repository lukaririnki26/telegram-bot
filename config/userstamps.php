<?php

return [
    /*
     * Define the table which is used in the database to retrieve the users
     */

    'users_table' => 'sys_users',

    /*
    * Define the table which is used in the database to retrieve the users
    */

    'workspaces_table' => 'sys_workspaces',

    /*
     * Define the table column type which is used in the table schema for
     * the id of the user
     *
     * Options: increments, bigIncrements, uuid
     * Default: bigIncrements
     */

    'users_table_column_type' => 'bigIncrements',

    /*
     * Define the table column type which is used in the table schema for
     * the id of the company
     *
     * Options: increments, bigIncrements, uuid
     * Default: bigIncrements
     */

    'workspaces_table_column_type' => 'bigIncrements',

    /*
     * Define the name of the column which is used in the foreign key reference
     * to the id of the user
     */

    'users_table_column_id_name' => 'id',

    /*
     * Define the name of the column which is used in the foreign key reference
     * to the id of the company
     */

    'workspaces_table_column_id_name' => 'id',

    /*
     * Define the model which is used for the relationships on your models
     */

    'workspaces_model' => Neo\Core\Models\System\Workspace::class,

    /*
     * Define the column which is used in the database to save the user's id
     * which created the model.
     */

    'created_by_column' => 'created_by',

    /*
     * Define the column which is used in the database to save the user's id
     * which updated the model.
     */

    'updated_by_column' => 'updated_by',

    /*
     * Define the column which is used in the database to save the user's id
     * which deleted the model.
     */

    'deleted_by_column' => 'deleted_by',

    /*
     * Define the column which is used in the database to save the company's id
     * which deleted the model.
     */

    'workspace_by_column' => 'workspace_id',
];
