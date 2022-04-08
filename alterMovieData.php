<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Movie</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <?php include 'dbConnect.php'?>
</head>
<body>
<h1>UPDATE MOVIE DATA</h1>
<div name="yourMovies">
    <fieldset style="border: 1px black solid">
    <legend style="border: 1px black solid;margin-left: 1em; padding: 0.2em 0.8em">CHANGE Movie Data</legend>
    <div id="inputForm">
        <form name="inputForm" method="POST"><br>
            <label for="oldTitle">Which movie data do you want to update ?</label>
            <input type="text" name="oldTitle" size="50px" required><hr><br>
            <label for="title">Title</label><input type="text" id="title" name="title" size="50px">
            <label for="genre">Genre:</label>
                <input type="checkbox" name="genre[]" value = "Comedy">
                <label for="genre">Comedy</label>
                <input type="checkbox" name="genre[]" value = "Action">
                <label for="genre">Action</label>       
                <input type="checkbox" name="genre[]" value = "Documentary">
                <label for="genre">Documentary</label>
                <input type="checkbox" name="genre[]" value = "Drama">
                <label for="genre">Drama</label><br>

            <label for="minAge">Minimum Age</label>
            <select id="minAge" name="minAge" required>
                <option selected="selected">select</option>
                <option value="8">8</option><option value="10">10</option><option value="12">12</option>
                <option value="14">14</option><option value="16">16</option><option value="18">18</option>
            </select><br>

            <label for="releaseYear">Release Year</label>
            <input type="number" id="releaseYear" name="releaseYear">

            <label for="country">Country</label>
            <select id="country" name="country" required>
                <option selected="selected">select</option>
                <option value="USA">USA</option><option value="UK">UK</option><option value="Germany">Germany</option>
                <option value="Russia">Russia</option><option value="India">India</option><option value="New Zealand">New Zealand</option>
            </select>

            <label for="language">Language</label>
            <select id="language" name="language" required>
                <option selected="selected">select</option><option value="English">English</option>
                <option value="Russian">Russian</option><option value="German">German</option>>
            </select>

            <label for="rating">Rating</label>
            <select id="rating" name="rating">
                <option selected="selected">select</option>
                <option value="1">1</option><option value="2">2</option><option value="3">3</option>
                <option value="4">4</option><option value="5">5</option>
            </select><br>

            <label for="keywords">Keywords:</label><br>
                <input type="checkbox" name="keyword[]" value = "hero">Hero
                <input type="checkbox" name="keyword[]" value = "school">School
                <input type="checkbox" name="keyword[]" value = "blockbuster">Blockbuster
                <input type="checkbox" name="keyword[]" value = "epic">Epic<br>
                <input type="checkbox" name="keyword[]" value = "vampire">Vampire
                <input type="checkbox" name="keyword[]" value = "true love">True Love
                <input type="checkbox" name="keyword[]" value = "teen movie">Teen Movie
                <input type="checkbox" name="keyword[]" value = "crime">Crime<br><br>

            <input type="submit" name="updateMovie" value="UPDATE">
        </form>
    </fieldset><br>

    <?php
        if(isset($_POST['updateMovie'])){ 
            $oldTitle = $_POST["oldTitle"]; 
            $newTitle = $_POST["title"];
            $minAge = $_POST["minAge"];
            $releaseYear = $_POST["releaseYear"];
            $country = $_POST["country"];
            $language = $_POST["language"];
            $query = "UPDATE movie SET title = ('".$newTitle."'), id_country = (SELECT id_country FROM country WHERE country='".$country."'), id_language = (SELECT id_language FROM language WHERE language='".$language."'),min_age=".$minAge.", release_date=".$releaseYear." WHERE title='".$oldTitle."'";
            if(pg_query($query)){
                $query_genre= "SELECT COUNT(id_genre) FROM movie_genre WHERE id_movie=(SELECT id_movie FROM movie WHERE title='".$newTitle."')";
                pg_query($query_genre);
                if(pg_query($query_genre)>1)
                { 
                    $genreDelete="DELETE FROM movie_genre WHERE id_movie=(SELECT id_movie FROM movie WHERE title='".$newTitle."')";
                    pg_query($genreDelete);
                    $genre = $_POST["genre"];
                    foreach($genre as $g)
                        pg_query("INSERT INTO movie_genre (id_movie,id_genre) VALUES((SELECT id_movie FROM movie WHERE title='".$newTitle."'),(SELECT id_genre FROM genre WHERE genre=('".$g."')))");      
                }
                else
                    pg_query("UPDATE movie_genre SET id_genre = (SELECT id_genre FROM genre WHERE genre = ('".$g."')) WHERE id_movie=(SELECT id_movie FROM movie WHERE title='".$newTitle."') AND id_genre =(SELECT id_genre FROM genre WHERE genre = ('".$g."'))");

                $query_kw= "SELECT COUNT(id_keywords) FROM movie_kw WHERE id_movie=(SELECT id_movie FROM movie WHERE title='".$newTitle."')";
                
                if(pg_query($query_kw)>1){
                    $kwDelete="DELETE FROM movie_kw WHERE id_movie=(SELECT id_movie FROM movie WHERE title='".$newTitle."')";
                    $keyword = $_POST["keyword"];
                    foreach($keyword as $kw){
                        pg_query("INSERT INTO movie_kw (id_movie,id_keywords) VALUES((SELECT id_movie FROM movie WHERE title='".$newTitle."'),(SELECT id_keywords FROM keywords WHERE keywords=('".$kw."')))");
                    }
                                      
                }
                else{
                    $keyword = $_POST["keyword"];
                    pg_query("UPDATE movie_kw SET id_keywords = (SELECT id_keywords FROM keywords WHERE keywords = ('".implode($keyword)."')) WHERE id_movie=(SELECT id_movie FROM movie WHERE title='".$newTitle."') AND id_keywords = (SELECT id_keywords FROM keywords WHERE keywords = ('".implode($keyword)."'))");
                }
                
            
            }
        }
            /*
            $query = "UPDATE movie SET title = ('".$newTitle."'), id_country = (SELECT id_country FROM country WHERE country='".$country."'), id_language = (SELECT id_language FROM language WHERE language='".$language."'),min_age=".$minAge.", release_date=".$releaseYear." WHERE title='".$oldTitle."'";
            if(pg_query($query)){
            $keyword = $_POST["keyword"];
            foreach($keyword as $kw)
                pg_query("UPDATE movie_kw SET id_keywords = (SELECT id_keywords FROM keywords WHERE keywords = ('".$kw."')) WHERE id_movie=(SELECT id_movie FROM movie WHERE title='".$oldTitle."') AND id_keywords = (SELECT id_keywords FROM keywords WHERE keywords = ('".$kw."'))");
            
            $genre = $_POST["genre"];
            foreach($genre as $g)
                pg_query("UPDATE movie_genre SET id_genre = (SELECT id_genre FROM genre WHERE genre = ('".$g."')) WHERE id_movie=(SELECT id_movie FROM movie WHERE title='".$oldTitle."') AND id_genre =(SELECT id_genre FROM genre WHERE genre = ('".$g."'))");
            
            echo ("<i>Movie Updated</i>");
        }
        else echo("Retrieval of Data from database failed");
    }*/
    ?>
           
    
</body>
</html>