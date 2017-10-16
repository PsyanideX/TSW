<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Note.php");

class NoteMapper {

	private $db;
	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function findAll($currentuser) {
		$stmt = $this->db->prepare("SELECT * FROM notes WHERE alias =?");
		$stmt->execute(array($currentuser));
		$notes_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$notes = array();
		foreach ($notes_db as $note) {
			$alias = new User($note["alias"]);
			array_push($notes, new Note($note["id_note"], $note["title"], $note["content"], $alias));
		}
		return $notes;
	}


	public function findById($id_note){
		$stmt = $this->db->prepare("SELECT * FROM notes WHERE id_note=?");
		$stmt->execute(array($id_note));
		$note = $stmt->fetch(PDO::FETCH_ASSOC);
		if($note != null) {
			return new Note($note["id_note"], $note["title"],	$note["content"],	new User($note["alias"]));
		} else {
			return NULL;
		}
	}

		public function save(Note $note) {
			$stmt = $this->db->prepare("INSERT INTO notes(title, content, alias) values (?,?,?)");
			$stmt->execute(array($note->getTitle(), $note->getContent(), $note->getUser()->getAlias()));
			return $this->db->lastInsertId();
		}

		public function update(Note $note) {
			$stmt = $this->db->prepare("UPDATE notes set title=?, content=? where id_note=?");
			$stmt->execute(array($note->getTitle(), $note->getContent(), $note->getIdNote()));
		}

		public function delete(Note $note) {
			$stmt = $this->db->prepare("DELETE from notes WHERE id_note=?");
			$stmt->execute(array($note->getIdNote()));
		}

    public function shareNote(Note $note, User $user){
      $stmt = $this->db->prepare("INSERT INTO shared_notes(alias, id_note) values (?,?)");
      $stmt->execute(array($user->getAlias(), $note->getIdNote()));
    }

    public function unshareNote(Note $note, User $user){
      $stmt = $this->db->prepare("DELETE from shared_notes WHERE id_note=? AND alias=?");
			$stmt->execute(array($note->getIdNote(),$user->getAlias()));
    }

		public function findAllShared($currentuser) {
			$stmt = $this->db->prepare("SELECT notes.id_note, notes.title, notes.content, notes.alias FROM notes, shared_notes WHERE notes.id_note =shared_notes.id_note AND shared_notes.alias = ?");
			$stmt->execute(array($currentuser));
			$notes_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
			//if($notes_db != NULL){
				$notes = array();
				foreach ($notes_db as $note) {
					$alias = new User($note["alias"]);
					array_push($notes, new Note($note["id_note"], $note["title"], $note["content"], $alias));
				}
				return $notes;
			/*}else{
				return NULL;
			}*/

		}
	}
?>
