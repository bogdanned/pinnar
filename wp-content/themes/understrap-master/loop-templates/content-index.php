<?php
/**
 * Content index partial template.
 *
 * @package understrap
 */
 $upload_dir = wp_upload_dir();

?>

<link rel='stylesheet' type="text/css" media="all" src="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"/>


<div class="container container-slide">
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
<section>
  <h1>Grey section goes here</h1>
</section>
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
    <button class="btn btn-primary">Servicios</button>
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

<div class="container container-customers">
  <div class="row">
    <div class="col-md-12">
      <h2 class="heading-index">Clientes</h2>
      <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
            <img class="d-block img-fluid" src="..." alt="First slide">
            <div class="carousel-caption d-none d-md-block">
              <h3>...</h3>
              <p>...</p>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block img-fluid" src="..." alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block img-fluid" src="..." alt="Third slide">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <h2 class="heading-index">PACKS</h2>
  <div class="row">
    <div class="col-md-4">
      <div class="card" style="width: 20rem;">
        <div class="card-block">
          <h4 class="card-title">BASIC</h4>
          <p class="card-text">Su tarjeta de presentación digital.</p>
        </div>
        <h1>499</h1><span>/mes</span>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Cras justo odio</li>
          <li class="list-group-item">Dapibus ac facilisis in</li>
          <li class="list-group-item">Vestibulum at eros</li>
        </ul>
        <div class="card-block">
          <button class="btn btn-cta">COMPRAR</button>
          <p>
            *Gratis el primer mes, despues 29€ al mes.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>




<?php the_content(); ?>
