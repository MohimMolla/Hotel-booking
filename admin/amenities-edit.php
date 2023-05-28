<?php
require __DIR__ . '/../vendor/autoload.php';

use App\auth\Admin;
use App\db;

if (!Admin::Check()) {
    header('location: ./../login.php');
    exit;
}

$conn = db::connect();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $q = "select * from amenities where id ={$id} limit 1";
    $r = $conn->query($q);
    if ($r->num_rows) {
        $row = $r->fetch_assoc();
        // var_dump($row);
    } else {
        exit;
    }
} else exit;

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = ($_POST['name']);
    $description = ($_POST['desc']);
    $updateQ = "update amenities set name='" . $name . "',description='" . $description . "' where id='" . $id . "'";
    $conn->query($updateQ);
    if ($conn->affected_rows) {
        header("Location:amenities.php");
    } else {
        header("Location:amenities.php");
    }
}
?>
<?php require __DIR__ . '/components/header.php'; ?>

</head>

<body>
    <div class="container">
        <form action="" method="post">
            <h2 class="text-center">Edit Amenities</h2>

            <div class="row">
                <div class="col-md-6  offset-md-3">
                    <div class="form-group mb-2">
                        <label class="form-label">Name:</label>
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="text" name="name" class="form-control" value="<?= $row['name'] ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Description:</label>
                        <textarea class="form-control mb-2" name="desc" rows="10"><?= $row['description'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Update" name="update">

                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php require __DIR__ . '/components/footer.php'; ?>