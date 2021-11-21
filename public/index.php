<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require(__DIR__.'/../vendor/autoload.php');

use Symfony\Component\HttpClient\HttpClient;

$client = HttpClient::create();
$imgRes = $client->request('GET', "http://shibe.online/api/shibes", [
	'query' => [
		'count' => 1
	]
]);

$factRes = $client->request('GET', "https://uselessfacts.jsph.pl/random.json?language=en");

$img = json_decode($imgRes->getContent())[0];
$fact = json_decode($factRes->getContent())->text;

$translationLink = "https://translate.google.com/?sl=auto&tl=pl&op=translate&text=".urlencode($fact);

?>

<!DOCTYPE HTML>
<html>
<head>
<style type="text/css">
	body
	{
		background-color: black;
		color: white;
		padding: 0;
		margin: 0;
		overflow: hidden;
		display: flex;
		justify-content: center;
		align-items: center;
		height: 100vh;
		width: 100vw;
	}

	main
	{
		width: 1000px;
		height: 800px;
	}

	main img
	{
		min-width: 100%;
		min-height: 100%;
		object-fit: cover;
	}

	main div
	{
		width: 100%;
		height: 700px;
		overflow: hidden;
		border: 3px solid white;
	}

	.btn
	{
		margin: 0;
		padding: 0;
		width: 100px;
		height: 50px;
		border: 3px solid white;
		background-color: black;
		color: white;
	}

	.btn:hover
	{
		border-color: black;
		color: black;
		background-color: white;
		cursor: pointer;
	}
</style>
</head>
<body>

<main>
	<div>
		<img src="<?php echo $img; ?>">
	</div>

	<h3><?php echo  $fact; ?></h3>
	<a href="<?php echo  $translationLink; ?>" target="_blank"> <button class="btn">Przetłumacz!</button></a>
</main>

</body>
</html>