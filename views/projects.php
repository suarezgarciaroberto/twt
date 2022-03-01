<?php 
$tech_icons = array();
$tech_icons['android'] = '<i class="fab fa-android"></i>';
$tech_icons['css3'] = '<i class="fab fa-css3-alt"></i>';
$tech_icons['github'] = '<i class="fab fa-github"></i>';
$tech_icons['html5'] = '<i class="fab fa-html5"></i>';
$tech_icons['apple'] = '<i class="fab fa-apple"></i>';
$tech_icons['java'] = '<i class="fab fa-java"></i>';
$tech_icons['js'] = '<i class="fab fa-js-square"></i>';
$tech_icons['node'] = '<i class="fab fa-node-js"></i>';
$tech_icons['php'] = '<i class="fab fa-php"></i>';
$tech_icons['python'] = '<i class="fab fa-python"></i>';
$tech_icons['react'] = '<i class="fab fa-react"></i>';
$tech_icons['wordpress'] = '<i class="fab fa-wordpress"></i>';
?>
<div class="container" id="index-projects-container">
  <div class="title">
    <h2>Nuestro Portfolio</h2>
    <p>Estas son algunas de las aplicaciones que ha desarrollado el equipo de TWT.</p>
  </div>
  <div class="thumbnails-container">
    <div class="thumbnails-inner-container">
      <?php for($i = 0;$i<count($data);$i++){ 
        $project_name = $data[$i]['titulo'];
        ?>
        <img src="assets/images/projects/<?php echo $project_name."/".$project_name;?>1.jpg" class="thumb-img" alt="<?php echo $project_name; ?>" data-toggle="modal" data-target="#<? echo $project_name; ?>-modal">  
      <?php } ?>
    </div>
  </div>
</div>
<?php for($i = 0;$i<count($data);$i++){ 
  $project_name = $data[$i]['titulo'];
  ?>
<div class="modal fade" id="<?php echo $project_name; ?>-modal" tabindex="-1" aria-labelledby="<?php echo $project_name; ?>Modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo $project_name; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="carousel-container">
          <div id="<?php echo $project_name; ?>-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="assets/images/projects/<?php echo $project_name."/".$project_name;?>1.jpg" class="carousel-project-img" alt="<?php echo $project_name; ?>1">
              </div>
              <div class="carousel-item">
                <img src="assets/images/projects/<?php echo $project_name."/".$project_name;?>2.jpg" class="carousel-project-img" alt="<?php echo $project_name; ?>2">
              </div>
              <div class="carousel-item">
                <img src="assets/images/projects/<?php echo $project_name."/".$project_name;?>3.jpg" class="carousel-project-img" alt="<?php echo $project_name; ?>3">
              </div>
            </div>
            <a class="carousel-control-prev" href="#<?php echo $project_name; ?>-carousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#<?php echo $project_name; ?>-carousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
        <p class="modal-project-description"><?php echo $data[$i]['descripcion']?></p>
        <label class="special-label" for="modal-project-techs">Tecnologías empleadas:</label>
        <div class="modal-project-techs">
        <?php 
          $tech_exploded = explode("|",$data[$i]['tecnologias']);
          foreach($tech_exploded as $tech){
            echo $tech_icons[$tech];
          }
        ?>
        </div>
        <label class="special-label" for="modal-project-time">Tiempo de desarrollo:</label>
        <p class="modal-project-time"><?php echo $data[$i]['tiempo']?></p>
      </div>
    </div>
  </div>
</div>
<?php } ?>
