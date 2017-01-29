<?php
/**
 * Content index partial template.
 *
 * @package understrap
 */
?>

<h1>The home page</h1>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
            <img class="d-block img-fluid" src="..." alt="First slide">
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
<section>
  <h1>Grey section goes here</h1>
</section>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>Servicios</h2>
    </div>
    <div class="col-md-4">
      <i class="icon ion-ios-speedometer"></i>
      <p>
        Adaptada a todos los dispositivos con formulario
        de contacto y geolocalizacón de tu Despacho.
      </p>
    </div>
    <div class="col-md-4">
      <i class="icon ion-paper-airplane"></i>
      <p>
        Adaptada a todos los dispositivos con formulario
        de contacto y geolocalizacón de tu Despacho.
      </p>
    </div>
    <div class="col-md-4">
      <i class="icon ion-paper-gear"></i>
      <p>
        Adaptada a todos los dispositivos con formulario
        de contacto y geolocalizacón de tu Despacho.
      </p>
    </div>
  </div>
</div>
<section>
  <h1>Photo section goes here</h1>
</section>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>Clients Goes here</h1>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>Opiniones</h1>
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
  <div class="row">
    <div class="col-md-4">
      <div class="card" style="width: 20rem;">
        <img class="card-img-top" src="..." alt="Card image cap">
        <div class="card-block">
          <h4 class="card-title">Card title</h4>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Cras justo odio</li>
          <li class="list-group-item">Dapibus ac facilisis in</li>
          <li class="list-group-item">Vestibulum at eros</li>
        </ul>
        <div class="card-block">
          <a href="#" class="card-link">Card link</a>
          <a href="#" class="card-link">Another link</a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-12">

    </div>
  </div>
</div>



<?php the_content(); ?>
