<?php include("common.php"); ?>
<!--
	Shahria Kazi, CSE 190M, Section MK, TA: Tyler Rigsby, May 2nd, 2012
	This webpage is designed to search all films of a given actor with Kevin Bacon
	and display	them in a table containining a number, the title of the movie and
	year it	released in descending order.
	if there is more than one actor with identical last names, 
	the actor with the highest films gets displayed.
-->

<?php 
# Query that searches for the list of films and their corresponding
# release year with Kevin Bacon based on an actors id and
# orders them by year descending and the movie name ascending.

$rows = $imdb->query("SELECT name, year
					FROM actors a1
					JOIN roles r1 ON a1.id = r1.actor_id
					JOIN movies m ON m.id = r1.movie_id
					JOIN roles r2 ON m.id = r2.movie_id
					JOIN actors a2 ON a2.id = r2.actor_id
					WHERE a1.first_name = 'Kevin' AND
					a1.last_name = 'Bacon' AND
					a2.id = $actor_id
					ORDER BY year DESC, name ASC;");

$caption = "Films with $firstname $lastname and Kevin Bacon";
$films_with_bacon = "$firstname $lastname wasn't in any films with Kevin Bacon.";

# tests to see whether the actor exists and has a
# list of the films with Kevin Bacon. If the actor exists and have
# done films with Kevin Bacon then displays a table containing
# the list of films of the actor along with the year
# the movie released. If the actor does not exist or have not been
# in any films with kevin bacon then displays a message saying so.
if($rows != null && $rows->rowCount() > 0) {
	displayTable($rows, $firstname, $lastname, $caption);
} else if($search_actor->rowCount() == 1) {
	exists($firstname, $lastname, $films_with_bacon);
} else {
	exists($firstname, $lastname, $actor_not_found);
}

include("bottom.html"); ?>