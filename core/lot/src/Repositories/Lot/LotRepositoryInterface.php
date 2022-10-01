<?php

	namespace Carparkdashboard\Lot\Repositories\Lot;

	interface LotRepositoryInterface
	{
		public function getList($draw,$name,$type);
		public function getAll();
		public function countLot($basement,$status);
		public function tracking($basement);
		public function getAllWithUser();
		public function getAllAtFrontEnd($type);
		public function paginateWithUser($limit);
		public function findById($id);
		public function create($attributes);
		public function update($id, array $attributes);
		public function delete($id);
		public function deleteMultiRecords($ids);
		public function getMaxId();
		public function getLotByPlate($plate);
		public function updatePath($id, $x1_path,$y1_path);
		public function updatePath2($id, $x2_path,$y2_path);
		public function getPathFromBasement($basement);
		public function findLotByCoordinate($basement,$x,$y);
		public function checkPointInsideRectangle($x1, $y1, $x2, $y2, $x, $y);
	}