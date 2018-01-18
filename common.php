<?php include("top.html"); ?>
<!--
	Shahria Kazi, CSE 190M, Section MK, TA: Tyler Rigsby, May 2nd, 2012
	This page contains common code that are shared between both the film search pages.
	It also contains functions that captures common code that displays the films of a given actor.
-->

<?php
$firstname = $_GET["firstname"];
$lastname = $_GET["lastname"];

$imdb = new PDO("mysql:dbname=imdb;host=localhost", "wastar09", "2xgL2Mx9fdtDU");
$fname = $imdb->quote($firstname);
$lname = $imdb->quote($lastname);

# Query that searches for a actor given the last name
# exactly and firstname starting with the letters that the user types.
# If more than one actor with the identical lastnames exists
# then the one with the highest film counts gets chosen and returns that actors id
$search_actor = $imdb->query("SELECT id
						FROM actors
						WHERE first_name LIKE '$firstname%' AND last_name = $lname
						ORDER BY film_count DESC
						LIMIT 1;");
						
$actor_id = $search_actor->fetchcolumn();
$actor_not_found = "Actor $firstname $lastname not found.";

# this function takes a firstname, lastname and a long string as parameters
# displays that string inside a paragraph
function exists($firstname, $lastname, $string) { ?>
	<p>
		<?= $string; ?>
	</p>
<?php }

# This function takes an array and an incrementor
# as parameters and loops over the array and displays
# the film title and year in a table
function displayTable($rows, $firstname, $lastname, $caption) { ?>
	<h1>Results for <?= $firstname; ?> <?= $lastname; ?></h1>
	<table>
		<caption><?= $caption; ?></caption>
		<tr>
			<th>#</th>
			<th>Title</th>
			<th>Year</th>
		</tr>
		<?php
		$i = 1;
		foreach($rows as $row) { ?>
			<tr>
				<td><?= $i++; ?></td>
				<td><?= $row["name"]; ?></td>
				<td><?= $row["year"]; ?></td>
			</tr>
		<?php } ?>
	</table>
<?php } ?>