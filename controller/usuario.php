<?php
    require_once("../config/conexion.php");
    require_once("../models/Usuario.php");

    $usuario = new Usuario();

    switch($_GET["opc"]){
        case "listar_cursos":
             $datos=$usuario->cursos_x_usuarios($_POST["usu_id"]);

             $data = Array();
             foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row ["nombre"];
                $sub_array[] = $row ["fecha_inicial"];
                $sub_array[] = $row ["fecha_final"];
                $sub_array[] = $row ["nombrep"].$row["apellidop"];
                $sub_array[] = '<button type="button" class="btn btn-outline-primary">Certificado</button>';
                $data[] = $sub_array;
               
             }
             $results = array(
                "sECHO" => 1,
                "iTotalRecords" =>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData" =>$data);
            echo json_encode($results);
             break;
    }
?>