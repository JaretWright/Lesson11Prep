<?php
    $pageTitle = 'Album Details';
    require_once('header.php');
?>

    <main class="container">
        <h1>Album Details</h1>

        <?php
            if (!empty($_GET['albumID']))
                $albumID = $_GET['albumID'];
            else
                $albumID = null;

            $title = null;
            $year = null;
            $artist = null;
            $genrePicked = null;
            $coverFile = null;

            // if the albumID exists, it is an edit situation and we need to
            //load the album from the DB
            if (!empty($albumID))
            {
                require_once('db.php');

                $sql = "SELECT * FROM albums WHERE albumID = :albumID";
                $cmd = $conn->prepare($sql);
                $cmd->bindParam(':albumID', $albumID, PDO::PARAM_INT);
                $cmd->execute();
                $album = $cmd->fetch();
                $conn = null;

                $title = $album['title'];
                $year = $album['year'];
                $artist = $album['artist'];
                $genrePicked = $album['genre'];
                $coverFile = $album['coverFile'];
            }
        ?>

        <form method="post" action="saveAlbum.php" enctype="multipart/form-data">
            <fieldset class="form-group">
                <label for="title" class="col-sm-2">Title: *</label>
                <input name="title" id="title" required placeholder="Album title"
                    value="<?php echo $title?>"/>
            </fieldset>

            <fieldset class="form-group">
                <label for="year" class="col-sm-2">Year:</label>
                <input name="year" id="year" type="number" min="1900" placeholder="Release Year"
                    value="<?php echo $year ?>"/>
            </fieldset>

            <fieldset class="form-group">
                <label for="artist" class="col-sm-2">Artist: *</label>
                <input name="artist" id="artist" required placeholder="Artist Name"
                    value="<?php echo $artist ?>"/>
            </fieldset>

            <fieldset class="form-group">
                <label for="genre" class="col-sm-2">Genre: *</label>
                <select name="genre" id="genre">
                    <?php
                        //Step 1 - connect to the DB
                        $conn = new PDO('mysql:host=localhost;dbname=php','root','admin');
                        $conn->setAttribute(PDO::ERRMODE_EXCEPTION);

                        //Step 2 - create the SQL statement
                        $sql = "SELECT * FROM genres";

                        //Step 3 - prepare & execute the SQL statement
                        $cmd = $conn->prepare($sql);
                        $cmd->execute();
                        $genres = $cmd->fetchAll();

                        //Step 4 - loop over the results to build the list with <option> </option>
                        foreach ($genres as $genre)
                        {
                            if ($genrePicked == $genre['genre']){
                                echo '<option selected>'.$genre['genre'].'</option>';
                            }

                            else{
                                echo '<option>'.$genre['genre'].'</option>';
                            }

                        }

                        //Step 5 - disconnect from the DB
                        $conn = null;

                    ?>
                </select>
            </fieldset>

            <fieldset class="form-group">
                <label for="coverFile" class="col-sm-2">Cover Image</label>
                <input name="coverFile" id="coverFile" type="file"/>
            </fieldset>

            <input name="albumID" id="albumID" value="<?php echo $albumID?>" type="hidden"/>
            <button class="btn btn-success col-sm-offset-2">Save</button>

        </form>

        <img height="200" src=<?php echo $coverFile?>>

    </main>

<?php require_once('footer.php') ?>
