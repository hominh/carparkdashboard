<?php

    namespace Carparkdashboard\Lot\Repositories\LotCamera;

    interface LotCameraRepositoryInterface
    {
        public function getAll();
        public function findById($id);
        public function create($attributes);
        public function update($lot_id,$camera_id);
        public function deleteByLotId($lotId);
        public function deleteByCameraId($cameraId);
        public function multiDeleteByLotId($lotId);
    }
