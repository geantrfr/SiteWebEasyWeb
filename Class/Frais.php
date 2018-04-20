<?php
	/**
	 * Created by PhpStorm.
	 * User: Vince
	 * Date: 20/03/2018
	 * Time: 09:44
	 */
	
	class Frais extends Depense {
		private $libelleFrais;
		private $detailsFrais;
		private $dateFrais;
		private $idDepense;
		private $codeFrais;
		
		public function __construct($values) {
			parent::__construct($values);
		}
	}