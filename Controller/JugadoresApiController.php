<?php

require_once "./Model/JugadoresModel.php";
require_once "./View/JugadoresApiView.php";

class JugadoresApiController {

    private $model;
    private $view;

    function __construct(){
        $this->model = new JugadoresModel();
        $this->view = new JugadoresApiView();
    }

    function obtenerJugadores(){
        if(isset($_GET["club"])){
            if(isset($_GET["ord"])){
                $jugadores = $this->filtro($_GET["ord"]);
            }
            else{
                $jugadores = $this->filtro();
            }
            if ($jugadores == null){
                return $this->view->response("El club que solicito no exite", 400);
            }
        } 
        else if(isset($_GET["ord"])){
            $ord = $_GET["ord"];
            if (($ord == "asc") || ($ord == "desc")){
                $jugadores = $this->model->getJugadores($ord);                
            }
            else{
                return $this->view->response("Hubo un fallo en su solicitud", 400);   
            }
        }
        else{
            $jugadores = $this->model->getJugadores();
        }
        if($jugadores){
            return $this->view->response($jugadores, 200);
        }
        else {
            return $this->view->response("La lista de jugadores esta vacia", 404);
        }       
    }

    function filtro($ord = null){
        $club = $_GET["club"];
        if($ord){
            $jugadores = $this->model->getJugadoresClub($club, $ord);
        }
        else {
            $jugadores = $this->model->getJugadoresClub($club);
        }
        return $this->view->response($jugadores, 200);

    }

    function obtenerJugador($params = []){
        $idjugador = $params[":ID"];
        $jugador = $this->model->getJugador($idjugador);
        if($jugador){
            return $this->view->response($jugador, 200);
        }
        else{
            return $this->view->response("El jugador con el id=$idjugador no existe", 404);
        }
    }

    function borrarJugador($params = []){
        $idjugador = $params[":ID"];
        $jugador = $this->model->getJugador($idjugador);
        if($jugador){
            $this->model->deleteJugadorDB($idjugador);
            if($jugador){
                return $this->view->response("El jugador con el id=$idjugador no se pudo borrar", 500);
            }
            return $this->view->response("El jugador con el id=$idjugador fue borrado", 200);
        }
        else{
            return $this->view->response("El jugador con el id=$idjugador no existe", 404);
        }       
    }

    function crearJugador($params = null){
        $body = $this->getBody();
        if ($body->nombre && $body->numero && $body->posicion && $body->id_club){
            $idjugador = $this->model->insertJugador($body->nombre, $body->numero, $body->posicion, $body->id_club);
            if ($idjugador){
                $this->view->response("El jugador se agrego con exito", 201);
            }
            else{
                return $this->view->response("No se pudo agregar al jugador", 500);
            }
        }
        else{
            return $this->view->response("Hubo un fallo en su solicitud", 400);
        }
        
    }

    private function getBody(){
        $bodyString = file_get_contents("php://input");
        return json_decode($bodyString);
    }

    function editarJugador($params = null){
        $idjugador = $params[":ID"];
        $body = $this->getBody();
        $jugador = $this->model->getJugador($idjugador);
        if ($body->nombre && $body->numero && $body->posicion && $body->id_club){
            if($jugador){
                $this->model->editJugadorDB($body->nombre, $body->numero, $body->posicion, $body->id_club, $idjugador);
                return $this->view->response("El jugador fue editado", 200);
            }
            else{
                return $this->view->response("El jugador con el id=$idjugador no existe", 404);
            }
        }
        else{
            return $this->view->response("Hubo un fallo en su solicitud", 400);
        }
    }

}