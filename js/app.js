$(function () {
    var pozycje = $('#positions');
    var btn = $('#btn');
    var updateSubmit = $('#submit')
    var author = $('#author');
    var desc = $('#desc');
    var title = $('#title');

    var j = 1;


//    alert('test');
    $.ajax({
        type: "GET",
        url: "api/books.php",
        dataType: "json",
        success: function (ksiazki) {
            $.each(ksiazki, function (i, ksiazka) {
                pozycje.append('<li data-id=' + ksiazka.id + '>' + ksiazka.name + ' - <a href="" data-id=' + ksiazka.id + ' class="delete">Usuń książkę</a></li><div class="lista" data-id=' + ksiazka.id + '></div>');

            });
        },
        error: function (z) {

            alert('Wystąpił błąd!');
        }
    });

    pozycje.on('click', '.delete', function (z) {
        z.preventDefault();

        var divId = $(this).data('id');

        if (confirm('Are you sure?')) {
            $.ajax({
                type: 'DELETE',
                url: "api/books.php?id=" + divId,
                dataType: 'json',
                success:
                        function () {
                            location.reload();
                        }
            });
        }
    });
//    alert('test');
    var liId = $('.li').data('id');

    var lista = pozycje.find('li');

    pozycje.on('click', 'li', function (z) {

        var divId = $(this).data('id');
        var _this = $(this);
        $.ajax({
            type: 'GET',
            url: "api/books.php?id=" + divId,
            dataType: 'json',
            success: function (ksiazka) {
                _this.next().show().text(ksiazka.author + ', ' + ksiazka.description + ' - ').append('<a href="#" class="close">Zamknij</a>'
                        + '<form>'
                        + '<label><strong><h3>Edycja książki:</h3></strong></label><br>'
                        + 'Tytuł:<br>'
                        + '<input type="text" id="updateTitle" placeholder="Wpisz nowy tytuł"/><br>'
                        + 'Autor:<br>'
                        + '<input type="text" id="updateAuthor" placeholder="Podaj nowego autora"/><br>'
                        + 'Opis:<br>'
                        + '<textarea id="updateDesc" maxlength="255" placeholder="Podaj krótki opis"></textarea><br>'
                        + '<button id="submit" data-id="' + ksiazka.id + '" name="dodaj" value="Zatwierdź">Zatwierdź</button>'
                        + '</form><br>');
                $('.close').click(function (e) {
                    e.preventDefault();
                    $(this).parent().hide();
                });
            }
        });
    });

    pozycje.on('click', '#submit', function (z) {
        z.preventDefault();

        var divId = $(this).data('id');

        var title = $('#updateTitle').val();
        var author = $('#updateAuthor').val();
        var desc = $('#updateDesc').val();


        $.ajax({
            type: 'PUT',
            url: "api/books.php",
            dataType: 'json',
            data: {id: divId, title: title, author: author, desc: desc},
            success: function () {
                alert('Update udany!');
                location.reload();
            },
            error: function () {
                alert('Update nieudany');
            }
        });
    });


    btn.on('click', function (z) {
        z.preventDefault();

        var nowaKsiazka = {
            name: title.val(),
            author: author.val(),
            desc: desc.val()
        };


        $.ajax({
            type: 'POST',
            url: "api/books.php",
            data: nowaKsiazka,
            dataType: "json",
            success: function (ksiazki) {
                $.each(ksiazki, function (i, ksiazka) {
                    pozycje.append('<li>Tytuł: ' + title + ', Autor: ' + author + ', Opis: ' + desc + '</li>');
                    location.reload();
                });
            }
        });
    });
});

;
