<?php
	class ProvinceVO{
		private $idPays;
		private $province;
		
		public function ProvinceVO(){
		}
		
		public function getProvince(){
			return $this->province;
		}
		
		public function setProvince($val){
			$this->province = $val;
		}
	}
?>