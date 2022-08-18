<?php

    namespace Carparkdashboard\Basement\Repositories\BasementKiosk;

    interface BasementKioskRepositoryInterface
    {
        public function getAll();
        public function findById($id);
        public function create($attributes);
        public function update($kiosk_id,$basement_id);
    }
