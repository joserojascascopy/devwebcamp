<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Evento</legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre Evento:</label>
        <input
            class="formulario__input"
            type="text"
            id="nombre"
            name="nombre"
            placeholder="Nombre Evento"
            value="<?php echo $evento->nombre; ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="descripcion">Descripcón:</label>
        <textarea
            rows="8"
            class="formulario__input"
            id="descripcion"
            name="descripcion"
            placeholder="Descripcion Evento"><?php echo $evento->descripcion; ?></textarea>
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="categoria">Categoria o Tipo de Evento</label>
        <select name="categoria_id" id="categoria" class="formulario__select">
            <option value="">-Seleccionar-</option>
            <?php foreach ($categorias as $categoria) : ?>
                <option <?php echo ($evento->categoria_id === $categoria->id) ? 'selected' : ''; ?> value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="formulario__campo">
        <p class="formulario__texto">Selecciona el Día:</p>
        <div class="formulario__radio">
            <?php foreach ($dias as $dia) : ?>
                <div class="formulario__radio--centrar">
                    <label for="<?php echo strtolower($dia->nombre); ?>"><?php echo $dia->nombre; ?></label>
                    <input
                        type="radio"
                        id="<?php echo strtolower($dia->nombre); ?>"
                        name="dia"
                        value="<?php echo $dia->id; ?>">
                </div>
            <?php endforeach; ?>
        </div>
        <input type="hidden" name="dia_id" value="">
    </div>

    <div class="formulario__campo">
        <p class="formulario__label">Seleccionar Hora:</p>
        <ul class="horas">
            <?php foreach ($horas as $hora) : ?>
                <li data-hora-id="<?php echo $hora->id; ?>" id="horas" class="horas__hora horas__hora--deshabilitada"><?php echo $hora->hora; ?></li>
            <?php endforeach; ?>
        </ul>
        <input type="hidden" name="hora_id" value="">
    </div>

</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Extra</legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="ponentes">Ponente:</label>
        <input class="formulario__input" type="text" id="ponentes" placeholder="Buscar Ponente">

        <ul id="listado-ponentes" class="listado-ponentes">

        </ul>
        <input type="hidden" name="ponente_id" value="">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="disponibles">Lugares Disponibles:</label>
        <input
            min="1"
            class="formulario__input"
            type="number"
            id="disponibles"
            name="disponibles"
            placeholder="Ej: 20"
            value="<?php echo $evento->disponibles; ?>">
    </div>

</fieldset>