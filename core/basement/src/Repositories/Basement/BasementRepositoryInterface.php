<?php

	namespace Carparkdashboard\Basement\Repositories\Basement;

	interface BasementRepositoryInterface
	{

		public function getAll();
		public function findById($id);
		public function create($attributes);
		public function update($id, array $attributes);
		public function delete($id);
		public function deleteMultiRecords($ids);
	}