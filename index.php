<!DOCTYPE html>
<html lang="cs" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Test</title>
  </head>
  <body>
  <?php
  $indicesServer = array(
      'HTTP_ACCEPT',
      'HTTP_ACCEPT_CHARSET',
      'HTTP_ACCEPT_ENCODING',
      'HTTP_ACCEPT_LANGUAGE',
      'HTTP_CONNECTION',
      'HTTP_HOST',
      'HTTP_REFERER',
      'HTTP_USER_AGENT',
      'HTTPS',
      'REMOTE_ADDR',
      'REMOTE_HOST',
      'REMOTE_PORT',
      'REMOTE_USER',
      ) ;

  echo '<table cellpadding="10">' ;
  foreach ($indicesServer as $arg) {
      if (isset($_SERVER[$arg])) {
          echo '<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ;
      }
      else {
          echo '<tr><td>'.$arg.'</td><td>-</td></tr>' ;
      }
  }
  echo '</table>' ;
  ?>
  <h1>Úkoly:</h1>
    <button type="button" onclick="getResult('ukol1')" name="ukol1">Ukol 1</button>
    <button type="button" onclick="getResult('ukol2')" name="ukol2">Ukol 2</button>
    <button type="button" onclick="getResult('ukol3')" name="ukol3">Ukol 3</button>
    <button type="button" onclick="getResult('ukol4')" name="ukol4">Ukol 4</button>

    <div class="" id="response"></div>
  </body>

  <script type="text/javascript">
  function getResult(script) {  //Script je promena, nazev scriptu bez pripony
    var url = script+".php";  //vytvořím si url (nazev scriptu na který chceme udělat dotaz)

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { //pokud je status 200 tzn OK tak...

      document.getElementById("response").innerHTML = this.responseText; //vypíšu data z odpovědi dotazu do divu s id response
    }
    };
    xhttp.open("GET", url);
    xhttp.send();
    }

  </script>
</html>
