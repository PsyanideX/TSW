<?php
// file: model/Post.php
require_once(__DIR__."/../core/ValidationException.php");

class Note {

	private $id_note;
	private $title;
	private $content;
	private $alias;

	public function __construct($id_note=NULL, $title=NULL, $content=NULL, User $alias=NULL) {
		$this->id_note = $id_note;
		$this->title = $title;
		$this->content = $content;
		$this->alias = $alias;
	}

	public function getIdNote() {
		return $this->id_note;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getContent() {
		return $this->content;
	}

	public function setContent($content) {
		$this->content = $content;
	}
  //return Obj User
	public function getUser() {
		return $this->alias;
	}

	public function setUser(User $alias) {
		$this->alias = $alias;
	}
  /*ATRIBUTO ARRAY  USUARIOS QUE COMPARTEN LA NOTA*/

  //----------------Validations----------------------------------
	public function checkIsValidForCreate() {
		$errors = array();
		if (strlen(trim($this->title)) == 0 ) {
			$errors["title"] = i18n("title is mandatory");
		}
		if (strlen(trim($this->content)) == 0 ) {
			$errors["content"] = i18n("content is mandatory");
		}
		
		if (sizeof($errors) > 0){
			throw new ValidationException($errors, i18n("Note is not valid"));
		}
	}

	public function checkIsValidForUpdate() {
		$errors = array();
		if (!isset($this->id_note)) {
			$errors["id_note"] = i18n("id is mandatory");
		}
		try{
			$this->checkIsValidForCreate();
		}catch(ValidationException $ex) {
			foreach ($ex->getErrors() as $key=>$error) {
				$errors[$key] = $error;
			}
		}
		if (sizeof($errors) > 0) {
			throw new ValidationException($errors, i18n("Note is not valid"));
		}
	}
}
?>
