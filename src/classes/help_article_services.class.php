<?php
class HelpArticleServices {
    protected $db;

    public function __construct($database) {
        $this -> db = $database;
    }

    public function addArticle($articleName, $articleTitle, $articleContent, $groupId) {
        global $errors;
        try {
            $sql = "INSERT INTO help_articles (`group_id`, `article_name`, `article_title`, `article_content`) VALUES (:groupId, :name, :title, :content)";
            $query = $this -> db -> prepare($sql);
            $query -> bindParam(":groupId", $groupId);
            $query -> bindParam(":name", $articleName);
            $query -> bindParam(":title", $articleTitle);
            $query -> bindParam(":content", $articleContent);
            $query -> execute();
            array_push($errors, "Article $articleName has been added");
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }

    public function deleteArticle($articleId) {
        try {
            $sql = "DELETE FROM help_articles WHERE article_id = :articleId";
            $query = $this -> db -> prepare($sql);
            $query -> bindParam(":articleId", $articleId);
            $query -> execute();
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }

    public function modifyArticle($articleId, $groupId, $articleName, $articleTitle, $articleContent) {
        try {
            global $errors;
            $sql = "UPDATE help_articles INNER JOIN groups on help_articles.group_id = id SET group_id=:groupId, article_name=:articleName, article_title=:title, article_content=:content WHERE article_id=:id";
            $query = $this -> db -> prepare($sql);
            $query -> bindParam(":groupId", $groupId);
            $query -> bindParam(":articleName", $articleName);
            $query -> bindParam(":title", $articleTitle);
            $query -> bindParam(":content", $articleContent);
            $query -> bindParam(":id", $articleId);
            $query -> execute();
            echo "<script>window.close();</script>";
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }
}
?>