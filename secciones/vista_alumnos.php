<?php include('../templates/cabecera.php'); ?>   
<?php include('../secciones/alumnos.php'); ?>    

 
<div class="row">
    <div class="col-5">
        <form action="" method="post">

             <div class="card">
                <div class="card-header">
                    Alumnos
                </div>
                <div class="card-body">

                  <div class="mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="text" 
                    class="form-control" name="id" id="id" value="<?php echo $id;?>" aria-describedby="helpId" placeholder="ID"/>
                  </div>
                  

                  <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" 
                    class="form-control" name="nombre" id="nombre" value="<?php echo $nombre;?>" aria-describedby="helpId" placeholder="Escriba el nombre"/>
                  </div>


                  <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text"
                    class="form-control" name="apellidos" id="apellidos" value="<?php echo $apellidos;?>" aria-describedby="helpId" placeholder="Escriba los apellidos"/>
                  </div>
                  

                  <!--Aqui es para seleccionar los cursos  esto viene de la base de datos-->
                  <div class="mb-3">
                    <label for="" class="form-label">Cursos del alumno:</label>
                    <select multiple class="form-control" name="cursos[]" id="listaCursos">


                    <?php foreach($cursos as $curso){  ?> <!--esto de cursos de viene del otro lado el que tiene esto (rr)-->
                           
                          <option
                             <?php
                              if(!empty($arregloCursos)):
                                if(in_array($curso['id'],$arregloCursos)): //esto es para que se seleccione el curso que ya tiene el alumno
                                    echo "selected";
                                  endif;
                                endif
                             ?>

                                value="<?php echo $curso['id'];?>"> 
                                <?php echo $curso['id'];?> - <?php echo $curso['nombre_curso'];?> 
                            </option>

                        <?php } ?>

                    </select>
                  </div>


                    <!--Botones-->
                    <div class="btn-group" role="group" aria-label="Button group name">
                        <button type="submit" name="accion" value="agregar" class="btn btn-success">Agregar</button>
                        <button type="submit" name="accion" value="editar" class="btn btn-warning">Editar</button>
                        <button type="submit" name="accion" value="borrar" class="btn btn-danger">Borrar</button>
                    </div>
                    


                </div>
                <div class="card-footer text-muted">
                    Footer
                </div>
             </div>
             


        </form>
    </div>

    <div class="col-7">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                       
            <tbody>

                <?php foreach($alumnos as $alumno): ?> <!--Esto viene de la base de datos como referencia tiene (#) para que lo ubiques alumnos.php-->
                    <tr>
                        <td><?php echo $alumno['id'];?></td>
                    <td>
                        <?php echo $alumno['nombre'];?> <?php echo $alumno['apellidos'];?>
                           <br/>
                           <?php foreach($alumno["cursos"] as $curso){ ?> 
                                - <a href="certificado.php?idcurso=<?php echo $curso['id'];?>&idalumno=<?php echo $alumno["id"];?>">    <?php echo $curso['nombre_curso'];?> </a> </a><br/>
                            <?php } ?>
                        
                        </td>

                        <td>

                        <form action="" method="post">

                          <input type="hidden" name="id" value="<?php echo $alumno['id'];?>">
                          <input type="submit" value="Seleccionar" name="accion" class="btn btn-info">
                        
                         </form>



                        </td>
                    </tr>
                <?php endforeach; ?>
    
        
                </tbody>

                
            </table>
    
        
    </div>

</div>

<link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>



<script>
    new TomSelect('#listaCursos');
</script>


 <?php include('../templates/pie.php'); ?>