<?php
//file: controller/NoteController.php
require_once(__DIR__."/../model/Note.php");
require_once(__DIR__."/../model/NoteMapper.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

class NotesController extends BaseController {

	private $noteMapper;
	private $userMapper;
	public function __construct() {
		parent::__construct();
		$this->noteMapper = new NoteMapper();
		$this->userMapper = new UserMapper();
	}
//******************************************************************************
	public function index() {
		// obtain the data from the database
		$this->showMyNotes();
		$this->showSharedNotes();
		// render the view (/view/notes/index.php)
		$this->view->render("notes", "index");
	}
//******************************************************************************
	public function showNote(){
		if (!isset($_GET["id_note"])) {
			throw new Exception(i18n("id is mandatory"));
		}
		$id_note = $_GET["id_note"];
		$note = $this->noteMapper->findById($id_note);
		if ($note == NULL) {
			throw new Exception(i18n("no such note with id: ").$id_note);
		}
		// put the Note object to the view
		$this->view->setVariable("note", $note);
		$sharedUsers = $this->noteMapper->sharedWith($id_note);
		$this->view->setVariable("sharedUsers", $sharedUsers);
		// render the view (/view/notes/show_note.php)
		$this->view->render("notes", "show_note");


	}
//******************************************************************************
	public function add() {
		if (!isset($this->currentUser)) {
			throw new Exception(i18n("Not in session. Adding posts requires login"));
		}
		$note = new Note();

		if (isset($_POST["submit"])) {
			$note->setTitle($_POST["title"]);
			$note->setContent($_POST["content"]);
			$note->setUser($this->currentUser);
			try {

				$note->checkIsValidForCreate(); // if it fails, ValidationException
				$this->noteMapper->save($note);
				$this->view->setFlash(sprintf(i18n("Note \"%s\" successfully added."),$note ->getTitle()));
				// header("Location: index.php?controller=notess&action=index")
				$this->view->redirect("notes", "index");
			}catch(ValidationException $ex) {
				$errors = $ex->getErrors();
				$this->view->setVariable("errors", $errors);
			}
		}

		$this->view->setVariable("note", $note);
		// render the view (/view/notes/new_note.php)
		$this->view->render("notes", "new_note");
	}
//******************************************************************************
	public function edit() {
		if (!isset($_REQUEST["id_note"])) {
			throw new Exception("A note id is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing notes requires login");
		}

		$id_note = $_REQUEST["id_note"];
		$note = $this->noteMapper->findById($id_note);
		if ($note == NULL) {
			throw new Exception("no such post with id: ".$id_note);
		}

		if ($note->getUser() != $this->currentUser) {
			if(!$this->noteMapper->shareExists($id_note,$this->currentUser->getAlias())){
				 throw new Exception("logged user is not the author of the note id ".$id_note);
			}
		}

		if (isset($_POST["submit"])) {
			$note->setTitle($_POST["title"]);
			$note->setContent($_POST["content"]);
			try {

				$note->checkIsValidForUpdate(); // if it fails, ValidationException
				$this->noteMapper->update($note);
				$this->view->setFlash(sprintf(i18n("Note \"%s\" successfully updated."),$note ->getTitle()));
				// header("Location: index.php?controller=notes&action=index")
				$this->view->redirect("notes", "index");
			}catch(ValidationException $ex) {
				$errors = $ex->getErrors();
				$this->view->setVariable("errors", $errors);
			}
		}

		$this->view->setVariable("note", $note);
		// render the view (/view/notes/edit_note.php)
		$this->view->render("notes", "edit_note");
	}
//******************************************************************************
	public function delete() {
		if (!isset($_POST["id_note"])) {
			throw new Exception("id is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing notes requires login");
		}

		$id_note = $_REQUEST["id_note"];
		$note = $this->noteMapper->findById($id_note);

		if ($note == NULL) {
			throw new Exception("no such note with id: ".$id_note);
		}
		if ($note->getUser() != $this->currentUser) {
			$this->noteMapper->unshareNote($id_note, $this->currentUser->getAlias());

		} else {
			$this->noteMapper->delete($note);
		}
		$this->view->setFlash(sprintf(i18n("Note \"%s\" successfully deleted."),$note ->getTitle()));
		$this->view->redirect("notes", "index");
	}
//******************************************************************************
	public function showSharedNotes(){
		$sharedNotes = $this->noteMapper->findAllShared($this->currentUser->getAlias());
		// put the array containing Shared Notes to the view
		$this->view->setVariable("sharedNotes", $sharedNotes);
	}
//******************************************************************************
	public function showMyNotes(){
		$notes = $this->noteMapper->findAll($this->currentUser->getAlias());
		// put the array containing Note object to the view
		$this->view->setVariable("notes", $notes);
	}
//******************************************************************************
	public function share(){
		if(!isset($_POST["sharedUser"] )){
			throw new Exception("User is mandatory");
		}
		if(!isset($_POST["id_note"] )){
			throw new Exception("id is mandatory");
		}
		$id_note = $_POST["id_note"];
		$user_alias = $_POST["sharedUser"];

		if($user_alias == $this->currentUser->getAlias()){
			$this->view->setFlashError(sprintf(i18n("You cannot share a note with yourself")));
			$this->view->redirect("notes", "index");
		}

		if(!$this->userMapper->aliasExists($user_alias)){
			$this->view->setFlashError(sprintf(i18n("User doesn't exist")));
			$this->view->redirect("notes", "index");
		}

		if($this->noteMapper->shareExists($id_note,$user_alias)){
			$this->view->setFlashError(sprintf(i18n("Note already shared with that user")));
			$this->view->redirect("notes", "index");
		}

		if(!$this->noteMapper->findById($id_note)){
			$this->view->setFlashError(sprintf(i18n("No such note with id: ").$id_note));
			$this->view->redirect("notes", "index");
		}
		$note = $this->noteMapper->findById($id_note);

		$this->noteMapper->shareNote($id_note,$user_alias);

		$this->view->setVariable("note", $note);
		$sharedUsers = $this->noteMapper->sharedWith($id_note);
		$this->view->setVariable("sharedUsers", $sharedUsers);

		$this->view->setFlash(sprintf(i18n("Note \"%s\" successfully shared with \"%s\"."),$note ->getTitle(), $user_alias));
		$this->view->render("notes", "show_note");

	}
	//*****************************************************************************
	public function unshareNote(){
		if (!isset($_GET["id_note"])) {
			throw new Exception("id is mandatory");
		}
		if (!isset($_GET["userShared"])) {
			throw new Exception("user is mandatory");
		}
		$id_note = $_GET["id_note"];
		$userShared= $_GET["userShared"];
		$note = $this->noteMapper->findById($id_note);

		$this->noteMapper->unshareNote($id_note,$userShared);

		$this->view->setVariable("note", $note);
		$sharedUsers = $this->noteMapper->sharedWith($id_note);
		$this->view->setVariable("sharedUsers", $sharedUsers);

		$this->view->setFlash(sprintf(i18n("Note \"%s\" successfully unshared with \"%s\"."),$note ->getTitle(), $userShared));
		$this->view->render("notes", "show_note");

	}
}
?>
