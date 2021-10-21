<?php

  class  PreviewProvider {

    private $con; 
    private $username;
      
    public function __construct($con, $username){
      $this->con = $con;
      $this->username = $username;
    }

    //  TV Show Preview Video
    public function createTVShowPreviewVideo(){
      
      $entitiesArray = EntityProvider::getTVShowEntities($this->con, null, 1);
    
      if(sizeof($entitiesArray) == 0 ){
        ErrorMessage::show("No TV shows to display");
      }

      return $this->createPreviewVideo($entitiesArray[0]);

    }

    //  Movies Preview Video
    public function createMoviePreviewVideo(){
      
      $entitiesArray = EntityProvider::getMovieEntities($this->con, null, 1);
    
      if(sizeof($entitiesArray) == 0 ){
        ErrorMessage::show("No Movies to display");
      }

      return $this->createPreviewVideo($entitiesArray[0]);

    }

    // Category Preview Videos
    public function createCategoryPreviewVideo($categoryId){
      
      $entitiesArray = EntityProvider::getEntities($this->con, $categoryId, 1);
    
      if(sizeof($entitiesArray) == 0 ){
        ErrorMessage::show("No TV shows to display");
      }

      return $this->createPreviewVideo($entitiesArray[0]);

    }

    // ************************** createPreviewVideo **************************** //
    // If NUll create random preview if not create a preview for the $entity
    public function createPreviewVideo($entity){
                
      if($entity == NULL){
        $entity = $this->getRandomEntity();
      }   
      
      $id = $entity->getId();
      $name = $entity->getName();
      $preview = $entity->getPreview();
      $thumbnail  = $entity->getThumbnail();

      $videoId = VideoProvider::getEntityVideoForUser($this->con, $id, $this->username);
      $video = new Video($this->con, $videoId);
      
      $isInProgress = $video->isInProgress($this->username);
      $playButtonText = $isInProgress ? " Continue watching" : " Play";

      $seasonEpisode = $video->getSeasonAndEpisode();
      $subHeading = $video->isMovie() ? "" : "<h4>$seasonEpisode</h4>";

      return "<div class='previewContainer'> 
                <img src='$thumbnail' class='previewImage' hidden>  
                <video autoplay muted class='previewVideo' onended='previewEnded()'> 
                  <source src='$preview' type='video/mp4'>
                </video>
                <div class='previewOverlay'>
                  <div class='mainDetails'>
                    <h3>$name</h3>
                    $subHeading
                    <div class='buttons'>
                      <button  onclick='watchVideo($videoId)'><i class='fas fa-play'></i> $playButtonText </button>
                      <button  onclick='volumeToggle(this)' ><i class='fas fa-volume-mute'></i></button>
                    </div>     
                  </div>
                </div>
              </div>";
    }
      
            
    //  Get a random Entity  from the DB          
    private function getRandomEntity(){     
      $entity = EntityProvider::getEntities($this->con, NULL, 1);
      return $entity[0];
    }
  
    public function createEntityPreviewSquare($entity){
      $id= $entity->getId();  
      $thumbnail= $entity->getThumbnail();  
      $name= $entity->getName();  

      return "<a href='entity.php?id=$id'>
                <div class ='previewContainer small'>
                  <img src='$thumbnail' title='$name'>
                </div>
              </a>";
    }
  }

?>