<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.min.css" type="text/css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
</head>
<body>
<div id="header">
<?php
// depending if the user is logged in, show a personalized
// set of links in the navigation
if(isset($_SESSION['name']))
	{
		$links = '
			<ul id="nav-admin">
			<li><a href="http://www.nachtvancuijk.nl/">Home</a></li>
			<li><a href="http://www.nachtvancuijk.nl/contact">Contact</a></li>
			<li><a href="http://www.nachtvancuijk.nl/about">Over ons</a></li>
			<li><a href="http://www.nachtvancuijk.nl/tickets">Tickets</a></li>
			<li><a href="http://www.nachtvancuijk.nl/programma">Programma</a></li>
			<li><a href="http://www.nachtvancuijk.nl/post.php?mode=create">Post</a></li>
			<li><a href="http://www.nachtvancuijk.nl/logout.php">Log Out</a></li>
			</ul>';
	} else {
    $links = '
		<ul id="nav-user">
		<li><a href="http://www.nachtvancuijk.nl/">Home</a></li>
		<li><a href="http://www.nachtvancuijk.nl/contact">Contact</a></li>
		<li><a href="http://www.nachtvancuijk.nl/about">Over ons</a></li>
		<li><a href="http://www.nachtvancuijk.nl/tickets">Tickets</a></li>
		<li><a href="http://www.nachtvancuijk.nl/programma">Programma</a></li>
		</ul>';
}
echo $links;
?>
</div>
</body>
</html>