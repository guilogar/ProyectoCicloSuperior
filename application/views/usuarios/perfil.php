<?php template_set('title', 'Perfil de Usuario') ?>

<div class="row large-6 columns menu-login">
    <?php if ( ! empty(error_array())): ?>
        <div data-alert class="alert-box alert radius alerta">
          <?= validation_errors() ?>
          <a href="#" class="close">&times;</a>
        </div>
    <?php endif ?>
</div>
<div class="row">
    <div class="tabdemo wrapper tabdemo--one large-8 columns">
        <ul class="tabdemo__menu menu">
            <li class="tab"><a href="#" class="tab">Articulos Disponibles</a></li>
            <li class="tab"><a href="#" class="tab">Ventas</a></li>
            <li class="tab"><a href="#" class="tab">Valoraciones</a></li>
            <?php if($usuario_perfil !== TRUE): ?>
                <li class="tab"><a href="#" class="tab">Escribir PM</a></li>
            <?php endif; ?>
            <?php if($usuario_perfil === TRUE): ?>
                <li class="tab"><a href="#" class="tab">Compras</a></li>
                <li class="tab"><a href="#" class="tab">Favoritos</a></li>
                <li class="tab"><a href="#" class="tab">PM</a></li>
            <?php endif; ?>
        </ul>
        <div class="tabdemo__content content">
            <div class="tabdemo__content-item">
                <div class="row">
                    <?php if( ! empty($articulos_usuarios)): ?>
                        <?php foreach ($articulos_usuarios as $v): ?>
                            <div class="large-6 columns left">
                                <div class="">
                                    <?= anchor('/articulos/buscar/' . $v['id'],
                                        img('/imagenes_articulos/' . $v['id'] . '_1' . '.jpg')) ?>
                                </div>
                                <div class="">
                                    <?= $v['precio'] ?>
                                </div>
                                <div class="">
                                    <?= anchor('/articulos/buscar/' . $v['id'], $v['nombre']) ?>
                                </div>
                                <div class="">
                                    <?= form_open('/frontend/portada/') ?>
                                        <?= form_hidden('categoria', $v['categoria_id'],
                                                       'id="categoria" class=""') ?>
                                        <?= form_hidden('nombre', '',
                                                       'id="nombre" class=""') ?>
                                        <?= form_submit('buscar', $v['nombre_categoria'], 'class="front_button"') ?>
                                    <?= form_close() ?>
                                    <?php if($usuario_perfil === TRUE): ?>
                                        <p>
                                            <a href=""
                                               class="small secondary radius button split">
                                               Opciones
                                               <span data-dropdown="drop_articulo_disponible_<?= $v['id']?>"></span>
                                           </a>
                                           <br>
                                        </p>
                                        <ul id="drop_articulo_disponible_<?= $v['id'] ?>" class="f-dropdown" data-dropdown-content>
                                           <li><a href="/articulos/vender/<?= $v['id'] ?>">Vender Articulo</a></li>
                                           <li><a href="/articulos/borrar/<?= $v['id'] ?>">Borrar Articulo</a></li>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <h3>El usuario <?= $usuario['nick'] ?> no tiene productos a la venta actualmente >.<</h3>
                    <?php endif; ?>
                </div>
            </div>
            <div class="tabdemo__content-item">
                <div class="row">
                    <?php foreach ($articulos_vendidos as $v): ?>
                        <div class="large-6 columns left">
                            <div class="">
                                <?= anchor('/articulos/buscar/' . $v['articulo_id'],
                                            img('/imagenes_articulos/' . $v['articulo_id'] . '_1' . '.jpg')) ?>
                            </div>
                            <div class="">
                                <?= $v['precio'] ?>
                            </div>
                            <div class="">
                                <?= anchor('/articulos/buscar/' . $v['articulo_id'], $v['nombre']) ?>
                            </div>
                            <div class="">
                                <?= form_open('/frontend/portada/') ?>
                                    <?= form_hidden('categoria', $v['categoria_id'],
                                                   'id="categoria" class=""') ?>
                                    <?= form_hidden('nombre', '',
                                                   'id="nombre" class=""') ?>
                                    <?= form_submit('buscar', $v['nombre_categoria'], 'class="front_button"') ?>
                                <?= form_close() ?>
                                <?php if($usuario_perfil === TRUE): ?>
                                    <p>
                                        <a href=""
                                           class="small secondary radius button split">
                                           Opciones
                                           <span data-dropdown="drop_articulo_vendido_<?= $v['articulo_id']?>"></span>
                                        </a>
                                        <br>
                                    </p>
                                    <ul id="drop_articulo_vendido_<?= $v['articulo_id'] ?>" class="f-dropdown" data-dropdown-content>
                                        <?php if($v['valoracion'] === NULL && $v['comprador_id'] !== NULL): ?>
                                            <li>
                                                <a href="/usuarios/valorar_comprador/<?= $v['venta_id'] ?>">
                                                    Valorar al comprador
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                      <li>
                                          <a href="/articulos/borrar/<?= $v['articulo_id'] ?>">
                                              Borrar Articulo
                                          </a>
                                      </li>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="tabdemo__content-item">
                <ul class="accordion" data-accordion>
                  <li class="accordion-navigation">
                    <a href="#panel1a">Ventas</a>
                    <div id="panel1a" class="content active">
                        <div class="row">
                            <?php foreach ($valoraciones_ventas as $v): ?>
                                <?php if($v['valoracion'] === NULL) continue; ?>
                                <div class="large-6 columns left">
                                    <div class="">
                                        <h5>Comprador =>
                                            <?= anchor('/usuarios/perfil/' .
                                                $v['comprador_id'],
                                                $v['comprador_nick']) ?>
                                        </h5>
                                    </div>
                                    <div class="">
                                        <p>Le vendió a <?= $v['comprador_nick'] ?>
                                            <?= $v['nombre'] ?></p>
                                    </div>
                                    <div class="valoracion" value="<?= $v['valoracion'] ?>">
                                    </div>
                                    <div class="">
                                        <p><?= $v['valoracion_text'] ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                  </li>
                  <li class="accordion-navigation">
                    <a href="#panel2a">Compras</a>
                    <div id="panel2a" class="content">
                        <div class="row">
                            <?php foreach ($valoraciones_compras as $v): ?>
                                <?php if($v['valoracion'] === NULL) continue; ?>
                                <div class="large-6 columns left">
                                    <div class="">
                                        <h5>Vendedor =>
                                            <?= anchor('/usuarios/perfil/' .
                                                $v['vendedor_id'],
                                                $v['vendedor_nick']) ?>
                                        </h5>
                                    </div>
                                    <div class="">
                                        <p><?= $v['vendedor_nick'] ?> le
                                            vendio <?= $v['nombre'] ?></p>
                                    </div>
                                    <div class="valoracion" value="<?= $v['valoracion'] ?>">
                                    </div>
                                    <div class="">
                                        <p><?= $v['valoracion_text'] ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                  </li>
                </ul>
            </div>
            <?php if($usuario_perfil !== TRUE): ?>
                <div class="tabdemo__content-item">
                    <div class="row">
                        <?php if ( ! empty(error_array())): ?>
                            <div data-alert class="alert-box alert radius alerta">
                              <?= validation_errors() ?>
                              <a href="#" class="close">&times;</a>
                            </div>
                        <?php endif ?>
                        <?= form_open('/usuarios/insertar_pm/' . $usuario['id']) ?>
                            <?= form_hidden('emisor_id', $usuario_propio['id'], 'id="emisor_id" class=""') ?>
                            <div class="nick-field">
                              <?= form_label('Mensaje:', 'mensaje') ?>
                              <?= form_textarea('mensaje', set_value('mensaje', '', FALSE),
                                             'id="mensaje" class=""') ?>
                            </div>
                            <?= form_submit('enviar', 'Enviar', 'class="success button small radius"') ?>
                        <?= form_close() ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($usuario_perfil === TRUE): ?>
                <div class="tabdemo__content-item">
                    <div class="row">
                        <?php foreach ($articulos_comprados as $v): ?>
                            <div class="large-6 columns left">
                                <div class="">
                                    <?= anchor('/articulos/buscar/' . $v['articulo_id'],
                                                img('/imagenes_articulos/' .
                                                    $v['articulo_id'] . '_1' . '.jpg')) ?>
                                </div>
                                <div class="">
                                    <?= $v['precio'] ?>
                                </div>
                                <div class="">
                                    <?= anchor('/articulos/buscar/' . $v['articulo_id'], $v['nombre']) ?>
                                </div>
                                <div class="">
                                    <?= form_open('/frontend/portada/') ?>
                                        <?= form_hidden('categoria', $v['categoria_id'],
                                                       'id="categoria" class=""') ?>
                                        <?= form_hidden('nombre', '',
                                                       'id="nombre" class=""') ?>
                                        <?= form_submit('buscar', $v['nombre_categoria'], 'class="front_button"') ?>
                                    <?= form_close() ?>
                                    <p>
                                        <a href=""
                                           class="small secondary radius button split">
                                           Opciones
                                           <span data-dropdown="drop_articulo_comprados_<?= $v['articulo_id'] ?>"></span>
                                        </a>
                                        <br>
                                   </p>
                                   <ul id="drop_articulo_comprados_<?= $v['articulo_id'] ?>" class="f-dropdown" data-dropdown-content>
                                       <?php if($v['valoracion'] === NULL): ?>
                                           <li>
                                               <a href="/usuarios/valorar_vendedor/<?= $v['venta_id'] ?>">
                                                   Valorar al vendedor
                                               </a>
                                           </li>
                                       <?php endif; ?>
                                       <li>
                                           <a href="/usuarios/borrar_compra/<?= $v['venta_id'] ?>">
                                               Yo no he comprado esto!!!
                                           </a>
                                       </li>
                                   </ul>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="tabdemo__content-item">
                    <div class="row">
                        <?php foreach ($articulos_favoritos as $v): ?>
                            <div class="large-6 columns left">
                                <div class="">
                                    <?= anchor('/articulos/buscar/' . $v['articulo_id'],
                                                img('/imagenes_articulos/' .
                                                    $v['articulo_id'] . '_1' . '.jpg')) ?>
                                </div>
                                <div class="">
                                    <?= $v['precio'] ?>
                                </div>
                                <div class="">
                                    <?= anchor('/articulos/buscar/' . $v['articulo_id'], $v['nombre']) ?>
                                </div>
                                <div class="">
                                    <?= form_open('/frontend/portada/') ?>
                                        <?= form_hidden('categoria', $v['categoria_id'],
                                                       'id="categoria" class=""') ?>
                                        <?= form_hidden('nombre', '',
                                                       'id="nombre" class=""') ?>
                                        <?= form_submit('buscar', $v['nombre_categoria'], 'class="front_button"') ?>
                                    <?= form_close() ?>
                                    <p>
                                        <a href=""
                                           class="small secondary radius button split">
                                           Opciones
                                           <span data-dropdown="drop_articulo_favorito_<?= $v['articulo_id'] ?>"></span>
                                        </a>
                                        <br>
                                   </p>
                                   <ul id="drop_articulo_favorito_<?= $v['articulo_id'] ?>" class="f-dropdown" data-dropdown-content>
                                      <li><a href="/articulos/eliminar_favorito/<?= $v['articulo_id'] ?>">Eliminar de Favoritos</a></li>
                                   </ul>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="tabdemo__content-item">
                    <ul class="accordion" data-accordion>
                      <li class="accordion-navigation">
                        <a href="#panel1a">PM's No Vistos</a>
                        <div id="panel1a" class="content active">
                            <?php foreach ($pm_no_vistos as $v): ?>
                                    <div class="">
                                        <?php if(is_file($_SERVER["DOCUMENT_ROOT"] .  '/imagenes_usuarios/' . $v['emisor_id'] . '.jpg')): ?>
                                            <?php $url = '/imagenes_usuarios/' . $v['emisor_id'] . '.jpg' ?>
                                        <?php else: ?>
                                            <?php $url = '/imagenes_usuarios/sin-imagen.jpg' ?>
                                        <?php endif; ?>
                                        <?= anchor('/usuarios/perfil/' . $v['emisor_id'],
                                                    img(array(
                                                        'src' => $url,
                                                        'title' => $v['nick_emisor'],
                                                        'alt' => $v['nick_emisor'],
                                                        'class' => 'imagen_nick',
                                                    ))) ?>
                                        <?= anchor('/usuarios/perfil/' . $v['emisor_id'], $v['nick_emisor']) ?>
                                    </div>
                                    <div class="toggle toggle-light"
                                         data-toggle-on="false"
                                         data-toggle-height="50"
                                         data-toggle-width="90"
                                         id="<?= $v['id'] ?>"></div>
                                    <div class="">
                                        <?= $v['mensaje'] ?>
                                    </div>
                                    <div class="">
                                        <?= $v['fecha_mensaje'] ?>
                                    </div>
                            <?php endforeach; ?>
                        </div>
                      </li>
                      <li class="accordion-navigation">
                        <a href="#panel2a">PM's Vistos</a>
                        <div id="panel2a" class="content">
                            <?php foreach ($pm_vistos as $v): ?>
                                    <div class="">
                                        <?php if(is_file($_SERVER["DOCUMENT_ROOT"] .  '/imagenes_usuarios/' . $v['emisor_id'] . '.jpg')): ?>
                                            <?php $url = '/imagenes_usuarios/' . $v['emisor_id'] . '.jpg' ?>
                                        <?php else: ?>
                                            <?php $url = '/imagenes_usuarios/sin-imagen.jpg' ?>
                                        <?php endif; ?>
                                        <?= anchor('/usuarios/perfil/' . $v['emisor_id'],
                                                    img(array(
                                                        'src' => $url,
                                                        'title' => $v['nick_emisor'],
                                                        'alt' => $v['nick_emisor'],
                                                        'class' => 'imagen_nick',
                                                    ))) ?>
                                        <?= anchor('/usuarios/perfil/' . $v['emisor_id'], $v['nick_emisor']) ?>
                                    </div>
                                    <div class="toggle toggle-light"
                                         data-toggle-on="true"
                                         data-toggle-height="50"
                                         data-toggle-width="90"
                                         id="<?= $v['id'] ?>"></div>
                                    <div class="">
                                        <?= $v['mensaje'] ?>
                                    </div>
                                    <div class="">
                                        <?= $v['fecha_mensaje'] ?>
                                    </div>
                            <?php endforeach; ?>
                        </div>
                      </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="large-4 columns">
        <div class="">
            <?php if($usuario['latitud'] !== NULL && $usuario['longitud'] !== NULL): ?>
                <div id="map" class="mapa_perfil"></div>
            <?php else: ?>
                El usuario <?= $usuario['nick'] ?> no ha aceptado dar su ubicacion.
            <?php endif; ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.toggle').toggles({
        drag: true,
        click: true,
        text: {
            on: 'Visto',
            off: 'No'
        },
        animate: 250, // animation time (ms)
        easing: 'swing', // animation transition easing function
        checkbox: null, // the checkbox to toggle (for use in forms)
        clicker: null,
        // width: 50, // width used if not set in css
        // height: 20, // height if not set in css
        type: 'compact'
    });
    $('.toggle').on('toggle', function(e, active) {
        var pm_id = $(this).prop('id');
        $.ajax({
            url: "<?= base_url() ?>usuarios/update_pm/" + pm_id,
            type: 'GET',
            async: true,
            success: function (response) {
            },
            error: function (error) {
            },
        });
    });
</script>
<script type="text/javascript">
    var valores_defecto = {
        numStars: 5,
        maxValue: 5,
        fullStar: true,
        readOnly: true,
    };
    $(function () {
        $(".valoracion").rateYo(valores_defecto);
        $('.valoracion').each(function(index) {
            $(this).rateYo("rating", parseInt($(this).attr("value")));
        });
    });
</script>
<script>
    $(window).load(function(){
        $(".tabs").tabtab({
            animateHeight: !1,
            fixedHeight: !1
        }),
        $(".tabdemo--one").tabtab({
            animateHeight: !0,
            fixedHeight: !1,
            scale: 1,
            rotateX: 0,
            rotateY: 90,
            speed: 500,
            transformOrigin: "center left",
            easing: "easeInOutCubic",
            translateX: 0,
            tabMenu: ".tabdemo__menu",
            tabContent: ".tabdemo__content",
            startSlide: 1
        }),
        $(".package-managers-toggle").toggle({
            "class": "open",
            target: !1
        })
    });
</script>
<?php if($usuario['latitud'] !== NULL && $usuario['longitud'] !== NULL): ?>
    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          mapTypeControl: false,
          zoomControl: true,
          scaleControl: true,
          streetViewControl: false,
          fullscreenControl: false
        });

        if (navigator.geolocation){
            mostrarLocalizacion();
        }
        else {
            alert("Su navegador no soporta Geolocalizacion");
        }
      }

      function mostrarLocalizacion(){
            <?php if($usuario['latitud'] !== NULL): ?>
                var latitud = <?= $usuario['latitud'] ?>;
            <?php else: ?>
                var latitud = 40.4155;
            <?php endif; ?>

            <?php if($usuario['longitud'] !== NULL): ?>
                var longitud = <?= $usuario['longitud'] ?>;
            <?php else: ?>
                var longitud = -3.6968;
            <?php endif; ?>

            var pos = new google.maps.LatLng(latitud, longitud);
            map.setCenter(pos);

            var marker = new google.maps.Marker({
                position: pos,
                map: map,
                title: "<?= $usuario['nick'] ?> está aquí >.<",
            });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDY6aARD3BZGp4LD2RhzefUdfSIy4mqvzU&callback=initMap"
    async defer></script>
<?php endif; ?>
