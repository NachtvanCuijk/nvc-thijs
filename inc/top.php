<div id="top">
<div id="banner"></div>
<div id="navigation">
<?php
// depending if the user is logged in, show a personalized
// set of links in the navigation
if(isset($_SESSION['name']))
	{
		$links = '
			<ul id="nav-admin">
			<li><a href="../">Home</a></li>
			<li><a href="../info">Info</a></li>
			<li><a href="../programma">Programma</a></li>
			<li><a href="../tickets">Tickets</a></li>
			<li><a href="../about">Over ons</a></li>
			<li><a href="../contact">Contact</a></li>
			<li><a href="../post.php?mode=create">Post</a></li>
			<li><a href="../logout.php">Log Out</a></li>
			</ul>';
	} else {
    $links = '
		<ul id="nav-user">
		<li><a href="../">Home</a></li>
		<li><a href="../info">Info</a></li>
		<li><a href="../programma">Programma</a></li>
		<li><a href="../tickets">Tickets</a></li>
		<li><a href="../about">Over ons</a></li>
		<li><a href="../contact">Contact</a></li>
		</ul>';
}
echo $links;
?>
<div style="clear:both;"></div>
</div>
</div>