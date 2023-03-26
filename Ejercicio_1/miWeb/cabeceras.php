<?php
print "<h1>Script Cabeceras - Tarea de Ismael</h1><br/>";

foreach (getallheaders() as $nombre => $valor) {
   print "$nombre: $valor<br/>";
}
?>
