<?php 
//INSERT INTO `cursos` (`id`, `nombre_curso`) VALUES (NULL, 'Sitio web con PHP');
//INSERT INTO `alumnos` (`id`, `nombre`, `apellidos`) VALUES (NULL, 'Yeison', 'Carmona');


include_once '../configuraciones/bd.php'; // Estoy es para traer la base de datos
$conexionBD=BD::crearInstancia();


/**Esta informacion es para recibir los datos del formulario de cursos, basicamente creamos una variable id y el metodo post para recibir y el otro id
 se observa que se esta recibiendo la informacion, entonces la asignamos a la variable id
 de lo contario se asigna un valor vacio.
 */
$id=isset($_POST['id'])?$_POST['id']:'';
$nombre_curso=isset($_POST['nombre_curso'])?$_POST['nombre_curso']:'';
$accion=isset($_POST['accion'])?$_POST['accion']:'';

if($accion!=''){
  
    switch($accion){

        case 'agregar':
            $sql = "INSERT INTO cursos (id, nombre_curso) VALUES (NULL, :nombre_curso)";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':nombre_curso',$nombre_curso);
            $consulta->execute();

            echo $sql;
            break;
        case 'editar':
            $sql = "UPDATE cursos SET nombre_curso=:nombre_curso WHERE id=:id"; //en este caso hay que suministrar dos valores
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->bindParam(':nombre_curso',$nombre_curso);
            $consulta->execute();
            echo $sql;
            break;

        case 'borrar':
            $sql = "DELETE FROM cursos WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            echo $sql;
            break;

        case 'Seleccionar':
            $sql = "SELECT * FROM cursos WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            $curso=$consulta->fetch(PDO::FETCH_ASSOC);
            $nombre_curso=$curso['nombre_curso'];
            //echo $nombre_curso;
        break;
    }
    
}


$consulta=$conexionBD->prepare("SELECT * FROM cursos"); // Esto es para consultar todo
$consulta->execute(); // ejecuta
$listacursos=$consulta->fetchAll(); //el fetchall lo almacena en un array

//print_r($listacursos);
?>