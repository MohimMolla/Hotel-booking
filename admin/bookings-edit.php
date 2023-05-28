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
    $selectQ = "select * from bookings WHERE id = {$id} limit 1";
    $result = $conn->query($selectQ);
    if ($result->num_rows) {
        $row = $result->fetch_assoc();
    } else {
        exit;
    }
} else exit;

?>
<?php require __DIR__ . '/components/header.php'; ?>

</head>

<body>
    <div class="container">
        <form action="" method="post">
            <h2 class="text-center">Edit Bookings</h2>

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