<?php
/**
 * Content index partial template.
 *
 * @package understrap
 */
 $upload_dir = wp_upload_dir();

?>

<div class="content-wrapper">

<div class="container container-slide">
  <div class="layer-slide">
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="layer">
        <h1>Diseño Web para Despachos Profesionales</h1>
        <h3>Proyecta tu imagen corporativa, demuestra tus conocimientos y explica tus servicios en detalle.</h3>
        <button class="btn btn-cta">empezar</button>
      </div>
    </div>
  </div>
</div>
<div class="container container-services" id="services">
  <div class="row">
    <div class="col-md-12">
      <h2 class="heading-index">Servicios</h2>
    </div>
    <div class="col-md-4">
      <div class="wrapper-service">
        <i class="icon ion-ios-speedometer"></i>
        <h4>Web Optimizada</h4>
      </div>
      <p>
        Adaptada a todos los dispositivos con formulario
        de contacto y geolocalizacón de tu Despacho.
      </p>
    </div>
    <div class="col-md-4">
      <div class="wrapper-service">
        <i class="icon ion-paper-airplane"></i>
        <h4>Comunicación Ágil</h4>
      </div>
      <p>
        Agiliza tus operaciones y las interaciones con tus clientes.
      </p>
    </div>
    <div class="col-md-4">
      <div class="wrapper-service">
        <i class="icon ion-ios-cog"></i>
        <h4>Operativa Mejorada</h4>
      </div>
      <p>
        Integra todas las operaciones de tu despacho en la nube.
        Fideliza tus clientes y fluidiza tus operaciones.
      </p>
    </div>
  </div>
</div>

<section id="section-band-image">
  <div class="layer-band-image">
  </div>
  <div class="container">
    <h3>Con Pinnar podrás gestionar más clientes y fidelizar a los que<br /> ya tienes.</h3>
    <a href="#packs" class="btn btn-cta pull-right">Servicios</a>
  </div>
</section>


<div class="container container-screens">
  <div class="row">
    <div class="col-md-6">
      <img src="wp-content/uploads/2017/02/silver_mac.png"/>
    </div>
    <div class="col-md-6">
      <h2 class="align-middle">Web adaptada a todos los dispositivos</h2>
      <p>
        Tu tarjeta personal de presentacion digital.
        <br />
        Enseña todos tus servicios y
        <br />
        proyectos al mundo.
      </p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <h2>Doc Manager</h2>
      <p>
        Gestiona todos tus documentos de manera intuitiva,
        <br />
        evita el papel y agiliza la comunicación con tus
        <br />
        clients.
      </p>
    </div>
    <div class="col-md-6">
      <img src="wp-content/uploads/2017/02/snappy_3.png"/>
    </div>
  </div>
</div>


<div class="container container-clients" id="clients">
  <div class="row">
    <div class="col-md-12">
      <h2 class="heading-index">Clientes</h2>
      <h4>Despachos Profesionales que ya confian en nosotros.</h4>
    </div>
    <div class="col-md-12 col-clients-images">
      <div class="col-md-3">
        <img src=<?php echo $upload_dir['baseurl'] ."/2017/02/iasesoria_logo.png" ?>>
      </div>
      <div class="col-md-3">
        <img src=<?php echo $upload_dir['baseurl'] ."/2017/02/lopez_rivas.png" ?>>
      </div>
      <div class="col-md-3">
        <img src=<?php echo $upload_dir['baseurl'] ."/2017/02/gestores_muñoz.png" ?>>
      </div>
      <div class="col-md-3">
        <img src=<?php echo $upload_dir['baseurl'] ."/2017/02/díaz_gestores_2.png" ?>>
      </div>
    </div>
  </div>
</div>


<div class="container container-opinions" id="opinions">
  <div class="layer-opinions">
  </div>
  <div class="row">
    <div class="col-md-12">
      <h2 class="heading-index white">OPINIONES</h2>
      <h4 class="white">Palabras que reflejan nuestro compromiso</h4>
      <div id="carouselOpinions" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active" id="slide-one">
            <div class="carousel-caption d-none d-md-block">
              <h3>iAsesoria</h3>
              <p>“Con la ayuda de Pinnar hemos logrado construir una marca digital en
                Internet. Además con la utilización de los packs hemos sido capaces de agilizar
                nuestras operaciones e incrementar la eficiencia del despacho.”
              </p>
              <p>
                Primero.
              </p>
            </div>
          </div>
          <div class="carousel-item" id="slide-two">
            <div class="carousel-caption d-none d-md-block">
              <h3>iAsesoria</h3>
              <p>“Con la ayuda de Pinnar hemos logrado construir una marca digital en
                Internet. Además con la utilización de los packs hemos sido capaces de agilizar
                nuestras operaciones e incrementar la eficiencia del despacho.”
              </p>
              <p>
                Primero.
              </p>
            </div>
          </div>
          <div class="carousel-item">
            <div class="carousel-caption d-none d-md-block">
              <h3>iAsesoria</h3>
              <p>“Con la ayuda de Pinnar hemos logrado construir una marca digital en
                Internet. Además con la utilización de los packs hemos sido capaces de agilizar
                nuestras operaciones e incrementar la eficiencia del despacho.”
              </p>
              <p>
                Primero.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="container container-packs" id="packs">
  <h2 class="heading-index">PACKS</h2>
  <div class="row">
    <div class="col-md-4">
      <div class="card card-basic">
        <div class="card-block">
          <h4 class="card-title">PROFESIONAL</h4>
          <p class="card-text">Su tarjeta de presentación digital.</p>
        </div>
        <div class="card-body">
          <h1>499 <span>€</span></h1>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <p>Web adaptada a todos los dispositivos</p>
            </li>
            <li class="list-group-item">
              <p>Posicionamiento en buscadores básico</p>
            </li>
            <li class="list-group-item">
              <p>Hosting y dominio incluido</p>
            </li>
            <li class="list-group-item">
              <p>Mantenimiento y soporte</p>
            </li>
          </ul>
          <button data-toggle="modal" data-target="#contactModal" class="btn btn-cta btn-cta-card">COMPRAR</button>
          <p>
            *Gratis el primer mes, despues 19€ al mes.
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-basic card-middle">
        <div class="card-block">
          <h4 class="card-title">PREMIUM</h4>
          <p class="card-text">Comunícate mejor con tus clientes y <br />
          agiliza tus procesos.
          </p>
        </div>
        <div class="card-body">
          <img src="wp-content/uploads/2017/02/rocket-ship_small.png"/>
          <h1>1299 <span>€</span></h1>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <p>Pack PREMIUM</p>
            </li>
            <li class="list-group-item">
              <p>Gestión documental</p>
            </li>
            <li class="list-group-item">
              <p>Comunicación y Sistema de Ticketing</p>
            </li>
            <li class="list-group-item">
              <p>Mantenimiento y soporte</p>
            </li>
          </ul>
          <button data-toggle="modal" data-target="#contactModal" class="btn btn-cta btn-cta-card">COMPRAR</button>
          <p>
            *Gratis el primer mes, despues 49€ al mes.
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-basic">
        <div class="card-block">
          <h4 class="card-title">EXPERT</h4>
          <p class="card-text">Su tarjeta de presentación digital.</p>
        </div>
        <div class="card-body">
          <h1>*****</h1>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <p>Pack PREMIUM</p>
            </li>
            <li class="list-group-item">
              <p>Integración con SAGE</p>
            </li>
            <li class="list-group-item">
              <p>Intranet</p>
            </li>
            <li class="list-group-item">
              <p>Servidor dedicado SSD</p>
            </li>
          </ul>
          <button data-toggle="modal" data-target="#contactModal" class="btn btn-cta btn-cta-card">CONTACTAR</button>
        </div>
      </div>
    </div>
  </div>
</div>

</div>

<script>

$('.carousel').carousel({
  interval: 500
})

</script>

<?php the_content(); ?>






<!--form action="/?page_id=66&#038;preview=true#wpcf7-f65-p66-o1" method="post" class="wpcf7-form" novalidate="novalidate">
  <div style="display: none;">
    <input type="hidden" name="_wpcf7" value="65" />
    <input type="hidden" name="_wpcf7_version" value="4.6.1" />
    <input type="hidden" name="_wpcf7_locale" value="es_ES" />
    <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f65-p66-o1" />
    <input type="hidden" name="_wpnonce" value="0935bf5cb6" />
  </div>
    <p>
      <label> Nombre (required)<br /> <span class="wpcf7-form-control-wrap your-name">
        <input type="text" name="your-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" />
      </span>
    </label>
  </p>
  <p>
    <label> Telefono (required)<br /> <span class="wpcf7-form-control-wrap your-email">
      <input type="email" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" />
    </span>
  </label>
</p>
<p>
  <label> Telefono<br /> <span class="wpcf7-form-control-wrap your-subject">
    <input type="text" name="your-subject" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" />
  </span>
</label>
</p>
<p>
  <label> Mensaje<br /> <span class="wpcf7-form-control-wrap your-message">
    <textarea name="your-message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false">
    </textarea>
  </span>
</label>
</p>
<p>
  <input type="submit" value="Enviar" class="wpcf7-form-control wpcf7-submit" />
</p>
<div class="wpcf7-response-output wpcf7-display-none">
</div>
</form-->
