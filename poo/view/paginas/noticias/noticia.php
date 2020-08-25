<html>
<main>
<div class="panel-heading"><h1>Notícias</h1></div>
<div class="panel panel-primary">

<div class="panel-heading"><h1><?php echo $noticia->titulo ?></h1></div>
    <?php echo $noticia->descricao?>

    <div class='data'>
        <span class="label label-primary"><?php echo $noticia->data ?></span>
        <span class="label label-primary"><?php echo "Por:".$noticia->nome_usuario ?></span>
    </div>

    </div>

    <div class="panel panel-primary">

        <div class="panel-heading">
            <h5 class="panel-title">Comentarios</h5>
        </div>
        <?php
            if ($noticia->comentarios){
                foreach ($noticia->comentarios AS $comentario){
        ?>
        <div class="coments">
            <p class="nome-user"><?php echo $comentario->nome_usuario?></p>
            <p class="coment-user"><?php echo $comentario->comentario?></p>
        </div>
        <?php
                }
            }
        ?>
         <form class="form">
             <input type="hidden" name="noticia_id" value="<?php echo $noticia->id ?>">
             <input type="hidden" name="nome_usuario" value="
             <?php
                echo isset($_SESSION['usuario']); 
             ?>
             ">
             <div class="form-group">
            <input type="text" class="form-control" placeholder="Adicione um comentário">
            <div class="input-form">
            <button type="submit" class="btn btn-primary btn-sm">Enviar</button>
            </div>
            </div>

        </form>

    </div>



</div>


</main>
</html>