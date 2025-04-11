<?php include('../templates/cabecera.php'); ?>   
<?php include('../secciones/cursos.php'); ?>    


<div class="row">
      <div class="col-12">
      <br/>
      <div class="row">
      <div class="col-md-5">
    
      <form action="" method="post">
      <div class="card">
            <div class="card-header">Cursos</div>
            <div class="card-body">
            <div class="mb-3 d-none"> <!--d-none es para que no se vea el id, pero si se envia-->
                 <label for="" class="form-label">ID</label>
                 <input type="text" 
                        class="form-control" 
                        name="id"
                        value="<?php echo $id; ?>"
                        id="id"
                        aria-describedby="helpId" placeholder="ID"/>
         </div>
         <div class="mb-3">                                                                                                      
             <label for="nombre_curso" class="form-label">Nombre</label>
             <input type="text"
                    class="form-control" 
                    value="<?php echo $nombre_curso; ?>"
                    name="nombre_curso"  
                    id="nombre_curso" aria-describedby="helpId"  placeholder="Nombre del curso"/>
         </div>


        <div class="btn-group" role="group" aria-label="Button group name">
             <button type="submit"  name="accion" value="agregar" class="btn btn-success">Agregar</button>
             <button  type="submit" name="accion" value="editar" class="btn btn-warning">Editar</button>
             <button  type="submit" name="accion" value="borrar" class="btn btn-danger"> Borrar </button>
        </div>

    </div>

  </div>


 </form>



</div>
 

<div class="col-md-7">

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>  <!--ID, Nombre, Acciones son columnas y las filas son la que esta abajo-->
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
<!--En el comentario anterior dije que son columnas y abajo son las filas donde dice id, nombre?curso y otro que es seleccionar, que trae la informacion de la base de datos-->
        <?php foreach($listacursos as $curso){ ?>
            <tr>
                <td><?php echo $curso['id'];?></td>
                <td><?php echo $curso['nombre_curso'];?></td>
                <td>
                  <form action="" method="post">
                  <input type="hidden" name="id" id="id" value="<?php echo $curso['id'];?>"/>
                  <input type="submit" value="Seleccionar" name="accion" class="btn btn-info"> 
                  </form>
                  <!--Esta parte se refiere que cuando le demos click se envie esta informacion, inclusive en type hay hidden que se puede quitar con text-->
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>



</div>
</div>
</div>

 <?php include('../templates/pie.php'); ?>