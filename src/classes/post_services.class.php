<?php
class PostServices {
    protected $db;

    private $_suporttedFormats = ['image/png','image/jpeg','image/jpg','image/gif'];

    public function __construct($database) {
        $this -> db = $database;
    }

    public function addPost($title, $header, $content, $footer, $image) {
        global $errors;
        if (is_array($image)) {
            if (in_array($image['type'], $this->_suporttedFormats)) {
                try {
                move_uploaded_file($image['tmp_name'],'./public/uploads/post_img/'. $image['name']);
                $imagePath = './public/uploads/post_img/'. $image['name'];
                $imageName = $image['name'];
                $date = date("Y-m-d");
                $creator = $_SESSION['user_session'];
                $likes_empty = 0;
                $sql = "INSERT INTO posts (`creator`, `date`, `img_name`, `img_dir`, `title`, `header`, `content`, `footer`, `likes`) VALUES (:creator, :date, :img_name, :img_dir, :title, :header, :content, :footer, :likes)";
                $query = $this -> db -> prepare($sql);
                $query -> bindParam(":creator", $creator);
                $query -> bindParam(":date", $date);
                $query -> bindParam(":img_name", $imageName);
                $query -> bindParam(":img_dir", $imagePath);
                $query -> bindParam(":title", $title);
                $query -> bindParam(":header", $header);
                $query -> bindParam(":content", $content);
                $query -> bindParam(":footer", $footer);
                $query -> bindParam(":likes", $likes_empty);
                $query -> execute();
                array_push($errors, "Post $title added");
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

    public function deletePost($postId, $imgPath) {
        global $errors;
        try {
            $sql = "DELETE FROM posts WHERE post_id = :postId";
            $query = $this -> db -> prepare($sql);
            $query -> bindParam(":postId", $postId);
            $query -> execute();
            unlink($imgPath);
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }

    public function modifyPost($postId, $title, $header, $content, $footer, $image, $imgPath, $imgName, $likes) {
    global $errors;
            if (in_array($image['type'], $this->_suporttedFormats)) {
                try {
                    unlink($imgPath);
                    move_uploaded_file($image['tmp_name'],'./public/uploads/post_img/'. $image['name']);
                    $imgPath = './public/uploads/post_img/'. $image['name'];
                    $imgName = $image['name'];
                    $date = date("Y-m-d");
                    $creator = $_SESSION['user_session'];
                    $sql = "UPDATE posts INNER JOIN users on posts.creator = users.user_id SET creator=:creator, date=:date, img_name=:imgName, img_dir=:imgDir, title=:title, header=:header, content=:content, footer=:footer, likes=:likes WHERE post_id=:postId";
                    $query = $this -> db -> prepare($sql);
                    $query -> bindParam(":creator", $creator);
                    $query -> bindParam(":date", $date);
                    $query -> bindParam(":imgName", $imgName);
                    $query -> bindParam(":imgDir", $imgPath);
                    $query -> bindParam(":title", $title);
                    $query -> bindParam(":header", $header);
                    $query -> bindParam(":content", $content);
                    $query -> bindParam(":footer", $footer);
                    $query -> bindParam(":likes", $likes);
                    $query -> bindParam(":postId", $postId);
                    $query -> execute();
                    echo "<script>window.close();</script>";
                } catch (PDOException $e) {
                    array_push($errors, $e->getMessage());
                }
            } else {
                try {
                    $date = date("Y-m-d");
                    $creator = $_SESSION['user_session'];
                    $sql = "UPDATE posts INNER JOIN users on posts.creator = users.user_id SET creator=:creator, date=:date, img_name=:imgName, img_dir=:imgDir, title=:title, header=:header, content=:content, footer=:footer, likes=:likes WHERE post_id=:postId";
                    $query = $this -> db -> prepare($sql);
                    $query -> bindParam(":creator", $creator);
                    $query -> bindParam(":date", $date);
                    $query -> bindParam(":imgName", $imgName);
                    $query -> bindParam(":imgDir", $imgPath);
                    $query -> bindParam(":title", $title);
                    $query -> bindParam(":header", $header);
                    $query -> bindParam(":content", $content);
                    $query -> bindParam(":footer", $footer);
                    $query -> bindParam(":likes", $likes);
                    $query -> bindParam(":postId", $postId);
                    $query -> execute();
                    echo "<script>window.close();</script>";
                } catch (PDOException $e) {
                    array_push($errors, $e->getMessage());
                }
            }
    }
}
?>