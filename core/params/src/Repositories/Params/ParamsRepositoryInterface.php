<?php

    namespace Carparkdashboard\Params\Repositories\Params;

    interface ParamsRepositoryInterface
    {

        public function getAll();
        public function findByName($name);
        /*public function create($attributes);
        public function update($id, array $attributes);
        public function delete($id);
        public function deleteMultiRecords($ids);*/
    }