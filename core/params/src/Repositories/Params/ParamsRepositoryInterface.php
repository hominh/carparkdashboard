<?php

    namespace Carparkdashboard\Params\Repositories\Params;

    interface ParamsRepositoryInterface
    {

        public function getAll();
        public function findByName($name);
        public function update($param_name,$value);
        /*public function create($attributes);
        public function delete($id);
        public function deleteMultiRecords($ids);*/
    }