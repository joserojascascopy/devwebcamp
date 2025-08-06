<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion Personal</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre:</label>
        <input class="formulario__input" type="text" id="nombre" name="nombre" placeholder="Nombre Ponente" value="<?php echo $ponente->nombre ?? ''; ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="apellido">Apellido:</label>
        <input class="formulario__input" type="text" id="apellido" name="apellido" placeholder="Apellido Ponente" value="<?php echo $ponente->apellido ?? ''; ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="ciudad">Ciudad:</label>
        <input class="formulario__input" type="text" id="ciudad" name="ciudad" placeholder="Ciudad Ponente" value="<?php echo $ponente->ciudad ?? ''; ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="pais">País:</label>
        <input class="formulario__input" type="text" id="pais" name="pais" placeholder="País Ponente" value="<?php echo $ponente->pais ?? ''; ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="imagen">Imagen:</label>
        <input class="formulario__input formulario__input--file" type="file" id="imagen" name="imagen">
    </div>

</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Extra</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="tags_input">Áreas de Experincias (separadas por coma):</label>
        <input class="formulario__input" type="text" id="tags_input" placeholder="Ej: Node.js, PHP, JavaScript, React">
        <div id="tags" class="formulario__listado">

        </div>
        <input type="hidden" name="tags" value="<?php echo $ponentes->tags ?? ''; ?>">
    </div>

</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Redes Sociales</legend>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-facebook"></i>
            </div>
            <input class="formulario__input--sociales" type="text" name="redes[facebook]" placeholder="Facebook" value="<?php echo $ponente->facebook ?? ''; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-twitter"></i>
            </div>
            <input class="formulario__input--sociales" type="text" name="redes[twitter]" placeholder="Twitter" value="<?php echo $ponente->twitter ?? ''; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input class="formulario__input--sociales" type="text" name="redes[youtube]" placeholder="Youtube" value="<?php echo $ponente->youtube ?? ''; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <input class="formulario__input--sociales" type="text" name="redes[instagram]" placeholder="Instagram" value="<?php echo $ponente->instagram ?? ''; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <input class="formulario__input--sociales" type="text" name="redes[tiktok]" placeholder="TikTok" value="<?php echo $ponente->tiktok ?? ''; ?>">
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-github"></i>
            </div>
            <input class="formulario__input--sociales" type="text" name="redes[github]" placeholder="Github" value="<?php echo $ponente->github ?? ''; ?>">
        </div>
    </div>

</fieldset>