<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>PHPBooks</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .loader {
                border: 16px solid #f3f3f3;
                border-radius: 50%;
                border-top: 16px solid #3498db;
                width: 120px;
                height: 120px;
                -webkit-animation: spin 2s linear infinite; /* Safari */
                animation: spin 2s linear infinite;
            }

            /* Safari */
            @-webkit-keyframes spin {
                0% { -webkit-transform: rotate(0deg); }
                100% { -webkit-transform: rotate(360deg); }
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>
    </head>
    <body>

    <div id="books__list"></div>

    <div class="loader"></div>
    <input id="currentPage" type="hidden" value="">
    <button id="nextButton" onclick="buttonClicked()">Загрузить больше</button>

    <script>
        performQuery("/book");

        function buttonClicked() {
            let currentPage = $("#currentPage").val();
            let path = "/book?page=" + (++currentPage);
            performQuery(path);
        }

        function parseResult(result) {
            if (result['hasNext'] === true) {
                $('#nextButton').show();
            } else {
                $('#nextButton').hide();
            }
            $('#currentPage').val(result['currentPage']);
            $('.loader').hide();
            let list = document.getElementById("books__list");
            result['list'].forEach(
                function processItem(book) {
                    let panelDiv = document.createElement("div");
                    panelDiv.style.marginBottom = "50px";
                    panelDiv.classList.add("book-item");
                    let img = document.createElement("img");
                    img.setAttribute("src", book['img']);
                    let title = document.createElement("div");
                    title.innerText = "Название " + book['title'];
                    let author = document.createElement("div");
                    author.innerText = book['author'];
                    let price = document.createElement("div");
                    price.innerText = "Цена " + book['price'];
                    let year = document.createElement("div");
                    year.innerText = "Год выпуска " + book['year'];

                    panelDiv.appendChild(img);
                    panelDiv.appendChild(title);
                    panelDiv.appendChild(author);
                    panelDiv.appendChild(price);
                    panelDiv.appendChild(year);
                    list.appendChild(panelDiv);
                }
            );
        }

        function performQuery(url) {
            $('#nextButton').hide();
            $('.loader').show();
            $.get({url: url, success: function(result){
                    parseResult(result)
                }});
        }
    </script>
    </body>
</html>

