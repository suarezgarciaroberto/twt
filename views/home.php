<div class="home-container">
  <div class="presentation-container">
    <div class="card" id="whoweare-card">
      <div class="card-header" id="whoweare-card-header">
        <div id="whoweare-card-header-bg"></div>
        <h3><u>Haz realidad tus ideas digitales en <br>The Worker Tree</u></h3>
      </div>
      <div class="card-body">
        <p class="card-text" id='bio'><b>Somos el equipo que convertirá tu idea en una realidad.</b> 
          <br>En <b>TWT</b> nos implicamos al máximo con tu idea, nos sumerjimos hasta que no quede detalle sin pulir, todo para que tu idea no solo se haga realidad sino que además tenga éxito!
        </p>
      </div>
    </div>
    <?php
    for($i=0;$i<count($data);$i++){
      ?>
      <div class="notice-container hide" id="notice-<?php echo $data[$i]['id'];?>">
        <span class="close-notice"><span class="close-notice-icon">&times;</span></span>
        <h2><?php echo $data[$i]['titular'];?></h2>
        <h5><?php echo $data[$i]['resumen'];?> - <?php echo $data[$i]['fecha'];?></h5>
        <!-- <img class="notice-img" src="./assets/images/noticias/<?php echo $data[$i]['titular'];?>.jpg" alt="<?php echo $data[$i]['titular'];?>"> -->
        <p><?php echo $data[$i]['contenido'];?></p>
      </div>
      <?php 
    }
    ?>
  </div>
  <div class="notices-list">
    <h3>Noticias</h3>
    <?php
    if(count($data) > 5){
      for($i=count($data)-5; $i<count($data);$i++){
        ?>
        <div data-id="<?php echo $data[$i]['id'];?>" class="news-link"><?php echo $data[$i]['titular'];?></div>
        <?php
      }
    } else {
      for($i = 0; $i < count($data); $i++){
        ?>
        <div data-id="<?php echo $data[$i]['id'];?>" class="news-link"><?php echo $data[$i]['titular'];?></div>
        <?php
      }
    }
    ?>
  </div>
</div>
