<?php

class LogController extends BaseController {

    public function ViewUser()
    {
        return View::make('logs.user');
    }

    public function ServerUser()
    {
        $this->ServerSide('User');
    }

    public function ViewProducto()
    {
        return View::make('logs.producto');
    }

    public function ServerProducto()
    {
        $this->ServerSide('Producto');
    } 

    public function ViewEstilo()
    {
        return View::make('logs.estilo');
    }

    public function ServerEstilo()
    {
        $this->ServerSide('Estilo');
    }


    public function ServerSide($model)
    {
        $table = 'model_log';

        $columns = array("model_id","key", "old", "new" ,"timestamp");

        $Searchable = array("user_id", "action_id");

        $sJoin = " JOIN model_log_update ON (model_log_update.model_log_id = model_log.id)";

        $sWhere = " model = '$model'";

        echo SearchTable::get($table, $columns, $Searchable, $sJoin, $sWhere);
    }
}
