<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/6b773fe9e4.js" crossorigin="anonymous"></script>
    <style type="text/css">
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 5px;
        }
        body {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <section class="pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="float-left">users Details</h2>
                        <a href="users-create.php" class="btn btn-success float-right">Add New Record</a>
                        <a href="users-index.php" class="btn btn-info float-right mr-2">Reset View</a>
                        <a href="index.php" class="btn btn-secondary float-right mr-2">Back</a>
                    </div>

                    <div class="form-row">
                        <form action="users-index.php" method="get">
                        <div class="col">
                          <input type="text" class="form-control" placeholder="Search this table" name="search">
                        </div>
                    </div>
                        </form>
                    <br>

                    <?php
                    // Include config file
                    require_once "config.php";
                    require_once "helpers.php";

                    //Get current URL and parameters for correct pagination
                    $protocol = $_SERVER['SERVER_PROTOCOL'];
                    $domain     = $_SERVER['HTTP_HOST'];
                    $script   = $_SERVER['SCRIPT_NAME'];
                    $parameters   = $_SERVER['QUERY_STRING'];
                    $protocol=strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https')
                                === FALSE ? 'http' : 'https';
                    $currenturl = $protocol . '://' . $domain. $script . '?' . $parameters;

                    //Pagination
                    if (isset($_GET['pageno'])) {
                        $pageno = $_GET['pageno'];
                    } else {
                        $pageno = 1;
                    }

                    //$no_of_records_per_page is set on the index page. Default is 10.
                    $offset = ($pageno-1) * $no_of_records_per_page;

                    $total_pages_sql = "SELECT COUNT(*) FROM users";
                    $result = mysqli_query($link,$total_pages_sql);
                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $no_of_records_per_page);

                    //Column sorting on column name
                    $orderBy = array('id', 'chat_id', 'fio', 'nomer', 'manzil', 'jins', 'faoliyat', 'tugyil', 'value', 'status', 'text', 'qadam', 'til', 'captcha', 'oferta', 'son', 'ism', 'familiya', 'soha', 'komp', 'lavozim');
                    $order = 'id';
                    if (isset($_GET['order']) && in_array($_GET['order'], $orderBy)) {
                            $order = $_GET['order'];
                        }

                    //Column sort order
                    $sortBy = array('asc', 'desc'); $sort = 'desc';
                    if (isset($_GET['sort']) && in_array($_GET['sort'], $sortBy)) {
                          if($_GET['sort']=='asc') {
                            $sort='desc';
                            }
                    else {
                        $sort='asc';
                        }
                    }

                    // Attempt select query execution
                    $sql = "SELECT * FROM users ORDER BY $order $sort LIMIT $offset, $no_of_records_per_page";
                    $count_pages = "SELECT * FROM users";


                    if(!empty($_GET['search'])) {
                        $search = ($_GET['search']);
                        $sql = "SELECT * FROM users
                            WHERE CONCAT_WS (id,chat_id,fio,nomer,manzil,jins,faoliyat,tugyil,value,status,text,qadam,til,captcha,oferta,son,ism,familiya,soha,komp,lavozim)
                            LIKE '%$search%'
                            ORDER BY $order $sort
                            LIMIT $offset, $no_of_records_per_page";
                        $count_pages = "SELECT * FROM users
                            WHERE CONCAT_WS (id,chat_id,fio,nomer,manzil,jins,faoliyat,tugyil,value,status,text,qadam,til,captcha,oferta,son,ism,familiya,soha,komp,lavozim)
                            LIKE '%$search%'
                            ORDER BY $order $sort";
                    }
                    else {
                        $search = "";
                    }

                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            if ($result_count = mysqli_query($link, $count_pages)) {
                               $total_pages = ceil(mysqli_num_rows($result_count) / $no_of_records_per_page);
                           }
                            $number_of_results = mysqli_num_rows($result_count);
                            echo " " . $number_of_results . " results - Page " . $pageno . " of " . $total_pages;

                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th><a href=?search=$search&sort=&order=id&sort=$sort>id</th>";
										echo "<th><a href=?search=$search&sort=&order=chat_id&sort=$sort>chat_id</th>";
										echo "<th><a href=?search=$search&sort=&order=fio&sort=$sort>fio</th>";
										echo "<th><a href=?search=$search&sort=&order=nomer&sort=$sort>nomer</th>";
										echo "<th><a href=?search=$search&sort=&order=manzil&sort=$sort>manzil</th>";
										echo "<th><a href=?search=$search&sort=&order=jins&sort=$sort>jins</th>";
										echo "<th><a href=?search=$search&sort=&order=faoliyat&sort=$sort>faoliyat</th>";
										echo "<th><a href=?search=$search&sort=&order=tugyil&sort=$sort>tugyil</th>";
										echo "<th><a href=?search=$search&sort=&order=value&sort=$sort>value</th>";
										echo "<th><a href=?search=$search&sort=&order=status&sort=$sort>status</th>";
										echo "<th><a href=?search=$search&sort=&order=text&sort=$sort>text</th>";
										echo "<th><a href=?search=$search&sort=&order=qadam&sort=$sort>qadam</th>";
										echo "<th><a href=?search=$search&sort=&order=til&sort=$sort>til</th>";
										echo "<th><a href=?search=$search&sort=&order=captcha&sort=$sort>captcha</th>";
										echo "<th><a href=?search=$search&sort=&order=oferta&sort=$sort>oferta</th>";
										echo "<th><a href=?search=$search&sort=&order=son&sort=$sort>son</th>";
										echo "<th><a href=?search=$search&sort=&order=ism&sort=$sort>ism</th>";
										echo "<th><a href=?search=$search&sort=&order=familiya&sort=$sort>familiya</th>";
										echo "<th><a href=?search=$search&sort=&order=soha&sort=$sort>soha</th>";
										echo "<th><a href=?search=$search&sort=&order=komp&sort=$sort>komp</th>";
										echo "<th><a href=?search=$search&sort=&order=lavozim&sort=$sort>lavozim</th>";
										
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";echo "<td>" . $row['chat_id'] . "</td>";echo "<td>" . $row['fio'] . "</td>";echo "<td>" . $row['nomer'] . "</td>";echo "<td>" . $row['manzil'] . "</td>";echo "<td>" . $row['jins'] . "</td>";echo "<td>" . $row['faoliyat'] . "</td>";echo "<td>" . $row['tugyil'] . "</td>";echo "<td>" . $row['value'] . "</td>";echo "<td>" . $row['status'] . "</td>";echo "<td>" . $row['text'] . "</td>";echo "<td>" . $row['qadam'] . "</td>";echo "<td>" . $row['til'] . "</td>";echo "<td>" . $row['captcha'] . "</td>";echo "<td>" . $row['oferta'] . "</td>";echo "<td>" . $row['son'] . "</td>";echo "<td>" . $row['ism'] . "</td>";echo "<td>" . $row['familiya'] . "</td>";echo "<td>" . $row['soha'] . "</td>";echo "<td>" . $row['komp'] . "</td>";echo "<td>" . $row['lavozim'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='users-read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><i class='far fa-eye'></i></a>";
                                            echo "<a href='users-update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><i class='far fa-edit'></i></a>";
                                            echo "<a href='users-delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><i class='far fa-trash-alt'></i></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
?>
                                <ul class="pagination" align-right>
                                <?php
                                    $new_url = preg_replace('/&?pageno=[^&]*/', '', $currenturl);
                                 ?>
                                    <li class="page-item"><a class="page-link" href="<?php echo $new_url .'&pageno=1' ?>">First</a></li>
                                    <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                                        <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo $new_url ."&pageno=".($pageno - 1); } ?>">Prev</a>
                                    </li>
                                    <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                                        <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo $new_url . "&pageno=".($pageno + 1); } ?>">Next</a>
                                    </li>
                                    <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                                        <a class="page-item"><a class="page-link" href="<?php echo $new_url .'&pageno=' . $total_pages; ?>">Last</a>
                                    </li>
                                </ul>
<?php
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }

                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>
</html>