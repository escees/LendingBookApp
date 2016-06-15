<?php

require './src/book.php';
//print_r($conn);
//exit();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (!array_key_exists("id", $_GET)) {

            $sql = "SELECT id FROM ksiazki";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $ksiazki = [];
                while ($row = $result->fetch_assoc()) {
                    $ksiazki[] = (new Book())->loadFromDB($conn, $row['id'])->getBook();
                }
                echo json_encode($ksiazki);
            }
        } else {
            $id = $_GET['id'];
            $book = new Book();
            $book->loadFromDB($conn, $id);

            echo json_encode($book->getBook());
        }
        break;
    case 'POST':
        $nazwa = $_POST['name'];
        $autor = $_POST['author'];
        $opis = $_POST['desc'];
        //utworzenie nowego elementu
        $book = new Book();
        $res = $book->create($conn, $nazwa ,$autor, $opis);
        $ans = [
            'status' => !!$res
        ];
        echo json_encode($ans);
        break;
    case 'PUT':
        //Aktualizacja jednego elementu
        //pobieranie danych
        parse_str(file_get_contents('php://input'), $put_vars);

        //$put_vars odtąd przechowuje wszystkie przesłane wratości.

        $id = $put_vars['id'];
        $name = $put_vars['title'];
        $author = $put_vars['author'];
        $desc = $put_vars['desc'];

        $book = new Book;
        $book->loadFromDB($conn, $id);
        $res = $book->update($conn, $name, $author, $desc);
        $answer = [
            'status' => !!$res
        ];
        echo json_encode($answer);


        break;
    case 'DELETE':


        $id = $_GET['id'];
        $book = new Book;
        $book->loadFromDB($conn, $id);
        $res = $book->deleteFromDB($conn);
        $answer = [
            'status' => !!$res
        ];
        echo json_encode($answer);
        break;
}


