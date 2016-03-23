<?php
namespace Table ;

class Table extends \rOpenDev\DataTablesPHP\DataTable {

	public static function instance($id){
		$dataTable = parent::instance($id);

		// You can use Plug-in too : http://datatables.net/plug-ins/i18n/#How-to-use
		$language = array(
			'emptyTable' => 'Aucune donnée à afficher',
			'info' => '_START_ à _END_ sur _TOTAL_ lignes',
			'infoEmpty' => '(Aucune donnée à afficher)',
			'infoFiltered' => '(filtré de _MAX_ éléments au total)',
			'infoPostFix' => '',
			'thousands' => ' ',
			'lengthMenu' => '_MENU_ lignes par page',
			'loadingRecords' => '...',
			'processing' => '...',
			'search' => 'Rechercher&nbsp;:',
			'zeroRecords' => '---',
			'paginate' => array(
				'first'   => '&laquo;',
				'last'    => '&raquo;',
				'next'    => '>',
				'previous' => '<',
//				'next'    => '&raquo',
//				'previous' => '&laquo',
			),
			'aria' => array(
				'sortAscending'  => ': activer pour trier la colonne par ordre croissant',
				'sortDescending' => ': activer pour trier la colonne par ordre décroissant',
			),
		);
		$dataTable
			->setJsInitParam('language', $language)
			->setJsInitParam('pagingType', "full_numbers")
		;

		return $dataTable;
	}

	public function setColumns($columns){
		foreach( $columns as $k => &$v ){
			$v['data'] = $k;
		}
		parent::setColumns($columns);
		return $this;
	}

	public function setData($data){
		$data = json_encode($data);
		$data = json_decode($data,true);
		parent::setData($data);
		return $this;
	}

	public static function get_js(){
		$array = self::get_instance();
		$txt = '';
		if( sizeof($array) > 0 ){
			$txt .= "<script>$(document).ready(function(){";
			foreach($array as $a){
				$txt .= $a->getJavascript();
			}
			$txt .= "});</script>";
		}
		return $txt;
	}

}