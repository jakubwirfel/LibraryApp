<?php
if (isset($_POST['searchRented']) && $_POST['searchRented'] !== '') {
    try {
        $searchRented =  '%' . $_POST['searchRented'] . '%';
        $sql = "SELECT * FROM rented LEFT JOIN books on rented.rented_book_id = book_id LEFT JOIN users on  rented.rented_user_id = user_id WHERE last_name LIKE :search OR book_title LIKE :search";
        $query = $database -> prepare($sql);
        $query -> bindParam(":search", $searchRented);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
} else {
    try {
        $sql = "SELECT * FROM rented LEFT JOIN books on rented.rented_book_id = book_id LEFT JOIN users on  rented.rented_user_id = user_id";
        $query = $database -> prepare($sql);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
}

if (isset($_POST['backBook']) && $_POST['backBook'] == 'backBook' && isset($_POST['bookToBack'])) {
    $bookServices = new BookServices($database);
    $rentedId = $_POST['bookToBack'];
    $title = $_POST['title'];
    $bookServices -> deleteRented($rentedId);
    array_push($errors, "Book $title has been given back");
}

if(($returned['group'] != "1") && ($returned['permissions'] != "user = 1")) :
?>
<div class="container-fluid content_container py-1 px-5">
<h6 class="display-4 my-5">Give the book back</h6>
<form action="index.php?book_rented" method="POST">
        <div class="input-group md-form form-sm form-1 pl-0 pb-3">
            <div class="input-group-prepend">
                <span class="input-group-text bg-primary lighten-2" id="basic-text1"><i class="fas fa-search text-white"
                    aria-hidden="true"></i></span>
            </div>
            <input class="form-control my-0 py-1" name="searchRented" type="text" placeholder="Search by user last name / book title" aria-label="Search" value ="<?php if(isset($_POST['searchRented'])) { echo $_POST['searchRented'];} else {echo '';}?>">

        </div>
    </form>
    <form action="index.php?book_rented" method="POST">
        <div class="col-md-auto text-center">
            <button type="submit" name="backBook" value="backBook" class="btn btn-danger my-3">Give the book back</button>
        </div>
        <table class="table table-dark table-hover">
            <thead>
            <tr class="text-center">
                <th>Book title</th>
                <th>Reserving</th>
                <th>From</th>
                <th>To</th>
                <th>Surcharge</th>
                <th>Give back</th>
            </tr>
            </thead>
            <tbody>
            <?php
                while($rentedRow = $query->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr class="text-center user_row">
                <td>"<?php echo $rentedRow['book_title']?>"</td>
                <td><?php echo $rentedRow['first_name'] . " " . $rentedRow['last_name']?></td>
                <td><?php echo $rentedRow['rented_from']?></td>
                <td><?php echo $rentedRow['rented_to']?></td>
                <td>
                    <?php
                        $datetime1 = date_create();
                        $datetime2 = date_create($rentedRow['rented_to']);
                        $interval = date_diff($datetime2, $datetime1);
                        if ($datetime1 >= $datetime2 ) {
                        echo $interval->format('%R%a days');
                        }
                    ?>
                </td>
                <td><input type="radio" class="radio-btn" name="bookToBack" value="<?php echo $rentedRow['rented_id']?>" ></td>
                <input type="hidden" name="title" value="<?php  echo $rentedRow['book_title']?>">
            </tr>
            <?php }?>
            </tbody>
        </table>
    </form>
</div>
<?php endif ?>