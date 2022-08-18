<?php

    namespace Carparkdashboard\Lot\Repositories\LotBasement;

    interface LotBasementRepositoryInterface
    {
        public function getAll();
        public function findById($id);
        public function create($attributes);
        public function update($lot_id,$basement_id);
        public function checkExist($lot_id);
    }
