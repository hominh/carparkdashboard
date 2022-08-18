<?php

	namespace Carparkdashboard\Sensor\Repositories\Sensor;

	interface SensorRepositoryInterface
	{

		public function getAll();
		public function getAllWithUser();
		public function getAllAtFrontEnd($type);
		public function paginateWithUser($limit);
		public function findById($id);
		public function create($attributes);
		public function update($id, array $attributes);
		public function delete($id);
		public function deleteMultiRecords($ids);
		public function getSensorBySlug($slug);
		public function getSensorByName($name);
	}