<?php

$conn = new mysqli('localhost', 'root', '', 'books');
if ($conn->connect_error) {
    die('Przepraszamy za błąd.');
}

class Book {

    private $id;
    private $name;
    private $desc;
    private $author;

    public function __construct() {
        $this->id = - 1;
        $this->name = '';
        $this->desc = '';
        $this->author = '';
    }

    public function loadFromDB(&$conn, $id) {
        if (!is_numeric($id) || $id < 1) {
            return false;
        }
        $sql = "SELECT * FROM ksiazki WHERE id = $id";

        $result = $conn->query($sql);

        if (count($result) !== 1) {
            return false;
        }
        $linia = $result->fetch_assoc();
        $this->id = $id;
        $this->name = $linia['nazwa'];
        $this->desc = $linia['opis'];
        $this->author = $linia['autor'];

        return $this;
    }

    public function create(&$conn, $name, $author, $desc) {
        if (!(is_string($name) && is_string($author) && is_string($desc))) {
            return false;
        }
        $sql = "INSERT INTO ksiazki(nazwa, autor, opis) VALUES('" . $conn->escape_string($name) . "', '" . $conn->escape_string($author) . "', '" . $conn->escape_string($desc) . "')";
        $result = $conn->query($sql);

        $this->id = $conn->insert_id;
        $this->name = $name;
        $this->desc = $desc;
        $this->author = $author;

        return $this;
    }

    public function update(&$conn, $name, $author, $desc) {
        if ($this->id == -1) {
            return false;
        }
        if (!(is_string($name) && is_string($author) && is_string($desc))) {
            return false;
        }
        $sql = "UPDATE ksiazki SET nazwa='" . addslashes($name) . "', autor='" . addslashes($author) . "', opis='" . addslashes($desc) . "' WHERE id=" . $this->id ;
        $conn->query($sql);


        $this->name = $name;
        $this->desc = $desc;
        $this->author = $author;

        return $this;
    }

    public function deleteFromDB(&$conn) {
        if ($this->id == -1) {
            return false;
        }
        $sql = "DELETE FROM ksiazki WHERE id=" . $this->id;
        $result = $conn->query($sql);
    }

    public function getBook() {
        if ($this->id == -1) {
            return false;
        }
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'author' => $this->author,
            'description' => $this->desc
        );
    }

}
