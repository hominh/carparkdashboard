<?php

    namespace Carparkdashboard\Lot\Repositories\LotSensor;

    interface LotSensorRepositoryInterface
    {
        public function getAll();
        public function findById($id);
        public function create($attributes);
        public function update($lot_id,$camera_id);
        public function deleteByLotId($lotId);
        public function deleteBySensorId($sensorId);
        public function multiDeleteByLotId($lotId);
    }
