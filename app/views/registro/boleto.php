<main class="pagina">
    <h2 class="pagina__heading"><?php echo $titulo; ?></h2>
    <p class="pagina__descripcion">Tu boleto - Te recomendamos almacenarlo, puedes compartirlo en redes sociales.</p>

    <div class="boleto__virtual">
        <div class="boleto boleto--<?php echo strtolower($registro->paquete); ?> boleto--acceso">
            <div class="boleto__contenido">
                <h4 class="boleto__logo">&#60;DevWebCamp /></h4>
                <p class="boleto__plan"><?php echo $registro->paquete; ?></p>
                <p class="boleto__nombre"><?php echo $registro->nombre; ?></p>
            </div>

            <p class="boleto__codigo"><?php echo '#' . $registro->token; ?></p>

        </div>
    </div>

</main>