<?php
// Include config file
require_once "config.php";
require_once "helpers.php";

// Define variables and initialize with empty values
$type = "";
$title_ru = "";
$title_uz = "";
$pId = "";
$slug = "";
$sort = "";

$type_err = "";
$title_ru_err = "";
$title_uz_err = "";
$pId_err = "";
$slug_err = "";
$sort_err = "";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
        $type = trim($_POST["type"]);
		$title_ru = trim($_POST["title_ru"]);
		$title_uz = trim($_POST["title_uz"]);
		$pId = trim($_POST["pId"]);
		$slug = trim($_POST["slug"]);
		$sort = trim($_POST["sort"]);
		

        $dsn = "mysql:host=$db_server;dbname=$db_name;charset=utf8mb4";
        $options = [
          PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
          PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
        ];
        try {
          $pdo = new PDO($dsn, $db_user, $db_password, $options);
        } catch (Exception $e) {
          error_log($e->getMessage());
          exit('Something weird happened'); //something a user can understand
        }

        $vars = parse_columns('cat', $_POST);
        $stmt = $pdo->prepare("INSERT INTO cat (type,title_ru,title_uz,pId,slug,sort) VALUES (?,?,?,?,?,?)");

        if($stmt->execute([ $type,$title_ru,$title_uz,$pId,$slug,$sort  ])) {
                $stmt = null;
                header("location: cat-index.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <section class="pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add a record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="form-group">
                                <label>type</label>
                                <input type="text" name="type" maxlength="255"class="form-control" value="<?php echo $type; ?>">
                                <span class="form-text"><?php echo $type_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>title_ru</label>
                                <input type="text" name="title_ru" maxlength="255"class="form-control" value="<?php echo $title_ru; ?>">
                                <span class="form-text"><?php echo $title_ru_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>title_uz</label>
                                <input type="text" name="title_uz" maxlength="255"class="form-control" value="<?php echo $title_uz; ?>">
                                <span class="form-text"><?php echo $title_uz_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>pId</label>
                                <input type="number" name="pId" class="form-control" value="<?php echo $pId; ?>">
                                <span class="form-text"><?php echo $pId_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>slug</label>
                                <input type="text" name="slug" maxlength="255"class="form-control" value="<?php echo $slug; ?>">
                                <span class="form-text"><?php echo $slug_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>sort</label>
                                <input type="number" name="sort" class="form-control" value="<?php echo $sort; ?>">
                                <span class="form-text"><?php echo $sort_err; ?></span>
                            </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="cat-index.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>