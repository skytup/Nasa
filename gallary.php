<!DOCTYPE html>
<html>
<head>
	<title>NASA API Demo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
<style>
    /* Gallery container */
    .gallery {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin: 0 auto;
        padding: 20px;
        max-width: 1200px;
    }

    /* Gallery item */
    .gallery-item {
        position: relative;
        width: 300px;
        height: 200px;
        margin: 10px;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
        cursor: pointer;
    }

    /* Gallery image */
    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    /* Gallery item hover */
    .gallery-item:hover img {
        transform: scale(1.1);
    }

    /* Gallery overlay */
    .gallery-item .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    /* Gallery item hover */
    .gallery-item:hover .overlay {
        opacity: 1;
    }

    /* Gallery item text */
    .gallery-item .text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #fff;
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    /* Gallery item hover */
    .gallery-item:hover .text {
        opacity: 1;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }

    @media screen and (max-width: 768px) {
        .gallery {
            padding: 10px;
        }

        .gallery-item {
            width: 100%;
            height: 300px;
        }
    }
</style>


</head>
<body>

<div class="gallery">

    <?php
    $api_key = "XeBRWZy0uXz8Jy2wm4RN1vewaadrgApt85xxiYXy";
    // Get the latest Mars Rover Photos
    $url = "https://api.nasa.gov/mars-photos/api/v1/rovers/curiosity/latest_photos?api_key=$api_key";
    $data = json_decode(file_get_contents($url));

    // Display the latest Mars Rover Photos

    if ($data) {
        foreach ($data->latest_photos as $photo) {
    ?>

            <div class="gallery-item">
                <img src="<?php echo $photo->img_src; ?>" alt="<?php echo $photo->camera->full_name; ?>">
                <div class="overlay">
                    <div class="text"><?php echo $photo->camera->full_name; ?></div>
                </div>
            </div>
    <?php
        }
    } else {
        echo "<p>Sorry, no Mars Rover Photos available at this time.</p>";
    }
    ?>

</div>
</body>
</html>