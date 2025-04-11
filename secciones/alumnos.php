<?php

//print_r($_POST);



include_once '../configuraciones/bd.php'; // Estoy es para traer la base de datos
$conexionBD=BD::crearInstancia();


//print_r($_POST);

$id=isset($_POST['id'])?$_POST['id']:'';
$nombre=isset($_POST['nombre'])?$_POST['nombre']:''; //donde dice name es la referencia para que venga nombre en vista_alumnos
$apellidos=isset($_POST['apellidos'])?$_POST['apellidos']:'';

$cursos=isset($_POST['cursos'])?$_POST['cursos']:'';
$accion=isset($_POST['accion'])?$_POST['accion']:'';


//print_r($_POST['accion']);

if($accion!=""){
    switch($accion){
        case 'agregar':
            $sql="INSERT INTO alumnos (id, nombre, apellidos) VALUES (NULL,:nombre,:apellidos)";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':nombre',$nombre);
            $consulta->bindParam(':apellidos', $apellidos);
            $consulta->execute();

            $idAlumno=$conexionBD->lastInsertId();

           // echo "El número es: " . $cursos;

            foreach($cursos as $curso){ //este foreach viene no de la base de datos sino del checkbox esto, para insertar los cursos
                $sql="INSERT INTO alumno_cursos (id, idalumno, idcurso) VALUES (NULL,:idalumno, :idcurso)";
                $consulta=$conexionBD->prepare($sql);
                $consulta->bindParam(':idalumno', $idAlumno);
                $consulta->bindParam(':idcurso', $curso);
                $consulta->execute();
            }
        break;

        case 'Seleccionar':
            echo "Pulsaste seleccionar";

            $sql="SELECT * FROM alumnos WHERE id=:id";
            $consulta=$conexionBD->prepare($sql); 
            $consulta->bindParam(':id', $id); 
            $consulta->execute(); 
            $alumno=$consulta->fetch(PDO::FETCH_ASSOC); //aqui se esta mostrando el alumno que se selecciono

            $nombre=$alumno['nombre'];

            $apellidos=$alumno['apellidos'];



            /*$sql="SELECT cursos.id FROM alumno_cursos 
            INNER JOIN cursos ON cursos.id=alumno_cursos.idcurso 
            WHERE alumno_cursos.idalumno=:idalumno";*/


            $sql="SELECT cursos.id FROM alumno_cursos 
            INNER JOIN cursos ON cursos.id=alumno_cursos.idcurso 
            WHERE alumno_cursos.idalumno=:idalumno";
            $consulta=$conexionBD->prepare($sql); 
            $consulta->bindParam(':idalumno', $id);
            $consulta->execute();
            $cursosAlumno=$consulta->fetchAll(PDO::FETCH_ASSOC); //aqui se esta mostrando los cursos que tiene el alumno
            print_r($cursosAlumno); //aqui se muestra los cursos que tiene el alumno
       

            foreach($cursosAlumno as $curso){ 
                echo $curso['id'];
                $arregloCursos[]=$curso['id']; 
            }

        break;
            case "borrar";
            $sql="DELETE FROM alumnos WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);   
            $consulta->bindParam(':id', $id);
            $consulta->execute();
        break;

            case "editar":
                $sql="UPDATE alumnos SET nombre=:nombre, apellidos=:apellidos
                WHERE id=:id";
                $consulta=$conexionBD->prepare($sql);
                $consulta->bindParam(':nombre', $nombre);
                $consulta->bindParam(':apellidos', $apellidos);
                $consulta->bindParam(':id', $id);   
                $consulta->execute();

                if(isset($cursos)){
                    $sql="DELETE FROM alumno_cursos WHERE idalumno=:idalumno";
                    $consulta=$conexionBD->prepare($sql);
                    $consulta->bindParam(':idalumno', $id);
                    $consulta->execute();


                    foreach($cursos as $curso){
                        $sql="INSERT INTO alumno_cursos (id, idalumno, idcurso) 
                        VALUES (NULL, :idalumno, :idcurso)";
                        $consulta=$conexionBD->prepare($sql);
                        $consulta->bindParam(':idalumno', $id);
                        $consulta->bindParam(':idcurso', $curso);
                        $consulta->execute();
                    }
                    $arregloCursos=$cursos; 

                }


              
 }

}


$sql="SELECT * FROM alumnos";   
$listaAlumnos=$conexionBD->query($sql);
$alumnos=$listaAlumnos->fetchAll(); //(#)

//print_r($alumnos); //aqui se muestra los alumnos que se han registrado (--)

//aqui esta viendo todo los alumnos y los cursos que tiene, incluso si no tiene curso
//Ademas la variable $alumnos viene de arriba que esta leyendo todo
foreach($alumnos as $clave => $alumno){

    $sql="SELECT * FROM cursos 
    WHERE id IN (SELECT idcurso FROM alumno_cursos WHERE idalumno=:idalumno)"; //De la columna de la base de datos en este caso de la base de datos alumno_cursos
    //este query trae los cursos que tiene el alumno

    $consulta=$conexionBD->prepare($sql);
    $consulta->bindParam(':idalumno', $alumno['id']);
    $consulta->execute();
    $cursosAlumno=$consulta->fetchAll();
    $alumnos[$clave]['cursos']=$cursosAlumno; //no entiendo esta parte, profundizar en los array multidimensionales
    //aunque no entiendas en este caso aqui se muestra los cursos que tiene el alumno (-)


}

   //print_r($alumnos); aqui se muestra los alumnos con los cursos que tiene a diferencia del de arriba que tiene (--)


  $sql="SELECT * FROM cursos";
  $listaCursos=$conexionBD->query($sql);
  $cursos=$listaCursos->fetchAll(); //(rr)
  //print_r($cursos);


?>


