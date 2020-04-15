<?php
    try {
        $sql = "SELECT * FROM posts ORDER BY post_id DESC LIMIT 6";
        $query = $database -> prepare($sql);
        $query -> bindParam(":user_group", $returned['group']);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
?>
<div class="container-fluid content_container py-1 px-5">
<h6 class="display-4 my-5">Ours newest books </h6>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-3">
        <?php
            while($postRow = $query->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="col mb-4">
            <div class="card">
                <img src="<?php echo $postRow['img_dir']?>" class="card-img-top" alt="<?php echo $postRow['img_name']?>" style="max-height: 300px !important">
                <div class="card-body" style="height: 300px; overflow-y: scroll;">
                    <h5 class="card-title"><?php echo $postRow['title']?></h5>
                    <h6 class="card-text text-center"><?php echo $postRow['header'] . " ". $postRow['date']?></h6>
                    <p class="card-text" ><?php echo $postRow['content']?></p>
                    <h6 class="card-text"><?php echo $postRow['footer']?></h6>
                </div>
            </div>
        </div>
            <?php }?>
    </div>
</div>