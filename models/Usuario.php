<?php
    class Usuario extends Conectar{
        public function login(){
            $conectar = parent::Conexion();
            parent::set_names();
            if(isset($_POST["enviar"])){
                $correo = $_POST ["correo"];
                $password = $_POST ["passwd"];
                if(empty($correo) and empty($password)){
                    header("Location:".Conectar::ruta()."index.php?m=2");
                    exit();
                }else{
                    $sql = "SELECT * FROM estudiantes WHERE usuario_correo=? and clave=? and estado=1";
                    $stmt = $conectar->prepare($sql);
                    $stmt-> bindParam(1,$correo);
                    $stmt-> bindParam(2,$password);
                    $stmt ->execute();
                    $resultado = $stmt->fetch();
                    if(is_array($resultado) and count($resultado)>0){
                        $_SESSION["id_usuario"]=$resultado["id_usuario"];
                        $_SESSION["nombre"]=$resultado["nombre"];
                        $_SESSION["apellido"]=$resultado["apellido"];
                        $_SESSION["usuario_correo"]=$resultado["usuario_correo"];
                        header("Location:".Conectar::ruta()."views/inicio.php");
                        exit();
                    }else{
                        header("Location:".Conectar::ruta()."index.php?m=1");
                        exit();
                    }
                }
            }
        }
        public function cursos_x_usuarios($usu_id){
            $conectar=parent::Conexion();
            parent::set_names();
            $sql="SELECT
            curso_usuario.curusu_id,
            cursos.id_curso,
            cursos.nombre,
            cursos.descripcion,
            cursos.fecha_inicial,
            cursos.fecha_final,
            estudiantes.id_usuario,
            estudiantes.nombre,
            estudiantes.apellidos,
            profesores.id_profesor,
            profesores.nombrep,
            profesores.apellidop
            FROM curso_usuario INNER JOIN
            cursos on curso_usuario.curusu_id = cursos.id_curso INNER JOIN
            estudiantes on curso_usuario.id_usuario = estudiantes.id_usuario INNER JOIN
            profesores on curso_usuario.profesor = profesores.id_profesor 
            WHERE 
            curso_usuario.id_usuario = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado = $sql -> fetchAll();
        
        }

    }
?>