<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NASA Space Images</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
<!-- CREATED BY AKASH VISHWAKARMA -->
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center mb-5">NASA Space Images</h1>
<!-- Display images of Galaxy -->
<div class="card mt-5">
                <h2 class="card-header">Images of Galaxy</h2>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <?php
                        $api_key = "YOUR_API_KEY";
                        // Get images of Galaxy
                        $url = "https://api.nasa.gov/planetary/apod?api_key=$api_key&count=9";
                        $images = json_decode(file_get_contents($url));
                        if (!empty($images)) {
                            foreach ($images as $image) {
                                if ($image->media_type == "image") {
                        ?>
                                    <div class="col">
                                        <div class="card h-100">
                                            <img src="<?php echo $image->url; ?>" class="card-img-top" alt="<?php echo $image->title; ?>">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $image->title; ?></h5>
                                                <p class="card-text"><?php echo $image->explanation; ?></p>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                }
                            }
                        } else {
                            echo "<p>Sorry, no images available at this time.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>

        <!-- Display images from Earth -->
        <div class="card">
            <h2 class="card-header">Images from Earth</h2>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php
                    // Get images from Earth
                    $url = "https://api.nasa.gov/planetary/earth/assets?api_key=$api_key";
                    $images = json_decode(file_get_contents($url));
                    if (!empty($images)) {
                        foreach ($images as $image) {
                    ?>
                            <div class="col">
                                <div class="card h-100">
                                    <img src="<?php echo $image->url; ?>" class="card-img-top" alt="<?php echo $image->date; ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $image->date; ?></h5>
                                        <p class="card-text"><?php echo $image->caption; ?></p>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p>Sorry, no images available at this time.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Display images from Mars -->
        <div class="card mt-5">
            <h2 class="card-header">Images from Mars</h2>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php
                    // Get images from Mars
                    $url = "https://api.nasa.gov/mars-photos/api/v1/rovers/curiosity/photos?sol=1000&api_key=$api_key";
                    $images = json_decode(file_get_contents($url))->photos;
                    if (!empty($images)) {
                        foreach ($images as $image) {
                    ?>
                            <div class="col">
                                <div class="card h-100">
                                    <img src="<?php echo $image->img_src; ?>" class="card-img-top" alt="<?php echo $image->id; ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $image->camera->full_name; ?></h5>
                                        <p class="card-text"><?php echo $image->rover->name . " - Sol " . $image->sol; ?></p>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p>Sorry, no images available at this time.</p>";
                    }
                    ?>
                </div>
            </div>

            <div class="card mt-5">
                <h2 class="card-header">Images from Moon</h2>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <?php
                        // Get images from Moon
                        $url = "https://api.nasa.gov/moon/photos?api_key=$api_key";
                        $images = json_decode(file_get_contents($url));
                        if (!empty($images)) {
                            foreach ($images as $image) {
                        ?>
                                <div class="col">
                                    <div class="card h-100">
                                        <img src="<?php echo $image->img_src; ?>" class="card-img-top" alt="<?php echo $image->id; ?>">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $image->title; ?></h5>
                                            <p class="card-text"><?php echo $image->description; ?></p>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p>Sorry, no images available at this time.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Display images of Asteroids -->
            <div class="card mt-5">
                <h2 class="card-header">Images of Asteroids</h2>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <?php
                        // Get images of Asteroids
                        $url = "https://api.nasa.gov/neo/rest/v1/neo/browse?api_key=$api_key";
                        $asteroids = json_decode(file_get_contents($url))->near_earth_objects;
                        if (!empty($asteroids)) {
                            foreach ($asteroids as $asteroid) {
                                $images_url = "https://api.nasa.gov/neo/rest/v1/neo/" . $asteroid->id . "/images?api_key=$api_key";
                                $images = json_decode(file_get_contents($images_url))->near_earth_objects;
                                if (!empty($images)) {
                                    foreach ($images as $image) {
                        ?>
                                        <div class="col">
                                            <div class="card h-100">
                                                <img src="<?php echo $image->url; ?>" class="card-img-top" alt="<?php echo $asteroid->name; ?>">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $asteroid->name; ?></h5>
                                                    <p class="card-text"><?php echo $image->caption; ?></p>
                                                </div>
                                            </div>
                                        </div>
                        <?php
                                    }
                                } else {
                                    echo "<p>Sorry, no images available at this time.</p>";
                                }
                            }
                        } else {
                            echo "<p>Sorry, no images available at this time.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Display images of Solar Panels -->
            <div class="card mt-5">
                <h2 class="card-header">Images of Solar Panels</h2>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <?php
                        // Get images of Solar Panels
                        $url = "https://api.nasa.gov/mars-photos/api/v1/rovers/curiosity/photos?sol=1000&camera=mast&api_key=$api_key";
                        $images = json_decode(file_get_contents($url))->photos;
                        if (!empty($images)) {
                            foreach ($images as $image) {
                        ?>
                                <div class="col">
                                    <div class="card h-100">
                                        <img src="<?php echo $image->img_src; ?>" class="card-img-top" alt="<?php echo $image->id; ?>">
                                        <div class="card-body">
                                            <h5 class="card-title">Image from Curiosity Rover</h5>
                                            <p class="card-text">Taken by <?php echo $image->camera->full_name; ?> on <?php echo $image->earth_date; ?></p>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p>Sorry, no images available at this time.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- Display images of Satellites -->
            <div class="card mt-5">
                <h2 class="card-header">Images of Satellites</h2>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <?php
                        // Get images of Satellites
                        $url = "https://api.nasa.gov/planetary/apod?api_key=$api_key&count=6";
                        $images = json_decode(file_get_contents($url));
                        if (!empty($images)) {
                            foreach ($images as $image) {
                                if ($image->media_type == "image") {
                        ?>
                                    <div class="col">
                                        <div class="card h-100">
                                            <img src="<?php echo $image->url; ?>" class="card-img-top" alt="<?php echo $image->title; ?>">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $image->title; ?></h5>
                                                <p class="card-text"><?php echo $image->explanation; ?></p>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                }
                            }
                        } else {
                            echo "<p>Sorry, no images available at this time.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>

            
            <!-- Display videos of Asteroids -->
            <div class="card mt-5">
                <h2 class="card-header">Videos of Asteroids</h2>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <?php
                        // Get videos of Asteroids
                        $url = "https://api.nasa.gov/neo/rest/v1/feed?api_key=$api_key&start_date=2022-03-20&end_date=2022-03-26";
                        $data = json_decode(file_get_contents($url));
                        if (!empty($data)) {
                            foreach ($data->near_earth_objects as $date) {
                                foreach ($date as $asteroid) {
                                    $video_id = substr($asteroid->id, -6);
                                    $video_url = "https://www.youtube.com/watch?v=$video_id";
                        ?>
                                    <div class="col">
                                        <div class="card h-100">
                                            <iframe width="100%" height="225" src="<?php echo $video_url; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $asteroid->name; ?></h5>
                                                <p class="card-text"><?php echo $asteroid->close_approach_data[0]->close_approach_date_full; ?></p>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                }
                            }
                        } else {
                            echo "<p>Sorry, no videos available at this time.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
</body>

</html>
