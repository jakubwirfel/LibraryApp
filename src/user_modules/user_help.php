<?php
    try {
        $sql = "SELECT * FROM help_articles WHERE group_id = :user_group";
        $query = $database -> prepare($sql);
        $query -> bindParam(":user_group", $returned['group']);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
?>
<div class="container-fluid content_container py-1 px-5">
<h6 class="display-4 my-5">How can we help you?</h6>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-3">
        <?php
            while($helpRow = $query->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="col mb-4">
            <div class="card" style="height: 400px; overflow-y: scroll;">
                <div class="card-body ">
                    <h5 class="card-title"><?php echo $helpRow['article_title']?></h5>
                    <p class="card-text mh-100" ><?php echo $helpRow['article_content']?></p>
                </div>
            </div>
        </div>
            <?php }?>
    </div>
</div>