

<?php
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>More Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <style>
        .questions {
            width: 800px;
            max-width: 800px;
            height: 70px;
            background: #353535;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: left;
            backdrop-filter: blur(10px);
            transition: 0.5s ease-in-out;
            margin: 0 auto;
        }

        .questions:hover {
            cursor: pointer;
            transform: scale(1.05);
        }

        .img {
            width: 50px;
            height: 50px;
            margin-left: 10px;
            border-radius: 10px;
            overflow: hidden;
        }

        .img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .textBox {
            width: calc(100% - 120px);
            margin-left: 10px;
            color: white;
            font-family: 'Poppins', sans-serif;
        }

        .textContent {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .span {
            font-size: 10px;
            padding-right: 3px;
            display: block;

        }

        .h1 {
            font-size: 12px;
            font-weight: lighter;
            padding-top: 5px;
            display: block;
        }

        .p {
            font-size: 12px;
            font-weight: lighter;
            overflow: auto;
            max-height: 200px;
        }
    </style>
</head>

<body>
    <?php include "header.php" ?>

    <?php
    if (isset($_GET['categoryid'])) {
        $categoryid = $_GET['categoryid'];
        $sql = "SELECT * FROM categories WHERE category_id=$categoryid";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $categoryName = $row['category_name'];
            $categoryDescription = $row['category_description'];
        } else {
            // No category found with the given ID
            $categoryName = "Unknown Category";
            $categoryDescription = "";
        }
    } else {
        // No category ID provided
        $categoryName = "Unknown Category";
        $categoryDescription = "";
    }
    ?>

    <!--jumbotron-->
    <div class="jumbotron my-5">
        <div class="container">
            <h1>Welcome to <span style="color: #072af0;"><?php echo $categoryName; ?></span> forum</h1>
            <p>This is a peer-to-peer forum. Listen and post questions and experiences about programming here.</p>
        </div>
    </div>

    <?php
    if (isset($_POST['save_btn'])) {
        $question = $_POST["question"];
        // Validate and sanitize user input
        $question = mysqli_real_escape_string($conn, $question);
        // Insert the question into the database
        $sql = "INSERT INTO questions (category_id, question) VALUES ($categoryid, '$question')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            // Question inserted successfully
            echo '<div class="alert alert-success">Question posted successfully.</div>';
        } else {
            // Failed to insert question
            echo '<div class="alert alert-danger">Failed to post the question. Please try again.</div>';
        }
    }
    ?>

    <div class="container">
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="questionDescription" class="form-label">Ask a question about <?php echo $categoryName; ?></label>
                <textarea class="form-control" id="questionDescription" name="question" rows="5" placeholder="Enter your question"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="save_btn">Submit</button>
        </form>
    </div>

    <!-- Fetch and display questions for the category -->
    <div class="container">
        <h4 class="mx-5 text-center">Browse questions:</h4>
        <?php
        $sql = "SELECT * FROM questions WHERE category_id=$categoryid";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $question = $row['question'];
                $createdAt = $row['created_at'];

                echo '<div class="questions my-5">';
                echo '<div class="img"><img src="images/profile.png"></div>';
                echo '<div class="textBox">';
                echo '<div class="textContent">';
                echo '<a class="h1" style="font-size: 18px;">' . $categoryName . '</a>';
                echo '<span class="span">' . $createdAt . '</span>';
                echo '</div>';
                echo '<p class="p">' . $question . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No questions found for this category.</p>';
        }
        ?>
    </div>

    <!-- Your content goes here -->
    <?php include "footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
