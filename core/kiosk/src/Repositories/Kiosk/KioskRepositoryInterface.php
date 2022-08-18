<?php

	namespace Carparkdashboard\Kiosk\Repositories\Kiosk;

	interface KioskRepositoryInterface
	{

		public function getAll();
		public function findById($id);
		public function create($attributes);
		public function update($id, array $attributes);
		public function delete($id);
		public function deleteMultiRecords($ids);
	}