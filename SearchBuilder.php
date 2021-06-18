<?php

namespace App\Classes\Search;

use Illuminate\Http\Request;

class SearchBuilder
{

	public $modelName;

	public $request;


	public function __construct($modelName, Request $request)
	{

		$this->modelName = $modelName;

		$this->request = $request;

	}

	public function filter()
	{

		$query = $this->applyFilters();

		return $query;

	}

	private function applyFilters()
	{
		// Primero debemos recuperar el modelo al que le vamos a aplicar los métodos
		$model = $this->getModel();

		// Creamos nuestro QueryBuilder
		$query = $model->modelQuery();

		// Recuperamos los filtros que se deben aplicar a este modelo
		$filters = $this->getFilters();
		
		foreach ($filters as $key => $filter) {
			
			$filter = __NAMESPACE__ . '\\Filters\\' . $this->modelName .  '\\'. $filter;

			if(class_exists($filter)) {

				$query = $filter::apply($query, $this->request);

			}

		}

		return $query;

	}

	private function getModel() 
	{
		try{

			$modelName = $this->modelName;

			$model = ($modelName == 'User') ? app("App\\" . $modelName) : app("App\Models\\" . $modelName);

			return $model;

		}catch(\Exception $e) {

			app_log($e);

			abort(500);

		}

	}

	private function getFilters()
	{

		// Arreglo para almacenar el nombre de los filtros
		$filtersNames = [];

		// Dir path
		$path = __DIR__ . '/Filters/' . $this->modelName;

		// Verificar que el directorio que deseamos inspeccionar exista
		if(file_exists($path)){

			// Recuperar en un arreglo todos los filtros disponibles en el directorio
			$allFilters = scandir($path);

			// Quitar del arreglo ./ y ../
			$filters = array_diff($allFilters, array('.', '..'));

			// Colcar cada filtro en el arreglo $filtersNames
			foreach ($filters as $key => $filter) {

				$filtersNames[] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filter);

			}

		}

		return $filtersNames;

	}

}