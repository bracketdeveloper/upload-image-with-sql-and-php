<?php
// db.php have database connection
include "db.php";

// function to get all images from database
function getImages($conn)
{
    $query = "SELECT * FROM `images`";
    $result = mysqli_query($conn, $query);
    echo mysqli_error($conn);
    $data = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        {
            $data[] = $row;
        }
    }
    return $data;
}

$images = getImages($conn);
?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Upload Images with PHP and MYSQL</title>
        <link rel="stylesheet" href="bootstrap.css">
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>
    </head>
    <body>
    <!--
    Note:
    To upload images and other file 'enctype="multipart/form-data"' attribute is must for form
    -->
    <form enctype="multipart/form-data" method="post">
        <div class="form-group text-center" style="margin-top: 100px">
            <input type="file" name="image_name" required>
            <input type="submit" name="btn_submit_name">
        </div>

        <div>

        </div>
    </form>

    <table>
        <thead>
        <th>
            Images
        </th>
        </thead>
        <tbody>
        <tr>
            <?php
            // loop to get images
            foreach ($images as $item) {
                ?>
                <td>
                    <img src="images/<?php echo $item['img']?>" alt="" width="200px" height="200px">
                </td>
                <?php
            }
            ?>
        </tr>
        </tbody>
    </table>

    </body>
    </html>
<?php
if (isset($_POST['btn_submit_name'])) {
    $image = $_FILES['image_name']['name'];

    $targetImage1 = "images/" . basename($image);

    move_uploaded_file($_FILES['image_name']['tmp_name'], $targetImage1);

    $sql = "INSERT INTO `images`(`img`) VALUES ('$image')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('image is uploaded successfully')
              </script>";
    } else {
        echo "<script>
                alert('Some error occurs')
              </script>";
    }
}


?>