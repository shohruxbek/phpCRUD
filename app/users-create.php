<?php
// Include config file
require_once "config.php";
require_once "helpers.php";

// Define variables and initialize with empty values
$chat_id = "";
$fio = "";
$nomer = "";
$manzil = "";
$jins = "";
$faoliyat = "";
$tugyil = "";
$value = "";
$status = "";
$text = "";
$qadam = "";
$til = "";
$captcha = "";
$oferta = "";
$son = "";
$ism = "";
$familiya = "";
$soha = "";
$komp = "";
$lavozim = "";

$chat_id_err = "";
$fio_err = "";
$nomer_err = "";
$manzil_err = "";
$jins_err = "";
$faoliyat_err = "";
$tugyil_err = "";
$value_err = "";
$status_err = "";
$text_err = "";
$qadam_err = "";
$til_err = "";
$captcha_err = "";
$oferta_err = "";
$son_err = "";
$ism_err = "";
$familiya_err = "";
$soha_err = "";
$komp_err = "";
$lavozim_err = "";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
        $chat_id = trim($_POST["chat_id"]);
		$fio = trim($_POST["fio"]);
		$nomer = trim($_POST["nomer"]);
		$manzil = trim($_POST["manzil"]);
		$jins = trim($_POST["jins"]);
		$faoliyat = trim($_POST["faoliyat"]);
		$tugyil = trim($_POST["tugyil"]);
		$value = trim($_POST["value"]);
		$status = trim($_POST["status"]);
		$text = trim($_POST["text"]);
		$qadam = trim($_POST["qadam"]);
		$til = trim($_POST["til"]);
		$captcha = trim($_POST["captcha"]);
		$oferta = trim($_POST["oferta"]);
		$son = trim($_POST["son"]);
		$ism = trim($_POST["ism"]);
		$familiya = trim($_POST["familiya"]);
		$soha = trim($_POST["soha"]);
		$komp = trim($_POST["komp"]);
		$lavozim = trim($_POST["lavozim"]);
		

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

        $vars = parse_columns('users', $_POST);
        $stmt = $pdo->prepare("INSERT INTO users (chat_id,fio,nomer,manzil,jins,faoliyat,tugyil,value,status,text,qadam,til,captcha,oferta,son,ism,familiya,soha,komp,lavozim) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        if($stmt->execute([ $chat_id,$fio,$nomer,$manzil,$jins,$faoliyat,$tugyil,$value,$status,$text,$qadam,$til,$captcha,$oferta,$son,$ism,$familiya,$soha,$komp,$lavozim  ])) {
                $stmt = null;
                header("location: users-index.php");
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
                                <label>chat_id</label>
                                <input type="number" name="chat_id" class="form-control" value="<?php echo $chat_id; ?>">
                                <span class="form-text"><?php echo $chat_id_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>fio</label>
                                <input type="text" name="fio" maxlength="255"class="form-control" value="<?php echo $fio; ?>">
                                <span class="form-text"><?php echo $fio_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>nomer</label>
                                <input type="text" name="nomer" maxlength="50"class="form-control" value="<?php echo $nomer; ?>">
                                <span class="form-text"><?php echo $nomer_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>manzil</label>
                                <input type="text" name="manzil" maxlength="255"class="form-control" value="<?php echo $manzil; ?>">
                                <span class="form-text"><?php echo $manzil_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>jins</label>
                                <input type="text" name="jins" maxlength="22"class="form-control" value="<?php echo $jins; ?>">
                                <span class="form-text"><?php echo $jins_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>faoliyat</label>
                                <input type="text" name="faoliyat" maxlength="255"class="form-control" value="<?php echo $faoliyat; ?>">
                                <span class="form-text"><?php echo $faoliyat_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>tugyil</label>
                                <input type="text" name="tugyil" maxlength="22"class="form-control" value="<?php echo $tugyil; ?>">
                                <span class="form-text"><?php echo $tugyil_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>value</label>
                                <input type="text" name="value" maxlength="22"class="form-control" value="<?php echo $value; ?>">
                                <span class="form-text"><?php echo $value_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>status</label>
                                <input type="number" name="status" class="form-control" value="<?php echo $status; ?>">
                                <span class="form-text"><?php echo $status_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>text</label>
                                <textarea name="text" class="form-control"><?php echo $text ; ?></textarea>
                                <span class="form-text"><?php echo $text_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>qadam</label>
                                <input type="text" name="qadam" maxlength="50"class="form-control" value="<?php echo $qadam; ?>">
                                <span class="form-text"><?php echo $qadam_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>til</label>
                                <input type="text" name="til" maxlength="22"class="form-control" value="<?php echo $til; ?>">
                                <span class="form-text"><?php echo $til_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>captcha</label>
                                <input type="number" name="captcha" class="form-control" value="<?php echo $captcha; ?>">
                                <span class="form-text"><?php echo $captcha_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>oferta</label>
                                <input type="number" name="oferta" class="form-control" value="<?php echo $oferta; ?>">
                                <span class="form-text"><?php echo $oferta_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>son</label>
                                <input type="text" name="son" maxlength="255"class="form-control" value="<?php echo $son; ?>">
                                <span class="form-text"><?php echo $son_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>ism</label>
                                <input type="text" name="ism" maxlength="500"class="form-control" value="<?php echo $ism; ?>">
                                <span class="form-text"><?php echo $ism_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>familiya</label>
                                <input type="text" name="familiya" maxlength="500"class="form-control" value="<?php echo $familiya; ?>">
                                <span class="form-text"><?php echo $familiya_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>soha</label>
                                <input type="text" name="soha" maxlength="500"class="form-control" value="<?php echo $soha; ?>">
                                <span class="form-text"><?php echo $soha_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>komp</label>
                                <input type="text" name="komp" maxlength="500"class="form-control" value="<?php echo $komp; ?>">
                                <span class="form-text"><?php echo $komp_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>lavozim</label>
                                <input type="text" name="lavozim" maxlength="500"class="form-control" value="<?php echo $lavozim; ?>">
                                <span class="form-text"><?php echo $lavozim_err; ?></span>
                            </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="users-index.php" class="btn btn-secondary">Cancel</a>
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