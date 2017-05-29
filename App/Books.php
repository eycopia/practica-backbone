<?php namespace App;
class Books {
	private $db;

	public function __construct(){

		$this->db = new \SQLite3( dirname(__FILE__) . "/book.db");
		//$this->db->exec('CREATE TABLE book (id integer primary key, title STRING, author STRING, release_date DATETIME, keywords string)');
		//$this->db->exec("INSERT INTO book (rowid, title, author, release_date, keywords)
		//  VALUES (null, 'Un titulo', 'un autor', '2017-05-03', 'un libro')");
	}

	public function all(){
		$result = $this->db->query("select * from book");
		$data =  array();
		while($res = $result->fetchArray(SQLITE3_ASSOC)){
			$data[] = $res;
        }
		$this->db->close();
		return $data;
	}

	public function add($data){
		$this->db->exec("INSERT INTO book (rowid, title, author, release_date, keywords)
		 VALUES (null, '{$data['title']}', '{$data['author']}', '{$data['release_date']}', '{$data['keywords']}')");
	}

	public function delete($id){
		$result = $this->db->query("DELETE from book WHERE id = $id ");
		$data =  $result->fetchArray(SQLITE3_ASSOC);
		$this->db->close();
	}
}