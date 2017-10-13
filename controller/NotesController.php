<?php
//file: controller/PostController.php
require_once(__DIR__."/../model/Note.php");
require_once(__DIR__."/../model/NoteMapper.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

class NotesController extends BaseController {

	private $noteMapper;
	public function __construct() {
		parent::__construct();
		$this->noteMapper = new NoteMapper();
	}

	public function index() {
		// obtain the data from the database
		$notes = $this->noteMapper->findAll();
		// put the array containing Note object to the view
		$this->view->setVariable("notes", $notes);
		// render the view (/view/posts/index.php)
		$this->view->render("notes", "index");
	}

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
		// render the view (/view/notes/show_note.php)
		$this->view->render("notes", "show_note");
	}

	public function add() {
		if (!isset($this->currentUser)) {
			throw new Exception(i18n("Not in session. Adding posts requires login"));
		}
		$nota = new Note();
		if (isset($_POST["submit"])) { // reaching via HTTP Post...
			// populate the Post object with data form the form
			$note->setTitle($_POST["title"]);
			$note->setContent($_POST["content"]);
			// The user of the Post is the currentUser (user in session)
			$note->setUser($this->currentUser);
			try {
				// validate Post object
				$note->checkIsValidForCreate(); // if it fails, ValidationException
				// save the Post object into the database
				$this->noteMapper->save($note);
				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash(sprintf(i18n("Note \"%s\" successfully added."),$note ->getTitle()));
				// perform the redirection. More or less:
				// header("Location: index.php?controller=notess&action=index")
				// die();
				$this->view->redirect("notes", "index");
			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}
		// Put the Post object visible to the view
		$this->view->setVariable("note", $note);
		// render the view (/view/notes/new_note.php)
		$this->view->render("notes", "new_note");
	}

	public function edit() {
		if (!isset($_REQUEST["id"])) {
			throw new Exception("A post id is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing posts requires login");
		}
		// Get the Post object from the database
		$postid = $_REQUEST["id"];
		$post = $this->postMapper->findById($postid);
		// Does the post exist?
		if ($post == NULL) {
			throw new Exception("no such post with id: ".$postid);
		}
		// Check if the Post author is the currentUser (in Session)
		if ($post->getAuthor() != $this->currentUser) {
			throw new Exception("logged user is not the author of the post id ".$postid);
		}
		if (isset($_POST["submit"])) { // reaching via HTTP Post...
			// populate the Post object with data form the form
			$post->setTitle($_POST["title"]);
			$post->setContent($_POST["content"]);
			try {
				// validate Post object
				$post->checkIsValidForUpdate(); // if it fails, ValidationException
				// update the Post object in the database
				$this->postMapper->update($post);
				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of posts
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash(sprintf(i18n("Post \"%s\" successfully updated."),$post ->getTitle()));
				// perform the redirection. More or less:
				// header("Location: index.php?controller=posts&action=index")
				// die();
				$this->view->redirect("posts", "index");
			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}
		// Put the Post object visible to the view
		$this->view->setVariable("post", $post);
		// render the view (/view/posts/add.php)
		$this->view->render("posts", "edit");
	}

	public function delete() {
		if (!isset($_POST["id"])) {
			throw new Exception("id is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing posts requires login");
		}

		// Get the Post object from the database
		$postid = $_REQUEST["id"];
		$post = $this->postMapper->findById($postid);
		// Does the post exist?
		if ($post == NULL) {
			throw new Exception("no such post with id: ".$postid);
		}
		// Check if the Post author is the currentUser (in Session)
		if ($post->getAuthor() != $this->currentUser) {
			throw new Exception("Post author is not the logged user");
		}
		// Delete the Post object from the database
		$this->postMapper->delete($post);
		// POST-REDIRECT-GET
		// Everything OK, we will redirect the user to the list of posts
		// We want to see a message after redirection, so we establish
		// a "flash" message (which is simply a Session variable) to be
		// get in the view after redirection.
		$this->view->setFlash(sprintf(i18n("Post \"%s\" successfully deleted."),$post ->getTitle()));
		// perform the redirection. More or less:
		// header("Location: index.php?controller=posts&action=index")
		// die();
		$this->view->redirect("posts", "index");
	}
}
?>
