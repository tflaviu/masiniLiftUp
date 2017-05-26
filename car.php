<?php

class Car {
    private $id;
    private $db;
    public $marca;
    public $model;
    public $capacitateMotor;
    public $caiPutere;
    public $image;
    	
//    function __construct ($marca, $model, $capacitateMotor = 0, $caiPutere = 0, $image, $db) {
//		if ($capacitateMotor == "") {
//			$capacitateMotor = 0;
//		}
//		
//		if($caiPutere == "") {
//			$caiPutere = 0;
//		}
//        $this->marca = $marca;
//        $this->model = $model;
//        $this->capacitateMotor = $capacitateMotor;
//        $this->caiPutere = $caiPutere;
//        $this->imagine = $imagine;
//    }

	/*public function fill($attrs) {
		/*
		['marca' => 1, 'model' => 'Punto'
		]
		
		*//*
		foreach($attrs as $attr => $val) {
		}
		$key => $val
		if(property_exists($this, $key)) {
			
			$this->$key = $val;
	}*/
    
    public function set_object_vars(array $vars) {
        $has = get_object_vars($this);
        foreach ($has as $name => $oldValue) {
            $this->$name = isset($vars[$name]) ? $vars[$name] : NULL;
        }
    }

    
    public function getMarca() {
		return $this->marca;
	}
	
	protected function setMarca($marca) {
		$this->name = strtolower($marca);
	}
	
	public function getModel() {
	    return $this->model;
	}
	
	protected function setModel($model) {
	    $this->model = str_getcsv($model);
	}
	
	public function getCapacitateMotor() {
	    return $this->capacitateMotor;
	}
	
	protected function setCapacitateMotor($capacitateMotor) {
	    $this->capacitateMotor = $capacitateMotor;
	}
	
	public function getCaiPutere() {
		return $this->caiPutere;
	}
	
	protected function setCaiPutere($caiPutere) {
		$this->caiPutere = $caiPutere;
	}
	
	public function getImage() {
	    return $this->image;
	}
	
	protected function setImage($imgine) {
	    $this->image = $image;
	}
	
	public function getDB() {
		return $this->db;
	}
	
        public function getID() {
            return $this->id;
        }
        
        public function setID($id) {
            $this->id = $id;
        }
        
    public function save() {
        $marca = $this->getMarca();
	$model = $this->getModel();
        if ($this->getCapacitateMotor() == '') {
            $this->setCapacitateMotor(0);
        }
        if ($this->getCaiPutere() == '') {
            $this->setCaiPutere(0);
        }
        $capacitateMotor = $this->getCapacitateMotor();
	$caiPutere = $this->getCaiPutere();
	$image = $this->getImage();
	$db = $this->getDB();
	$id = $this->getID();
        if ($id && $id != '') {
            $sql = "UPDATE cars SET CarBrandID = '$marca' , Model = '$model', EngineCapacity = '$capacitateMotor', PowerHorses = '$caiPutere', Image = '$image' WHERE CarID = '$id' ";
            if ($db->query($sql) === TRUE) {
		echo "Record updated successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $db->error;
            }
        } else {
            $sql = "INSERT INTO `cars`(`CarBrandID`, `Model`, `EngineCapacity`, `PowerHorses`, `Image`) VALUES ('$marca','$model','$capacitateMotor','$caiPutere','$image')";
            if ($db->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $db->error;
            }
        }
    }
}
