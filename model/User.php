<?php
// file: model/User.php
require_once(__DIR__."/../core/ValidationException.php");

class User {

	private $alias;
  private $name;
	private $passwd;

	public function __construct($alias=NULL, $name=NULL, $passwd=NULL) {
		$this->alias = $alias;
    $this->name =$name;
		$this->passwd = $passwd;
	}

	public function getAlias() {
		return $this->alias;
	}

	public function setAlias($alias) {
		$this->alias = $alias;
	}

	public function getPasswd() {
		return $this->passwd;
	}

	public function setPasswd($passwd) {
		$this->passwd = $passwd;
	}

  public function getName(){
    return $this->name;
  }

  public function setName($name) {
		$this->name = $name;
	}

	/**
  *Validacion de datos
	*/
	public function checkIsValidForRegister() {
    /*$pattern_text = "/[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+/";
    $pattern_alias = "/^([a-zA-Z0-9]+_?[a-zA-Z0-9]+){5,}/"; //letras, numeros y _*/

		$errors = array();
		if (strlen($this->alias) < 5) {
			$errors["alias"] = i18n("Alias must be at least 5 characters length");
		}

    /*if (preg_match($pattern_alias, $this->alias) == 0) {
          $errors["alias"] = i18n("Alias can only contain numbers, letters and/or _ ");
      }*/

		if (strlen($this->passwd) < 5) {
			$errors["passwd"] = i18n("Password must be at least 5 characters length");
		}

    if (strlen($this->name) < 3) {
			$errors["name"] = i18n("Password must be at least 3 characters length");
		}

  /*  if(preg_match($pattern_text, $this->name) == 0){
      $errors["name"] = "Name can only contain letters";
    }*/
		if (sizeof($errors)>0){
			throw new ValidationException($errors, i18n("User is not valid"));
		}
	}
}
