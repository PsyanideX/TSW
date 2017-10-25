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

		$errors = array();
		if (strlen($this->alias) < 5) {
			$errors["alias"] = i18n("Alias must be at least 5 characters length");
		}

		if (strlen($this->passwd) < 5) {
			$errors["passwd"] = i18n("Password must be at least 5 characters length");
		}

    if (strlen($this->name) < 3) {
			$errors["name"] = i18n("Password must be at least 3 characters length");
		}

		if (sizeof($errors)>0){
			throw new ValidationException($errors, i18n("User is not valid"));
		}
	}
}
