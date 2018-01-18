<?php include("common.php"); ?>
<!--
	Shahria Kazi, CSE 190M, Section MK, TA: Tyler Rigsby, May 2nd, 2012
	This webpage is designed to search all films of a given actor and display
	them in a table containining a number, the title of the movie and year it
	released in descending order.
	if there is more than one actor with identical last names, 
	the actor with the highest films gets displayed.
-->

<?php 
# Query that searches for the movie name and year
# of the given actors id and orders them by year descending and
# the movie name ascending.
$rows = $imdb->query("SELECT name, year
					FROM roles
					JOIN movies ON movies.id = roles.movie_id
					JOIN actors ON actors.id = roles.actor_id
					WHERE actors.id = $actor_id
					ORDER BY year DESC, name ASC;");
$caption = "All Films";

# tests to see whether the actor exists and has a
# list of  films, if the actor exists then
# displays a table containing the list of films of the actor along
# with the year the movie released, if the actor does not exist
# then displays a message saying so.
if($rows != null && $rows->rowCount() > 0) {
	displayTable($rows, $firstname, $lastname, $caption);
} else {
	exists($firstname, $lastname, $actor_not_found);
}

include("bottom.html"); ?>