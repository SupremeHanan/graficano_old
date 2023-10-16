<?php
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>

<style>
        
        .carousel-item img {
            max-height: 400px; 
            object-fit: cover;
            width: 100%;
        }
    </style>

<body>

<h2>Change</h2>
    <?php include "header.php" ?>

    <!-- Carousel images -->
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1593720219276-0b1eacd0aef4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=861&q=80" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h3>JavaScript</h3>
                    <h3><p>Some representative placeholder content for the first slide.</p></h3>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1566837945700-30057527ade0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h3>PHP</h3>
                    <h3><p>Some representative placeholder content for the first slide.</p></h3>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1526498460520-4c246339dccb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Django</h3>
                    <h3><p>Some representative placeholder content for the first slide.</p></h3>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <h1 id="categories"   class="text-center py-2">Discussion Categories</h1>
    <div class="container">
        <div class="row">
            <?php
            // Fetch all the categories
            $sql = "SELECT * FROM categories";
            $result = mysqli_query($conn, $sql);

            // Check if any categories were fetched
            if (mysqli_num_rows($result) > 0) {
                // Loop through the fetched categories
                while ($row = mysqli_fetch_assoc($result)) {
                    $categoryid = $row['category_id'];
                    $categoryName = $row['category_name'];
                    $categoryDescription = $row['category_description'];

                    // Generate HTML for the card with the fetched category data
                    echo '<div class="card col-lg-4 col-sm-12 col-md-6 my-5 mx-3">';
                    echo '<div class="card-details">';
                    echo '<p class="text-title" >' . $categoryName . '</p>';
                    echo '<p class="text-body">' . $categoryDescription . '</p>';
                    echo '</div>';
                    echo '<a class="card-button" href="more.php?categoryid=' . $categoryid . '">More Info</a>';
                    echo '</div>';
                }
            } else {
                echo 'No categories found.';
            }

            // Free the result variable
            mysqli_free_result($result);
            ?>
        </div>
    </div>

    <?php include "footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
