# Bitcoin-tracker
Гугл таблица, в которую записывается курс биткоина - https://docs.google.com/spreadsheets/d/1O1Ws-LG68NrJ6NNxdIsvCvnFEi5WihZPL2gT9fmnogg/edit#gid=0
Запуск sheet.php собирает данные о биткоине с https://www.cryptocompare.com/ и используя Google Sheet API добавляет в гугл таблицу.
Автоматическое повторение скрипта можно реализовать двумя способами: через Heroku с Sheduler и через планировщик заданий. Я сделал через планировщик.
1) Создал bat файл (script.bat) и туда записал ***D: && php "User Files"\PHPProjects\HelloWorld\sheet.php***
2) Настроил триггер с интервалом запуска на каждый час
![image](https://user-images.githubusercontent.com/74830291/160255853-e09bda95-2b93-41fb-a1ea-95521905f124.png)
