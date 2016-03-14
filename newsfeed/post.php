<?php
session_start();
include("inc/header.php");
?>
    <div class="niceWhite"></div>
    <div id="previewDiv">
        <button class="btn btn-default" id="closePrev">Close Preview</button>
        <div id="prevHeader"></div>
        <div style="clear: both;"></div>
        <hr>
        <div id="prevBody"></div>
    </div>
    <div id="allPage">
<?php include("inc/top.php"); ?>
    <div id="content">
        <div id="body">
<?php
if (isset($_SESSION['name'])) {
    if ($_GET['mode'] == "create") {
        echo <<<END
            <div class="posting">
                <div id="login-text">
					<h1 style="color: #000 !important;" class="postHeader">Bericht schrijven voor de home page</h1>
				</div>
                <form method="post">
                    <input type="text" name="pTitle" placeholder="Titel" required class="form-control" id="pTitle">
                    <br>
                    <textarea name="pBody" id="pBody" placeholder="Typ het bericht hier" class="form-control" required id="pBody"></textarea>
                    <br>
                    <input type="submit" name="submit" class="btn btn-primary" value="Post">
                    <button type="button" class="btn btn-primary" id="preview">Preview</button>
                </form>
            </div>
END;
        //the next code sets the timezone to GMT, London.
		//I chose london cuz its da +0 timezone.
        date_default_timezone_set('Europe/Amsterdam');

		//This gives the variables the output of the functions
		//first let's do the date
		$PostDate = date('j F o');
		//now lets do time
		$PostTime = date('g\:i A T');
        $pTitle = isset($_POST['pTitle'])?$link->real_escape_string($_POST['pTitle']):"";
        $pBody = isset($_POST['pBody'])?$link->real_escape_string($_POST['pBody']):"";
        $poster = $_SESSION['name'];
        if (isset($_POST['submit'])) {
            $query = "INSERT
                INTO
                    posts (title, body, poster, date, time)
                VALUES ('$pTitle', '$pBody', '$poster', '$PostDate', '$PostTime') ";
            $link->query($query);
            header('Location:index.php');
        }
    } else if (isset($_GET['id']) && (isset($_GET['mode']) && ($_GET['mode'] == "edit" ))) {
        $id = $_GET['id'];
        $query = "SELECT
            *
        FROM
            posts
        WHERE
            id='$id'";
        $row = $link->query($query)->fetch_array();
        $postTitle = $row['title'];
        $postBody = $row['body'];
        echo <<<END
            <div class="posting">
                <div id="login-text">
					<h1 style="color: #000 !important;" class="postHeader">Bewerken</h1>
				</div>
                <form method="post">
                    <input type="text" name="pTitle" placeholder="Titel" required class="form-control" value="$postTitle" id="pTitle">
                    <br>
                    <textarea name="pBody" id="pBody" placeholder="Typ het bericht hier" class="form-control" required id="pBody">$postBody</textarea>
                    <br>
                    <input type="submit" name="submit" class="btn btn-primary" value="Done">
                    <button type="button" class="btn btn-primary" id="preview">Preview</button>
                </form>
            </div>
END;
        $pTitle = isset($_POST['pTitle'])?$link->real_escape_string($_POST['pTitle']):"";
        $pBody = isset($_POST['pBody'])?$link->real_escape_string($_POST['pBody']):"";
        if (isset($_POST['submit'])) {
            $query = "UPDATE
                posts
            SET
                body='$pBody',
                title='$pTitle'
            WHERE
                id='$id'";
            $link->query($query);
            header('Location:index.php');
        }
    } else if (isset($_GET['id']) && (isset($_GET['mode']) && ($_GET['mode'] == "delete" ))) {
        $id = $_GET['id'];
        $query = "DELETE
        FROM
            posts
        WHERE
            id = '$id'";
        $link->query($query);
        header('Location:index.php');
    }
} else {
    echo <<<END
            <div class="posting">
                <p class="post">Please <a href='login'>login</a> first... >:v</p>
            </div>
END;
}
include("inc/footer.php");
