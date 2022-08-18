<?php

    namespace Carparkdashboard\Lot\Repositories\LotPaths;

    interface LotPathsRepositoryInterface
    {
        public function findByKios($kiosk_id);
        public function findByLot($lot_id);
        public function create($attributes);
        public function reset($kiosk_id,$lot_id);
        public function checkExist($kiosk_id,$lot_id);
        public function update($kiosk_id,$lot_id,$x1_path,$y1_path,$x2_path,$y2_path);
    }
