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
        <h1>¡adios al papel!</h1>
        <h3>Incrementa la eficiencia de tu despacho y ahorra tiempo</h3>
        <button class="btn btn-cta">empezar</button>
      </div>
    </div>
  </div>
</div>
<div class="container container-services">
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
        Adaptada a todos los dispositivos con formulario
        de contacto y geolocalizacón de tu Despacho.
      </p>
    </div>
    <div class="col-md-4">
      <div class="wrapper-service">
        <i class="icon ion-ios-cog-outline"></i>
        <h4>Operativa Mejorada</h4>
      </div>
      <p>
        Adaptada a todos los dispositivos con formulario
        de contacto y geolocalizacón de tu Despacho.
      </p>
    </div>
  </div>
</div>

<section id="section-band-image">
  <div class="container-fluid">
    <h3>Con Pinnar podrás gestionar más clientes y fidelizar a los que ya tienes</h3>
    <button class="btn btn-cta pull-right">Servicios</button>
  </div>
</section>

<div class="container container-clients">
  <div class="row">
    <div class="col-md-12">
      <h2 class="heading-index">Clientes</h2>
      <h4>Más de 30 Despachos Profesionales ya confian en nosotros.</h4>
    </div>
    <div class="col-md-12">
      <img src=<?php echo $upload_dir['baseurl'] ."/2017/01/logo.jpg" ?>>
      <img src=<?php echo $upload_dir['baseurl'] ."/2017/01/logo.jpg" ?>>
      <img src=<?php echo $upload_dir['baseurl'] ."/2017/01/logo.jpg" ?>>
      <img src=<?php echo $upload_dir['baseurl'] ."/2017/01/logo.jpg" ?>>
      <img src=<?php echo $upload_dir['baseurl'] ."/2017/01/logo.jpg" ?>>
    </div>
  </div>
</div>


<div class="container container-screens">
  <div class="row">
    <div class="col-md-6">
      <img src="wp-content/uploads/2017/02/demo_iasesoría.png"/>
    </div>
    <div class="col-md-6">
      <h2>Web adaptada a todos los dispositivos</h2>
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
      <div class="col-md-6">
        <h2>Snappy Manager</h2>
        <p>
          Gestiona todos tus documentos de manera intuitiva,
          <br />
          evita el paepl y agiliza la comunicación con tus
          <br />
          clients.
        </p>
      </div>
    </div>
    <div class="col-md-6">
      <img src="wp-content/uploads/2017/02/snappy_3.png"/>
    </div>
  </div>
</div>

<div class="container container-opinions">
  <div class="row">
    <div class="col-md-12">
      <h2 class="heading-index">OPINIONES</h2>
      <H4>Palabras que reflejan nuestro compromiso</H4>
      <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
            <div class="carousel-caption d-none d-md-block">
              <h3>iAsesoria</h3>
              <p>"Con la ayuda de pinnar hemos"</p>
            </div>
          </div>
          <div class="carousel-item">
            <div class="carousel-caption d-none d-md-block">
              <h3>iAsesoria</h3>
              <p>"Con la ayuda de pinnar hemos"</p>
            </div>          </div>
          <div class="carousel-item">
            <div class="carousel-caption d-none d-md-block">
              <h3>iAsesoria</h3>
              <p>"Con la ayuda de pinnar hemos"</p>
            </div>          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <h2 class="heading-index">PACKS</h2>
  <div class="row">
    <div class="col-md-4">
      <div class="card card-basic">
        <div class="card-block">
          <h4 class="card-title">BASIC+</h4>
          <p class="card-text">Su tarjeta de presentación digital.</p>
        </div>
        <div class="card-body">
          <h1>499 <span>€</span></h1>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <p>Cras justo odio</p>
            </li>
            <li class="list-group-item">
              <p>Cras justo odio pdio odi</p>
            </li>
            <li class="list-group-item">
              <p>Cras justo odio odio</p>
            </li>
          </ul>
          <button class="btn btn-cta btn-cta-card">COMPRAR</button>
          <p>
            *Gratis el primer mes, despues 29€ al mes.
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-basic card-middle">
        <div class="card-block">
          <h4 class="card-title">PROFESSIONAL</h4>
          <p class="card-text">Comunícate mejor con tus clientes y <br />
          agiliza tus procesos.
          </p>
        </div>
        <div class="card-body">
          <img src="wp-content/uploads/2017/02/rocket-ship_small.png"/>
          <h1>1299 <span>€</span></h1>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <p>Cras justo odio</p>
            </li>
            <li class="list-group-item">
              <p>Cras justo odio pdio odi</p>
            </li>
            <li class="list-group-item">
              <p>Cras justo odio odio</p>
            </li>
            <li class="list-group-item">
              <p>Cras justo odio odio***</p>
            </li>
          </ul>
          <button class="btn btn-cta btn-cta-card">COMPRAR</button>
          <p>
            *Gratis el primer mes, despues 29€ al mes.
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-basic">
        <div class="card-block">
          <h4 class="card-title">BASIC+</h4>
          <p class="card-text">Su tarjeta de presentación digital.</p>
        </div>
        <div class="card-body">
          <h1>499 <span>€</span></h1>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <p>Cras justo odio</p>
            </li>
            <li class="list-group-item">
              <p>Cras justo odio pdio odi</p>
            </li>
            <li class="list-group-item">
              <p>Cras justo odio odio</p>
            </li>
          </ul>
          <button class="btn btn-cta btn-cta-card">COMPRAR</button>
          <p>
            *Gratis el primer mes, despues 29€ al mes.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

</div>



<?php the_content(); ?>
