<?php include("cabecera.php"); ?>
<?php include("conexion.php"); ?>
<?php

    if($_POST){
        //print_r($_POST);

        $nombre=$_POST['nombre'];
        $descripcion= $_POST['descripcion'];
        $fecha= new DateTime();
        $imagen=$fecha->getTimestamp()."_".$_FILES['archivo']['name'];
        $imagen_temporal=$_FILES['archivo']['tmp_name'];
        
        move_uploaded_file($imagen_temporal,"imagenes/".$imagen);

        $objConexion= new conexion();
        $sql="INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `Descripcion`) VALUES (NULL, '$nombre', '$imagen', '$descripcion'); ";
        $objConexion->ejecutar($sql);
    }
        if($_GET){

            //delete from proyectos ehrer proyectos id = 14
    
            $id=$_GET['borrar'];
            $objConexion= new conexion();
        //      $imagen=$objConexion->consultar("SELECT imagen FROM `proyectos` WHERE id=.$id");
           // unlink("imagenes/".$imagen[0]['imagen']);
          //  print_r($imagen);
        
            $imagen=$objConexion->consultar("SELECT imagen FROM `proyectos` WHERE id=".$id);
            unlink("imagenes/".$imagen[0]['imagen']);
            $sql="DELETE FROM `proyectos` WHERE `proyectos`.`id` =".$id;
            $objConexion->ejecutar($sql);
            header("location:portafolio.php");
            
    } 

    $objConexion= new conexion();
    $resultado=$objConexion->consultar("SELECT * FROM `proyectos`");
    //print_r($resultado);
?>

    <div class="container">
        <div class="row">
            <div class="col-md-5">
            <div class="card">
        <div class="card-header">
            Datos del proyecto
        </div>
        <div class="card-body"> <form action="portafolio.php" enctype="multipart/form-data" method="post">
    Nombre del proyecto:<input required class="form-control" type="text" name="nombre" id="">
    <br/>
    Imgagen del proyecto:<input required class="form-control" type="file" name="archivo" id="">
    <br/>
    Descripcion:
        <textarea required class="from-control" name="descripcion" id="" row="3">Ingresa una descripcion</textarea>
    <input class="btn btn-success" type="submit" value="Enviar proyecto">
        </div>
        
    </div>
            </div>
            <div class="col-md-7">
            <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Descripcion</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($resultado as $proyecto){ ?>
            <tr>
                <td><?php echo $proyecto['id']; ?></td>
                <td><?php echo $proyecto['nombre']; ?></td>
                <td>
                <img width="300" src="imagenes/<?php echo $proyecto['imagen']; ?>" alt="" srcset="">   
                </td>

                <td><?php echo $proyecto['Descripcion']; ?></td>
                <td><a name="" id="" class="btn btn-danger" href="?borrar=<?php echo $proyecto['id']; ?>">Eliminar</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    
            </div>
            
        </div>
    </div>
 
   
   
<?php include("pie.php"); ?>