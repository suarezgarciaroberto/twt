<?php 
include_once "./models/news_model.php";
include_once "./models/projects_model.php";

class IndexController{
  private $news;
  private $projects;

  public function __construct(){
    $this->news = new NewsModel();
    $this->projects = new ProjectsModel();
  }

  public function getNews(){
    return $this->news->getAll();
  }

  public function getProjects(){
    return $this->projects->getAll();
  }
}

?>