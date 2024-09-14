<!DOCTYPE html>
<html lang="pt">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Calendário de Eventos | Teste</title>
      <meta name="description" content="Calendário PHP">
      <meta name="keywords" content="calendar, event, PHP, HMTL, CSS, JS, ajax">
      <meta name="author" content="Doni7Brandao">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <style>
         h1 {
            text-align: center;
         }
         #calendar {
            width: 100%;
            margin: 10px auto;
            text-align: center;
         }

         #calendar .prev, #calendar .next {
            cursor: pointer;
            color: #006F93;
            font-size: 3em;
         }

         #calendar .prev:hover, #calendar .next:hover {
            color: #B6C8A9;
         }

         #calendar .calendar-nav {
            color: #006F93;
            font-weight: bold;
         }

         #calendar .calendar-day-names-header {
            background-color: #006F93;
            border: 1px solid #f0f0f0;
            color: #FFF;
         }

         #calendar .calendar-days td {
            width: 50px;
            height: 50px;
            border: 1px solid #006F93; 
         }

         #calendar .eventday {
            position: relative;
            cursor: pointer;
         }

         #calendar .eventday:after {
            content: "";
            position: absolute;
            bottom: 0;
            right: 0;
            display: block;
            border-left: 20px solid transparent;
            border-top: 20px solid transparent;
            border-bottom: 20px solid #26B99A;
         }

         #calendar .eventday:hover {
            background-color: #26B99A;
         }

         #calendar .today {
            box-shadow: 0 0 0 2px #FFF inset;
            background: #006F93;
            color: #FFF;
         }

         #calendar .emptyday {
            background-color: #CEDADA;
         }
      </style>
   </head>
   <body>
      <header>
         <h1>Calendário de Eventos</h1>
      </header>
      <main>
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <div id="calendar-output">
                     <?php
                        include "calendario.php";
                        echo getCalendar($con,date("m",time()),date("Y",time()));
                     ?>
                  </div>
               </div>
            </div>
         </div>
      </main>
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
      <script src="calendario.js"></script>
   </body>
</html>
