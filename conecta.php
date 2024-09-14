<?php
mysqli_report(MYSQLI_REPORT_STRICT); // Para forçar o PHP a lançar exceção se houver erros

// Conexão com o banco de dados MySQL, define $con como nulo (ou die()) se houver problema na conexão
try {
   $con = mysqli_connect("SEU-HOST-AQUI", "USUARIO", "SENHA", "BANCO-DE-DADOS"); //credenciais de acesso
}
catch (Exception $e) {
   $con = null; //isso pode ser substituído por morrer()
}
?>