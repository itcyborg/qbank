<?php
    @session_start();
    $term = "";
    $output = "";
    /**
     * Created by PhpStorm.
     * User: itcyb
     * Date: 5/21/2017
     * Time: 10:35 AM
     */

    if (isset($_REQUEST['search'])) {
        $url = $_SERVER['DOCUMENT_ROOT'] . "/api/search.php";
        require_once $url;
        $search = new search();
        $_SESSION['error'] = "";
        $term = "";
        if (isset($_POST['search_term'])) {
            $term = $_POST['search_term'];
        } else {
            $term = $_GET['search_term'];
        }
        if (trim($term) !== "" && trim($term) !== null) {
            try {
                $results = $search->all($term);
                foreach ($results as $result) {
                    $output .= "
                <div class='result'>
                      <h2><a href='$result->link'>$result->title</a></h2>
                      <p><blockquote>Source: $result->source</blockquote><div class='snippet'>$result->snippet</div></p>
                </div>
            ";
                }
            } catch (searchException $e) {
                $_SESSION['error'] = $e->getMessage();
                if (!isset($_REQUEST['ajax'])) {
                    header('location:' . $referrer);
                }
            }
        } else {
            $_SESSION['error'] = "Please enter a search term";
        }
        if (isset($_POST['ajax'])) {
            if (isset($_SESSION['error'])) {
                echo $_SESSION['error'];
            }
            echo $output;
            die();
        }
    }
?>
<!doctype html>
<html>
<head>
    <title>Integrated Learning</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<style>
    input[type=search] {
        width: 75%;
        min-width: 400px;
    }

    .header {
        text-align: center;
    }

    .header h2 {
        float: left;
    }

    form {
        padding: 15px;
        float: right;
        margin-right: 33%;
    }

    .main {
        padding: 30px;
        align-content: center;
        clear: both;
    }

    blockquote {
        font-style: italic;
    }

    .snippet {
        color: #4a595a;
    }

    a {
        color: #555555;
    }
</style>
<div class="header">
    <h2>Integrated Learning System</h2>
    <form action="search.php" method="get">
        <input type="search" placeholder="Search" value="<?php echo $term; ?>" name="search_term" id="search_term">
        <input type="submit" value="Search" name="search">
    </form>
</div>
<div class="main">
    <div class="status"></div>
    <div class="search">
        <?php echo $output; ?>
    </div>
</div>
<div class="footer"></div>
</body>
</html>
