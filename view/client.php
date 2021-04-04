<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</head>
<body>
<div class="container">
    <form action="/addBankRequest" method="post">
        <div class="row">
            <div class="col">
                <input onclick="showClientForm('natural')" name="client[type]" value="natural" type="radio"> Физическое
                лицо
                <br>
                <input onclick="showClientForm('legal')" name="client[type]" value="legal" type="radio"> Юридическое
                лицо

                <div id="natural" style="display: none">

                    <input name="client[name]" type="text" placeholder="Иванов Иван Иванович"> ФИО
                    <br>
                    <input name="client[birthday]" type="date" value="1980-01-01">Дата рождения
                    <br>
                    <input name="client[inn]" type="number" placeholder="000000000000">ИНН
                    <br>
                    Паспортные данные <br>
                    <input name="client[passSeries]" type="number" placeholder="0000">Серия
                    <br>
                    <input name="client[passNumber]" type="number" placeholder="000000">Номер
                    <br>
                    <input name="client[passDate]" type="date" value="1980-01-01">Дата выдачи
                    <br>
                </div>

                <div id="legal" style="display: none">
                    Данные о компании
                    <br>

                    <input name="client[name]" type="text" placeholder='OOO"Ижевск"'> Название компании
                    <br>
                    <input name="client[INN]" type="number" placeholder="000000000000">ИНН компании
                    <br>
                    <input name="client[address]" type="text" placeholder="г.Ижевск ул.Ленина д.1">Адрес
                    компании
                    <br>
                    <input name="client[ogrn]" type="number" placeholder="00000000000">ОГРН
                    <br>
                    <input name="client[kpp]" type="number" placeholder="000000000000">КПП
                    <br>
                    <input name="client[directorName]" type="text" placeholder="Иванов Иван Иванович">Имя
                    руководителя
                    <br>
                    <input name="client[directorInn]" type="number" placeholder="000000000000">ИНН руководителя
                    <br>
                </div>
            </div>

            <div class="col">
                Выбирете продукт: <br>
                <input onclick="showProductForm('credit')" name="product[type]" value="credit" type="radio"> Оформить
                кредит
                <br>
                <input onclick="showProductForm('deposit')" name="product[type]" value="deposit" type="radio"> Оформить
                вклад
                <br>
                <div id="credit" style="display: none">
                    <p>кредит</p>
                    <input name="product[dataOpen]" value="2021-01-01" type="date"> Дата открытия
                    <br>
                    <input name="product[dataClose]" value="2021-01-01" type="date"> Дата закрытия
                    <br>
                    <input name="product[month]" value="" type="number"> Срок (в месяцах)
                    <br>
                    <input name="product[summ]" value="" type="number"> Сумма
                    <br>
                </div>
                <div id="deposit" style="display: none">
                    <p>вклад</p>
                    <input name="product[dataOpen]" value="2021-01-01" type="date"> Дата открытия
                    <br>
                    <input name="product[dataClose]" value="2021-01-01" type="date"> Дата закрытия
                    <br>
                    <input name="product[month]" value="" type="number"> Срок (в месяцах)
                    <br>
                    <input name="product[rate]" value="" type="number"> Ставка
                    <br>
                    Периодичность капитализации
                    <br>
                    <input name="product[capitalization]" value="1" type="radio">Ежемесячно
                    <input name="product[capitalization]" value="2" type="radio">В конце периода
                </div>
            </div>

            <button type="submit">Отправить</button>
        </div>
    </form>

</div>
</body>
</html>