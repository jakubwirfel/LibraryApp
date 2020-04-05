<?php
class BookServices {
    protected $db;

    private $_suporttedFormats = ['image/png','image/jpeg','image/jpg','image/gif'];

    public function __construct($database) {
        $this -> db = $database;
    }

    public function addBook($title, $author, $description, $type, $date, $pages, $image) {
        global $errors;
        if (is_array($image)) {
            if (in_array($image['type'], $this->_suporttedFormats)) {
                try {
                move_uploaded_file($image['tmp_name'],'./public/uploads/book_img/'. $image['name']);
                $imagePath = './public/uploads/book_img/'. $image['name'];
                $imageName = $image['name'];
                $sql = "INSERT INTO books (`book_title`, `book_author`, `book_description`, `book_type`, `book_pub_year`, `book_num_pages`, `book_img_title`, `book_img_dir`) VALUES (:title, :author, :description, :type, :date, :pages, :imgTitle, :imgDir)";
                $query = $this -> db -> prepare($sql);
                $query -> bindParam(":title", $title);
                $query -> bindParam(":author", $author);
                $query -> bindParam(":description", $description);
                $query -> bindParam(":type", $type);
                $query -> bindParam(":date", $date);
                $query -> bindParam(":pages", $pages);
                $query -> bindParam(":imgTitle", $imageName);
                $query -> bindParam(":imgDir", $imagePath);
                $query -> execute();
                array_push($errors, "Book $title has been added");
                } catch (PDOException $e) {
                    array_push($errors, $e->getMessage());
                }
            } else {
                array_push($errors, "File format is not supported");
            }
        } else {
            array_push($errors, "No file was uploaded!");
        }
    }
}
?>