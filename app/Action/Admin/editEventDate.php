<?php
use App\Model\EventoInfo;
use App\BLL\EventoBLL;

if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])){
	
	
	$id = $_POST['Event'][0];
	$start = $_POST['Event'][1];
	$end = $_POST['Event'][2];

	$regraCalendar = new EventoBLL();
	$event = new EventoInfo();
    $event->setId($id);
	$event->setStart($start);
	$event->setEnd($end);

	$alteracao = $regraCalendar->alterarData($event);

	if ($alteracao == false) {
	 	die ('Erro na execução');
	}
	else{
		die ('OK');
	}

}
//header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>
