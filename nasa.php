<?php
	// Define API key for NASA's API
	$api_key = "YOUR_API_KEY";

	// Get data from NASA's API
	$url = "https://api.nasa.gov/planetary/apod?api_key=$api_key&count=6";
	$data = json_decode(file_get_contents($url));
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>NASA Data</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">
			<div class="jumbotron">
				<h1 class="display-4">NASA Data</h1>
				<p class="lead">Explore the wonders of space with NASA's APIs.</p>
			</div>

			<!-- Display status data -->
			<div class="card">
				<h2 class="card-header">Status Data</h2>
				<div class="card-body">
					<p>Stay up-to-date with the latest news and events from NASA.</p>
					<a href="https://www.nasa.gov/" class="btn btn-primary">View NASA Website</a>
				</div>
			</div>

			<!-- Display images -->
			<div class="card">
				<h2 class="card-header">NASA Images</h2>
				<div class="card-body">
					<div class="row">
						<?php
						if ($data) {
							foreach ($data as $image) {
								if ($image->media_type == "image") {
									?>
									<div class="col-md-4">
										<div class="card">
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

			<!-- Display videos -->
			<div class="card">
				<h2 class="card-header">NASA Videos</h2>
				<div class="card-body">
					<div class="row">
						<?php
						if ($data) {
							foreach ($data as $video) {
								if ($video->media_type == "video") {
									?>
									<div class="col-md-4">
										<div class="card">
											<div class="embed-responsive embed-responsive-16by9">
												<iframe class="embed-responsive-item" src="<?php echo $video->url; ?>" allowfullscreen></iframe>
											</div>
											<div class="card-body">
												<h5 class="card-title"><?php echo $video->title; ?></h5>
												<p class="card-text"><?php echo $video->explanation; ?></p>
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

		<!-- Display space details -->
		<div class="card">
			<h2 class="card-header">Space Details</h2>
			<div class="card-body">
				<p>Explore the universe with NASA's space details.</p>
				<a href="https://api.nasa.gov/" class="btn btn-primary">View NASA API</a>
			</div>
		</div>

		<!-- Display amazing facts -->
		<div class="card">
			<h2 class="card-header">Amazing Facts</h2>
			<div class="card-body">
				<?php
					// Get random fact from NASA's API
					$url = "https://api.nasa.gov/planetary/apod?api_key=$api_key&count=1&thumbs=true";
					$fact = json_decode(file_get_contents($url))[0];
				?>
				<img src="<?php echo $fact->url; ?>" class="float-end mx-3 my-2" alt="<?php echo $fact->title; ?>" style="width: 200px;">
				<p><?php echo $fact->explanation; ?></p>
			</div>
		</div>

		<!-- Display weather data -->
		<div class="card">
			<h2 class="card-header">Weather Data</h2>
			<div class="card-body">
				<p>Get the latest weather information for space missions and more.</p>
				<a href="https://api.nasa.gov/" class="btn btn-primary">View NASA API</a>
			</div>
		</div>

		<!-- Display additional information -->
		<div class="card">
			<h2 class="card-header">Additional Information</h2>
			<div class="card-body">
				<p>Visit NASA's website to learn more about space exploration and research.</p>
				<a href="https://www.nasa.gov/" class="btn btn-primary">View NASA Website</a>
			</div>
		</div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
</body>
</html>
