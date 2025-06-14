                <div class="col-md-3 mb-3">
                    <img src="../imagenes/<?php echo $dato['archivo']; ?>" class="img-thumbnail" alt="<?php echo $dato['descripcion']; ?>">
                    <p><?php echo $dato['descripcion']; ?></p>
                    <a href="index.php?accion=imgdelete&id=<?php echo $dato['id'];?>&espe_id=<?php echo $id;?>" class="btn btn-danger btn-sm">Eliminar</a>
                </div>