<?php
include 'conecta.php';

function getCalendar($connection, $mes, $ano) {
   $Calendario = $mostraErros = ''; //variável para conter a saída do calendário e no meio do caminho mostra os erros, se houver
   $nrDiaSemana = array(6,0,1,2,3,4,5); //numerar dias da semana, aonde 0 é segunda-feira e 6 é domingo
   $nomesMes = array('Janeiro de','Fevereiro de','Março de','Abril de','Maio de','Junho de','Julho de','Agosto de','Setembro de','Outubro de','Novembro de','Dezembro de');
   $nomesDia = array('SEGUNDA','TERÇA','QUARTA','QUINTA','SEXTA','SÁBADO','DOMINGO');
   $arrayEventos = array(); //array de eventos
   $titulo = '';
   $objetivo = '';
   $local = '';
   $data = '';
   $horario = '';
   $usuario = '';
   $dt_info = '';
   $status = '';

   $arrayModal = array();

   //calcular o mês/ano seguinte/anterior com base nos parâmetros fornecidos
   $mesesAnterior = $mes - 1;
   $anoAnterior = $proxAno = $ano;
   $proxMes = $mes + 1;
   if ($mes - 1 == 0) {
      $mesesAnterior = 12;
      $anoAnterior = $ano - 1;
   }
   if ($mes + 1 == 13) {
      $proxMes = 1;
      $proxAno = $ano + 1;
   }

   $t = mktime(12, 0, 0, $mes, 1, $ano); // Carimbo de data e hora do primeiro dia do mês no ano determinado
   
   //vamos construir esse calendário
   $Calendario .= '<table id="calendar"><tbody>';

   //construir cabeçalho do calendário (mês + ano e botões de navegação)
   $Calendario .= '<tr class="calendar-nav">';
   $Calendario .= '<td class="prev" data-prev-month="' . $mesesAnterior . '" data-prev-year="' . $anoAnterior . '" colspan="1">&lt;</td>';
   $Calendario .= '<td colspan="5" style="font-size: 24px">' . $nomesMes[$mes - 1] . ' ' . $ano . '</td>';
   $Calendario .= '<td class="next" data-next-month="' . $proxMes . '" data-next-year="' . $proxAno . '" colspan="1">&gt;</td></tr>';

   //construir nomes de dias
   $Calendario .= '<tr class="calendar-day-names-header">';
   for ($i = 0;$i < 7;$i++) {
      $Calendario .= '<td>' . $nomesDia[$i] . '</td>';
   }
   $Calendario .= '</tr>';

   //construir dias do mês (células)
   for ($i = 0;$i < 6;$i++) { //calendário em 6 linhas
      $Calendario .= '<tr class="calendar-days">';
      for ($j = 0;$j < 7;$j++) //calendário em 7 colunas
      {
         $w = $nrDiaSemana[(int)date('w', $t) ]; //matriz variável $nrDiaSemana para obter o dia correto da semana através do número
         $mes2 = (int)date('n', $t); //obtém a representação numérica do mês a partir do timestamp, sem zeros à esquerda
         if (($w == $j) && ($mes2 == $mes)) { //se o número do dia estiver dentro do mês determinado
            $d = date('d', $t); //vai obter o dia do mês (01 a 31)
            $Calendario .= '<td';

            $tdClasses = array(); //array de classes usadas para conter nada ou "hoje" ou "evento" ou "hoje+evento"
            if ($d == date("d", time()) && $mes == date("m", time()) && $ano == date("Y", time())) { //se a data no calendário corresponder à data atual, adicione a classe ao array $tdClasses
               array_push($tdClasses, "today");
            }

            //se houver conexão com o banco de dados, construa calendário, caso contrário, exibirá erro
            if ($connection != null) {
               $eventSql = "SELECT * FROM eventos WHERE YEAR(data) = ? AND MONTH(data) = ? AND DAY(data) = ?"; //Cons. SQL para selecionar evento de determinado dia, mês e ano
               if ($stmt = mysqli_prepare($connection, $eventSql)) {
                  mysqli_stmt_bind_param($stmt, "iii", $ano, $mes, $d);
                  if (mysqli_stmt_execute($stmt)) {
                     mysqli_stmt_store_result($stmt);
                     if (mysqli_stmt_num_rows($stmt) == 1) { //se o registro do evento for encontrado
                        $arrayDetalhes = array();
                        array_push($tdClasses, "eventday"); //adicionar classe ao array $tdClasses
                        mysqli_stmt_bind_result($stmt, $idEvento, $titulo, $objetivo, $local, $data, $horario, $usuario, $dt_info, $status);

                        mysqli_stmt_fetch($stmt);

                        array_push($arrayDetalhes, $idEvento, $titulo, $objetivo, $local, $data, $horario, $usuario, $dt_info, $status); //povoar a variável $arrayDetalhes
                        array_push($arrayEventos, $arrayDetalhes); //insere a matriz atual de detalhes do evento em outra matriz de eventos (matriz bidimensional)
                        
                     }
                  }
                  else {
                     $mostraErros = "<div class=\"alert alert-danger role=\"alert\">Não é possível recuperar detalhes do evento do banco de dados.</div>";
                  }
                  mysqli_stmt_free_result($stmt);
                  mysqli_stmt_close($stmt);
               }
               else {
                  $mostraErros = "<div class=\"alert alert-danger role=\"alert\">Erro na consulta SQL, entre em contato com o administrador!</div>";
               }
            }
            else {
               $mostraErros = "<div class=\"alert alert-danger role=\"alert\">Não é possível recuperar detalhes do evento do banco de dados.</div>";
            }

            //continue construindo células de calendário com nomes de classes
            if (count($tdClasses) > 0) {
               $Calendario .= ' class="';
               for ($k = 0;$k < count($tdClasses);$k++) {
                  $Calendario .= $tdClasses[$k] . ' ';
               }
               $Calendario = rtrim($Calendario);
               $Calendario .= '"';
            }

            //insira informações modais se o dia tiver um evento
            if (in_array("eventday", $tdClasses)) {
               $Calendario .= ' data-toggle="modal" data-target="#eventModal-' . $idEvento . '">' . date('j', $t);
            }
            else {
               $Calendario .= '>' . date('j', $t);
            }
            
            $Calendario .= '</td>'; //fim da célula
            $t += 86400; //passar para o dia seguinte
         }
         else {
            $Calendario .= '<td class="emptyday">&nbsp;</td>'; //construir uma célula vazia
            
         }
      }
      $Calendario .= '</tr>';
   }
   $Calendario .= '</tbody></table>'; //final do calendário
   
   //Janela modal para exibir detalhes do evento quando o usuário clica em uma célula do calendário com um evento anexado
   foreach ($arrayEventos as $ea) {
      $stringReune = $ea[3] . ', ' . $ea[4] . ', ' . $ea[6] . ' ' . $ea[5];

      $Modal = '';
      $Modal .= '<div class="modal fade" id="eventModal-' . $ea[0] . '" tabindex="-1" role="dialog" aria-labelledby="modelLabel" aria-hidden="true">';
      $Modal .= '<div class="modal-dialog modal-dialog-centered modal-lg" role="document">';
      $Modal .= '<div class="modal-content">';
      $Modal .= '<div class="modal-header">';
      $Modal .= '<h5 class="modal-title">Cabeçalho do Modal</h5>';
      $Modal .= '<button type="button" class="close" data-dismiss="modal" aria-label="Fecha">&times;</button>';
      $Modal .= '</div>';

      $Modal .= '<div class="modal-body">';
      $Modal .= '<div class="row">';
      $Modal .= '<div class="col-lg-6">';
      $Modal .= '<p style="height: 250px; border: 2px solid #CEDADA">Insira uma imagem aqui, se necessário...</p>';
      $Modal .= '<p style="height: 250px; border: 2px solid #CEDADA">Insira o Google Map aqui, se necessário...</p>';
      $Modal .= '</div>';
      $Modal .= '<div class="col-lg-6">';
      $Modal .= '<h5>Título do Evento</h5>';
      $Modal .= '<p>' . $ea[1] . '</p><hr>';
      $Modal .= '<h5>Local, Data, Info e Horário</h5>';
      $Modal .= '<p>' . $stringReune . '</p><hr>';
      $Modal .= '<h5>Início e Término do Evento</h5>';
      $Modal .= '<p>' . date('h:i A', strtotime($ea[7])) . ' - ' . date('h:i A', strtotime($ea[8])) . '</p>';
      $Modal .= '</div>';
      $Modal .= '</div>';
      $Modal .= '</div>';

      $Modal .= '</div>';
      $Modal .= '</div>';
      $Modal .= '</div>';

      array_push($arrayModal, $Modal); //adicionar conteúdo modal a um array
   }

   //adicionar todos os modais à saída do calendário
   foreach ($arrayModal as $mm) {
      $Calendario .= $mm;
   }
   //se houver erro, mostra msg logo abaixo do calendário
   $Calendario .= $mostraErros;
   return $Calendario;
}
