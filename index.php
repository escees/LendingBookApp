<?php ?>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
        <script src="js/app.js"></script>
    </head>
    <body>
        <h1 align="center">Interaktywna strona wypożyczalni książek</h1>
        
        <form>
            Nazwa:<br>
            <input type="text"id="title" placeholder="Wpisz tytuł" name="title"/><br>
            Autor:<br>
            <input type="text" id="author" placeholder="Podaj autora" name="author"/><br>
            Opis:<br>
            <textarea id="desc" maxlength="255" placeholder="Podaj krótki opis" name="desc"></textarea><br>
            <input type="submit" id="btn" name="dodaj" value="Dodaj książkę"/>
        </form>
        <h3>Pozycje jakie posiadamy:</h3>
        <ul id="positions"></ul>
        
    </body>

</html>
<?php
