<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Recommender</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
  <h1>Movie Recommender</h1>
    <h2 id="userName"></h2>
<?php 
// Import all php files
include 'dbConnect.php';
?>

<!------------------------------------- SUGGESTION BOX STARTS ------------------------->
<div id="suggestionBox">
        <fieldset style="border: 1px black dashed">
        <legend>Suggested For You</legend>
        <div id="suggestionTable">
            <?php
            $query = "SELECT movie.title FROM movie LEFT JOIN movie_genre ON movie.id_movie=movie_genre.id_movie
            LEFT JOIN genre ON movie_genre.id_genre=genre.id_genre LEFT JOIN movie_kw ON
            movie.id_movie=movie_kw.id_movie LEFT JOIN keywords ON movie_kw.id_keywords=keywords.id_keywords

            LEFT JOIN movie_related_person ON movie.id_movie=movie_related_person.id_movie LEFT JOIN related_person ON
            movie_related_person.id_related_person=related_person.id_related_person LEFT JOIN person ON
            related_person.id_person=person.id_person LEFT JOIN roles ON related_person.id_role=roles.id_role

            LEFT JOIN rating ON movie.id_rating=rating.id_rating
            WHERE (
            movie.id_rating IS NULL AND movie_genre.id_genre IS NOT NULL AND (movie_genre.id_genre IN(SELECT genre.id_genre FROM movie
            LEFT JOIN movie_genre ON movie.id_movie=movie_genre.id_movie
            LEFT JOIN genre ON movie_genre.id_genre=genre.id_genre
            LEFT JOIN rating ON movie.id_rating=rating.id_rating
            WHERE (movie.id_rating>3 AND movie_genre.id_genre IS NOT NULL)) OR
            movie_kw.id_keywords IN(SELECT keywords.id_keywords FROM movie LEFT JOIN movie_kw ON movie.id_movie=movie_kw.id_movie
            LEFT JOIN keywords ON movie_kw.id_keywords=keywords.id_keywords
            LEFT JOIN rating ON movie.id_rating=rating.id_rating
            WHERE (movie.id_rating>3 AND movie_kw.id_keywords IS NOT NULL)) OR
            movie_kw.id_keywords IN(SELECT keywords.id_keywords FROM movie
            LEFT JOIN movie_kw ON movie.id_movie=movie_kw.id_movie
            LEFT JOIN keywords ON movie_kw.id_keywords=keywords.id_keywords
            LEFT JOIN rating ON movie.id_rating=rating.id_rating
            WHERE ( movie.id_rating>3 AND movie_kw.id_keywords IS NOT NULL)) OR
            movie_related_person.id_related_person IN(SELECT related_person.id_person FROM movie
            LEFT JOIN movie_related_person ON
            movie.id_movie=movie_related_person.id_movie
            LEFT JOIN related_person ON
            movie_related_person.id_related_person=related_person.id_related_person
            LEFT JOIN person ON related_person.id_person=person.id_person
            LEFT JOIN roles ON related_person.id_role=roles.id_role
            LEFT JOIN rating ON movie.id_rating=rating.id_rating
            WHERE (movie.id_rating>3 AND movie_related_person.id_related_person IS NOT NULL))))

            GROUP BY movie.title 
			ORDER BY RANDOM() LIMIT 5";
            
            if(!($selectRes = pg_query($query))) echo 'Retrieval of data from Database Failed';
            else {
            ?>
                <table border="1">
                <thead><tr><th>Movies you might like</th></tr></thead>
                <tbody>
            <?php
                if(pg_num_rows($selectRes) == 0) echo '<tr><td>No Suggestions</td></tr>';
                else {
                    while($row = pg_fetch_assoc($selectRes)) echo "<tr><td>{$row['title']}</td></tr>\n";
                }
            ?>
                </tbody>
                </table>
            <?php
            }
            ?>
        </div>
    </div><br>
<!------------------------------------- SUGGESTION BOX ENDS ------------------------->
<!------------------------------------- YOUR MOVIES STARTS HERE ----------------------------------------->
<div name="yourMovies">
    <fieldset style="border: 1px black solid">
    <legend style="border: 1px black solid;margin-left: 1em; padding: 0.2em 0.8em">Your Movies</legend>
    <div id="movieTable">
        <?php
        if(isset($_POST['showTopMovies'])){
            $query = "SELECT movie.title, movie.release_date, movie.min_age, rating.rating,  string_agg(genre.genre, ', ') AS Genre,language.language, country.country 
            FROM movie 
             
            LEFT JOIN movie_genre ON movie.id_movie=movie_genre.id_movie 
            LEFT JOIN genre ON movie_genre.id_genre=genre.id_genre 
            LEFT JOIN rating ON movie.id_rating=rating.id_rating
            LEFT JOIN language ON movie.id_language = language.id_language 
            LEFT JOIN country ON movie.id_country = country.id_country 
            WHERE movie.id_movie NOT IN(SELECT id_movie_2 FROM related_movies WHERE movie.id_movie=related_movies.id_movie_2) 
            GROUP BY title, language.language,country.country, movie.release_date, movie.min_age, rating.rating";

            if(!($selectRes = pg_query($query))) echo 'Retrieval of data from Database Failed';
        else {
            ?>
            <table border="1">
            <thead><tr><th>Title</th><th>Release Year</th><th>Minimum Age</th><th>Genre(s)</th><th>Rating</th><th>Country</th><th>Language</th></tr></thead>
            <tbody>
                <?php
                    if(pg_num_rows($selectRes) == 0) 
                        echo '<tr><td>No data</td></tr>';
                    else {
                        while($row = pg_fetch_assoc($selectRes)) 
                            echo "<tr><td>{$row['title']}</td><td>{$row['release_date']}</td><td>{$row['min_age']}</td><td>{$row['genre']}</td><td>{$row['rating']}</td><td>{$row['country']}</td><td>{$row['language']}</td></tr>\n";
                    }
                ?>
            </tbody>
            </table>
            <?php
            }
        }
            ?>
        </div>
        
        <div id="subMovieTable">
        <?php
        if(isset($_POST['showSubMovies'])){
            $query = "SELECT movie.title, movie.release_date, movie.min_age, rating.rating,  string_agg(genre.genre, ', ') AS Genre,language.language, country.country 
            FROM movie 
             
            LEFT JOIN movie_genre ON movie.id_movie=movie_genre.id_movie 
            LEFT JOIN genre ON movie_genre.id_genre=genre.id_genre 
            LEFT JOIN rating ON movie.id_rating=rating.id_rating
            LEFT JOIN language ON movie.id_language = language.id_language 
            LEFT JOIN country ON movie.id_country = country.id_country 
            WHERE movie.id_movie IN(SELECT id_movie_1 FROM related_movies WHERE movie.id_movie=related_movies.id_movie_1) OR movie.id_movie IN(SELECT id_movie_2 FROM related_movies WHERE movie.id_movie=related_movies.id_movie_2) 
            GROUP BY title, language.language,country.country, movie.release_date, movie.min_age, rating.rating ORDER BY soundex(title), release_date";

if(!($selectRes = pg_query($query))) echo 'Retrieval of data from Database Failed';
else {
    ?>
    <table border="1">
    <thead><tr><th>Title</th><th>Release Year</th><th>Minimum Age</th><th>Genre(s)</th><th>Rating</th><th>Country</th><th>Language</th></tr></thead>
    <tbody>
        <?php
            if(pg_num_rows($selectRes) == 0) 
                echo '<tr><td>No data</td></tr>';
            else {
                while($row = pg_fetch_assoc($selectRes)) 
                    echo "<tr><td>{$row['title']}</td><td>{$row['release_date']}</td><td>{$row['min_age']}</td><td>{$row['genre']}</td><td>{$row['rating']}</td><td>{$row['country']}</td><td>{$row['language']}</td></tr>\n";
            }
        ?>
    </tbody>
    </table>
    <?php
    }
}
?>
        </div>
    <hr><br>

    <div id="inputForm">
        <form name="inputForm" action="index.php" method="POST">
            <label for="title">Title</label><input type="text" id="title" name="title" size="50px" required>
            <label for="genre">Genre:</label>
                <input type="checkbox" name="genre[ ]" value = "Comedy">Comedy               
                <input type="checkbox" name="genre[ ]" value = "Action">Action      
                <input type="checkbox" name="genre[ ]" value = "Fantasy">Fantasy  
                <input type="checkbox" name="genre[ ]" value = "Drama">Drama<br/>
				<input type="checkbox" name="genre[ ]" value = "Thriller">Thriller<br/>

            <label for="minAge">Minimum Age</label>
            <select id="minAge" name="minAge" required>
                <option selected="selected">select</option>
                <option value="8">8</option><option value="10">10</option>
                <option value="12">12</option><option value="14">14</option>
                <option value="16">16</option><option value="18">18</option></select><br>

            <label for="releaseYear">Release Year</label>
            <input type="number" id="releaseYear" name="releaseYear" required>

            <label for="country">Country</label>
            <select id="country" name="country" required>
                <option selected="selected">select</option>
                <option value="USA">USA</option><option value="UK">UK</option><option value="Germany">Germany</option>
                <option value="Russia">Russia</option><option value="India">India</option><option value="New Zealand">New Zealand</option></select>

            <label for="language">Language</label>
            <select id="language" name="language" required>
                <option selected="selected">select</option>
                <option value="English">English</option><option value="Russian">Russian</option><option value="German">German</option>></select><br>

            <label for="rating">Rating</label>
            <select id="rating" name="rating">
                <option selected="selected" value="NULL">select</option>
                <option value="1">1</option><option value="2">2</option>
                <option value="3">3</option><option value="4">4</option><option value="5">5</option>
            </select><br><br>

            <label for="keywords">Keywords:</label><br>
                <input type="checkbox" name="keyword[]" value = "hero">Hero
                <input type="checkbox" name="keyword[]" value = "school">School
                <input type="checkbox" name="keyword[]" value = "blockbuster">Blockbuster
                <input type="checkbox" name="keyword[]" value = "epic">Epic<br>
                <input type="checkbox" name="keyword[]" value = "vampire">Vampire
                <input type="checkbox" name="keyword[]" value = "true love">True Love
                <input type="checkbox" name="keyword[]" value = "teen movie">Teen Movie
                <input type="checkbox" name="keyword[]" value = "crime">Crime<br><br>
                <input type="submit" name="addMovie" value="ADD MOVIE">
    
    <?php
    // Insert Movie
    if(isset($_POST['addMovie'])) {
        $title = $_POST["title"];
        $minAge = $_POST["minAge"];
        $releaseYear = $_POST["releaseYear"];
        $country = $_POST["country"];
        $language = $_POST["language"];
        $rating = $_POST["rating"];
        
        $query2 = "SELECT id_movie FROM movie WHERE soundex(title) = soundex('".$title."')";
        if(pg_query($query2)){
                $query = "INSERT INTO movie (title,min_age,id_rating,release_date,id_country,id_language) VALUES('".$title."',".$minAge.",(SELECT id_rating FROM rating WHERE rating=".$rating."), ".$releaseYear.", (SELECT id_country FROM country WHERE  country='".$country."'), (SELECT id_language FROM language WHERE language='".$language."'))";
                if(pg_query($query)){
                    $genre = $_POST["genre"];
                    foreach($genre as $g){
                        pg_query("INSERT INTO movie_genre (id_movie,id_genre) VALUES((SELECT id_movie FROM movie WHERE title='".$title."'),(SELECT id_genre FROM genre WHERE genre=('".$g."')))");
                    }
                    $keyword = $_POST["keyword"];
                    foreach($keyword as $kw){
                        pg_query("INSERT INTO movie_kw (id_movie,id_keywords) VALUES((SELECT id_movie FROM movie WHERE title='".$title."'),(SELECT id_keywords FROM keywords WHERE keywords=('".$kw."')))");
                    }
                    echo ("<i>Movie Inserted</i>");
                }
                else echo("Retrieval of Data from database failed");
                
        }
else{
    $genre = $_POST["genre"];
    $query = "INSERT INTO movie (title,min_age,id_rating,release_date,id_country,id_language) VALUES('".$title."',".$minAge.",(SELECT id_rating FROM rating WHERE rating=".$rating."), ".$releaseYear.", (SELECT id_country FROM country WHERE  country='".$country."'), (SELECT id_language FROM language WHERE language='".$language."'))";
            if(pg_query($query)){
                foreach($genre as $g){
                    pg_query("INSERT INTO movie_genre (id_movie,id_genre) VALUES((SELECT id_movie FROM movie WHERE title='".$title."'),(SELECT id_genre FROM genre WHERE genre=('".$g."')))");
                }
                $keyword = $_POST["keyword"];
                foreach($keyword as $kw){
                    pg_query("INSERT INTO movie_kw (id_movie,id_keywords) VALUES((SELECT id_movie FROM movie WHERE title='".$title."'),(SELECT id_keywords FROM keywords WHERE keywords=('".$kw."')))");
                }
                echo ("<i>Movie Inserted</i>");
            }
            else echo("Retrieval of Data from database failed");
            pg_query("INSERT INTO related_movies (id_movie_1,id_movie_2) VALUES((SELECT id_movie FROM movie WHERE soundex(title) = soundex('".$title."') ORDER BY release_date LIMIT 1),(SELECT id_movie FROM movie WHERE title ='".$title."'))");
       
}
    }
    ?>
        </form>
            <hr>
        <div id="movieController">
        <form method="post">
            <input type="submit" name="showTopMovies" value="SHOW MAIN MOVIES">
            <input type="submit" name="showSubMovies" value="SHOW SUB MOVIES">
            <input type="submit" name="updateMovie" value="CHANGE FILM" onclick="window.open('alterMovieData.php')">
            <input type="text" name="removeMovieName" placeholder="Remove Film">
            <input type="submit" name="deleteMovie" value="REMOVE FILM">    
            <?php 
            if(isset($_POST['deleteMovie'])) {
                $removeMovieName = $_POST['removeMovieName'];
                $subcheck1="SELECT id_movie_1 FROM related_movies WHERE id_movie_1=(SELECT id_movie FROM movie WHERE title='$removeMovieName') ";
                $subcheck2="SELECT id_movie_2 FROM related_movies WHERE id_movie_2=(SELECT id_movie FROM movie WHERE title='$removeMovieName') ";
                if($subcheck1==NULL){
                    $query = "DELETE FROM movie WHERE title = '$removeMovieName'";
                }
                else{
                $removeMovieName = $_POST['removeMovieName'];
                $query1 = "SELECT title FROM movie WHERE title='".$removeMovieName."'"; 
                $query2 = "DELETE FROM related_movies WHERE id_movie_1=(SELECT id_movie FROM movie WHERE title='".$removeMovieName."')"; 
                $query3 = "DELETE FROM movie_kw WHERE id_movie IN (SELECT id_movie FROM movie WHERE title='".$removeMovieName."')"; 
                $query4 = "DELETE FROM movie_genre WHERE id_movie IN (SELECT id_movie FROM movie WHERE title='".$removeMovieName."')"; 
                $query5 = "DELETE FROM movie WHERE id_movie IN (SELECT id_movie FROM movie WHERE soundex(title)=soundex('".$removeMovieName."'))";       // Write delete query
                $q1 = pg_query($query1);
                $q2 = pg_query($query2);
                $q3 = pg_query($query3);
                $q4 = pg_query($query4);
                $q5 = pg_query($query5);
                if(!($q1 && $q2 && $q3 && $q4 && $q5)) echo 'Retrieval of data from Database Failed';
                else echo("Film Deleted");
                }
    }
    ?>

        </form>
        </div>
    </fieldset>
    <br><br>
    <!-- Person Section-->
    <div class="personSection">
    <fieldset style="border: 1px black dashed">
        <legend style="border: 1px black dashed;margin-left: 1em; padding: 0.2em 0.8em">Person</legend>
        <div id="personTable">    
            <?php
                if(isset($_POST['showAllPersons'])){
                    $query = "SELECT person.person_name,person.dob,person.gender, roles.role_name,movie.title FROM related_person INNER JOIN person ON related_person.id_person=person.id_person INNER JOIN roles ON related_person.id_role=roles.id_role INNER JOIN movie_related_person 
                    ON related_person.id_related_person=movie_related_person.id_related_person
                    INNER JOIN movie ON movie_related_person.id_movie=movie.id_movie";
                    if(!($selectRes = pg_query($query))) echo 'Retrieval of data from Database Failed';
                else {
                ?>
                <table border="1">
                    <thead><tr><th width="20%">Person</th><th width="19%">Date of Birth</th><th width="10%">Gender</th><th>Role</th><th>Title/Series Performed</th></tr>
                    </thead>
                    <tbody>
                <?php
                    if(pg_num_rows($selectRes) == 0) echo '<tr><td>No data</td></tr>';
                    else {
                        while($row = pg_fetch_assoc($selectRes)) echo "<tr><td>{$row['person_name']}</td><td>{$row['dob']}</td><td>{$row['gender']}</td><td>{$row['role_name']}</td><td>{$row['title']}</td></tr>\n";
                    }
                ?>
                    </tbody>
                </table>
                <?php
                }
            }
            ?>
        </div>
        </form>
        <hr>
        <form method="post">
        <div id="formPerson">
                    <label for="person">Person</label>
                    <input type="text" id="person" name="person" size="30px" required>
                    <label for="associatedMovie">Associated Movie</label>
                    <input type="text" id="associatedMovie" name="associatedMovie" size="50px" required>
                    <label for="DOB">Date of Birth:</label><input type="date" id="dob" name="dob" required>
                    <label class="gender">Male<input type="radio" name="gender" value="Male"><span class="checkmark"></span></label>
                    <label class="gender">Female<input type="radio" name="gender" value="Female"><span class="checkmark"></span></label><br>
                    <label for="roles">Actor</label><input type="checkbox" name="roles[]" value = "actor">
                    <label for="roles">Director</label>
                    <input type="checkbox" name="roles[]" value = "director">
                    <label for="role">Producer</label>       
                    <input type="checkbox" name="roles[]" value = "producer"><br><br>
                    <input type="submit"  name="insertPerson" value="ADD PERSON"/>  
                    <?php 
        if(isset($_POST['insertPerson'])){
            $person = $_POST['person'];
            $dob = $_POST['dob'];
            $gender = $_POST['gender'];
            $associatedMovie = $_POST['associatedMovie'];
            
			// insert into person table
			$personCheck="INSERT INTO person (person_name) SELECT '".$person."' WHERE NOT EXISTS (SELECT person_name FROM person WHERE person_name = '".$person."')";
			
			
			if(pg_query($personCheck)){
				pg_query("UPDATE person SET  dob= '".$dob."', gender='".$gender."' WHERE person_name = '".$person."'");
			//insert into rp table
			$roles = $_POST["roles"];
				foreach($roles as $role){
				        pg_query("INSERT INTO related_person(id_person, id_role) SELECT (SELECT id_person FROM person WHERE person_name='".$person."'), 
			(SELECT id_role FROM roles WHERE role_name='".$role."') WHERE EXISTS (SELECT id_role FROM related_person WHERE id_role=(SELECT id_role FROM roles WHERE role_name='".$role."'))");
			
					}
					
					pg_query("DELETE FROM related_person a USING related_person b WHERE a.id_related_person<b.id_related_person AND a.id_person=b.id_person AND a.id_role=b.id_role");
			// add to movie_related_person
			// add to movie_related_person
			foreach($roles as $role){
			pg_query("INSERT INTO movie_related_person
    (id_related_person, id_movie)
SELECT (SELECT id_related_person FROM related_person WHERE 
(id_person=(SELECT id_person FROM person WHERE person_name='".$person."') AND 
id_role=(SELECT id_role FROM roles WHERE role_name='".$role."'))
), (SELECT id_movie FROM movie WHERE title='".$associatedMovie."')
WHERE
      NOT EXISTS (
	 
        SELECT id_related_person FROM movie_related_person WHERE (
		id_related_person=(SELECT id_related_person FROM related_person WHERE 
(id_person=(SELECT id_person FROM person WHERE person_name='".$person."') AND 
id_role=(SELECT id_role FROM roles WHERE role_name='".$role."')))
))

	");
		}
		}
		}
        ?>
        <hr>
        </div>
        </form>
        <form method="post">
                <input type="submit"  name="showAllPersons" value="SHOW ALL"/>
                <input type="submit"  name="alterPerson" value="CHANGE PERSON" onclick="window.open('alterPersonData.php');"/>
                <input type="text" name="removePersonName" placeholder="Remove Person"/>
                <input type="submit"  name="deletePerson" value="REMOVE PERSON" />
    <?php
        if(isset($_POST['deletePerson'])) {
        $removePerson = $_POST['removePersonName'];
        $query1 = "DELETE FROM movie WHERE id_movie IN (SELECT movie_related_person.id_movie FROM movie_related_person 
        LEFT JOIN movie_genre ON movie.id_movie=movie_genre.id_movie 
        LEFT JOIN movie_kw ON movie.id_movie=movie_kw.id_movie 
        LEFT JOIN related_movies ON movie.id_movie=related_movies.id_movie_1 
        LEFT JOIN related_person ON movie_related_person.id_related_person=related_person.id_related_person 
        LEFT JOIN person ON related_person.id_person=person.id_person 
        WHERE person.person_name='".$removePerson."')"; 
        $query2 = "DELETE FROM person WHERE person.person_name='".$removePerson."'";
        if(!(pg_query($query1) && pg_query($query2))) echo 'Retrieval of data from Database Failed';
        else echo("Person Deleted");
    }
    ?>
        </form>
    </div><br>
</div> 
</fieldset>
</div>
<!------------------------------------- INSERT MOVIE FORM ENDS ----------------------------------------->
<br>
<!------------------------------------- RATE YOUR MOVIES START ----------------------------------------->
    <div id="ratingBox">
        <fieldset style="border: 1px black dashed">
            <legend style="border: 1px black solid;margin-left: 1em; padding: 0.2em 0.8em">Rate your Movies </legend>
            <div id="ratingTable">
            <?php
            if(isset($_POST['showRating'])){
                $query = "SELECT title, rating FROM movie INNER JOIN rating ON movie.id_rating=rating.id_rating";  
                    if(!($selectRes = pg_query($query))) echo 'Retrieval of data from Database Failed';
                else {
                ?>
                <table border="1">
                    <thead><tr><th>Rated Movies</th><th>Ratings</th></tr></thead>
                    <tbody>
                <?php
                    if(pg_num_rows($selectRes) == 0) echo '<tr><td>No data</td><td>No data</td></tr>';
                    else {
                        while($row = pg_fetch_assoc($selectRes)) echo "<tr><td>{$row['title']}</td><td>{$row['rating']}</td></tr>";
                    }
                ?>
                    </tbody>
                </table>   
                <?php
                }
            }   
            ?>
            <hr>
            <form id="inputRating" method="post">
                <input type="text" name="ratingTitle" placeholder="Movie Name"/>
                <select id="addRating" name="addRating" required>
                    <option selected="selected">select</option>
                    <option value="1">1</option><option value="2">2</option><option value="3">3</option>
                    <option value="4">4</option><option value="5">5</option></select>
                <input type="submit" name="newRating" value="ADD RATING"/>
                
                <input type="text" name="alterRatingMovie" placeholder="Change Rating (Movie)"/>
                <select name="changeRating">
                    <option selected="selected">select</option>
                    <option value="1">1</option><option value="2">2</option><option value="3">3</option>
                    <option value="4">4</option><option value="5">5</option>
                </select>
                <input type="submit"  name="alterRating" value="CHANGE RATING"/>
            </form>

            <?php 
            if(isset($_POST['alterRating'])) {
                $alterRatingMovie = $_POST['alterRatingMovie'];
                $changeRating = $_POST['changeRating'];
                $query = "UPDATE movie SET id_rating=(SELECT id_rating FROM rating WHERE rating=".$changeRating.") WHERE title='".$alterRatingMovie."'";
                if(!(pg_query($query))) 
                echo 'Retrieval of data from Database Failed';
                else echo("Rating Added");
        }
        ?>
            </div><hr>
        <!-- Rating Buttons -->
        <div id="ratingButtons">
        <form method="post">
            <input type="submit"  name="showRating" value="SHOW ALL" />  
            <input type="text" name="removeRating" placeholder="Remove Rating Movie"/>
            <input type="submit"  name="deleteRating" value="REMOVE RATING" />
        </form></div>
        </fieldset>

        
        <?php 
        // Alter Rating
        if(isset($_POST['alterRating'])) {
            $alterRatingMovie = $_POST['alterRatingMovie'];
            $changeRating = $_POST['changeRating'];
            $query = "UPDATE movie SET id_rating=(SELECT id_rating FROM rating WHERE rating=".$changeRating.") WHERE id_movie=(SELECT id_movie FROM movie WHERE title='".$alterRatingMovie."')";
            if(!($selectRes = pg_query($query))) echo 'Retrieval of data from Database Failed';
            else echo("Movie Rating Changed");
        }
        ?>
        <?php 
        // Delete Rating 
        if(isset($_POST['deleteRating'])) {
            $removeRating = $_POST['removeRating'];
            $query = "UPDATE movie SET id_rating=null WHERE title='".$removeRating."'";
            if(!($selectRes = pg_query($query))) echo 'Retrieval of data from Database Failed';
            else echo("Movie Rating Deleted");
        }
        ?>
    </div>
<br>
        </fieldset>
    </div>
</body>
</html>