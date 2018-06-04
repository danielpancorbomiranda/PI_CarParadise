<?php

session_start(); // para aceder a las variabels de ssesion asignadas
session_destroy(); // destruye todas la variable sde sesion
redirect ('', 'location'); // redirige al login de nuevo

?>
