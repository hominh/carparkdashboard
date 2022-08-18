<?php

	namespace Carparkdashboard\Camera\Repositories\Camera;

	interface CameraRepositoryInterface
	{

		public function getAll();
		public function findById($id);
		public function create($attributes);
		public function update($id, array $attributes);
		public function delete($id);
		public function deleteMultiRecords($ids);
		public function getCameraByName($name);
	}