<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../controller/BaseController.php");

class UsersController extends BaseController {

	private $userMapper;
	public function __construct() {
		parent::__construct();
		$this->userMapper = new UserMapper();
		$this->view->setLayout("welcome");
	}

	public function login() {
		if (isset($_POST["alias"]) && isset($_POST["passwd"]) ){ // reaching via HTTP Post...
			//process login form
			if ($this->userMapper->isValidUser($_POST["alias"], $_POST["passwd"])) {
				$_SESSION["currentuser"]=$_POST["alias"];
				// send user to the restricted area (HTTP 302 code)
				$this->view->redirect("notes", "index");
			}else{
				$errors = array();
				$errors["general"] = i18n("Username is not valid");
				$this->view->setVariable("errors", $errors);
			}
		}
		// render the view (/view/users/login.php)
		$this->view->render("users", "login");
	}

	public function register() {
		$user = new User();
		if (isset($_POST["alias"]) && isset($_POST["name"]) && isset($_POST["passwd"])){ // reaching via HTTP Post...
			// populate the User object with data form the form
			$user->setAlias($_POST["alias"]);
      $user->setName($_POST["name"]);
			$user->setPasswd($_POST["passwd"]);
			try{

				$user->checkIsValidForRegister(); // if it fails, ValidationException
				// check if user exists in the database

				if (!$this->userMapper->aliasExists($_POST["alias"])){
					// save the User object into the database

					$this->userMapper->save($user);

					$this->view->setFlash(i18n("Alias")." ".$user->getAlias().i18n(" successfully added. Please login now"));
					// perform the redirection. More or less:
					// header("Location: index.php?controller=users&action=login")
					// die();
					$this->view->redirect("users", "login");
				} else {
					$errors = array();
					$errors["alias"] = i18n("Alias already exists");
					$this->view->setVariable("errors", $errors);
				}
			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}
		// Put the User object visible to the view
		$this->view->setVariable("user", $user);
		// render the view (/view/users/register.php)
		$this->view->render("users", "register");
	}
	
	public function logout() {
		session_destroy();
		// perform a redirection. More or less:
		// header("Location: index.php?controller=users&action=login")
		// die();
		$this->view->redirect("users", "login");
	}
}
