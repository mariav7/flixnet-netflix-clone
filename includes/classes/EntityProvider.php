<?php
// Get all  Entities with the same categoryId  
// or if categoryId = Null get all Entities ordered at random 
// create Entity object for every row and Stock All the entities in an Array '$result'    
  class EntityProvider {

    public static function getEntities($con, $categoryId, $limit){
        
      $sql = "SELECT * FROM entities ";

      if( $categoryId != NULL ){  
        $sql .="WHERE categoryId=:categoryId ";  
      }
        
      $sql .= "ORDER BY RAND() LIMIT :limit";

      $query = $con->prepare($sql);

      if( $categoryId != NULL ){
        $query->bindValue(":categoryId", $categoryId);
      }
        
      $query->bindValue(":limit", $limit, PDO::PARAM_INT);
      $query->execute();

      $result = array();
      while( $row = $query->fetch(PDO::FETCH_ASSOC)){
        $result[] = new Entity($con, $row);
      }

      return $result;   
    }

    public static function getTVShowEntities($con, $categoryId, $limit){
        
      $sql = "SELECT DISTINCT(entities.id) FROM `entities`
              INNER JOIN videos
              ON entities.id = videos.entityId
              WHERE videos.isMovie = 0 ";

      if($categoryId != NULL){         
        $sql .="AND categoryId=:categoryId ";       
      }
        
      $sql .= "ORDER BY RAND() LIMIT :limit";

      $query = $con->prepare($sql);

      if($categoryId != NULL ){
        $query->bindValue(":categoryId", $categoryId);
      }
      
      $query->bindValue(":limit", $limit, PDO::PARAM_INT);
      $query->execute();

      $result = array();
      while($row = $query->fetch(PDO::FETCH_ASSOC)){       
        $result[] = new Entity($con, $row["id"]);
      }

      return $result;  
    }

    public static function getMovieEntities($con, $categoryId, $limit){
        
      $sql = "SELECT DISTINCT(entities.id) FROM `entities`
              INNER JOIN videos
              ON entities.id = videos.entityId
              WHERE videos.isMovie = 1 ";

      if($categoryId != NULL){
          
        $sql .="AND categoryId=:categoryId ";
          
      }
          
      $sql .= "ORDER BY RAND() LIMIT :limit";

      $query = $con->prepare($sql);

      if( $categoryId != NULL ){
        $query->bindValue(":categoryId", $categoryId);
      }
          
      $query->bindValue(":limit", $limit, PDO::PARAM_INT);
      $query->execute();

      $result = array();
      while($row = $query->fetch(PDO::FETCH_ASSOC)){ 
        $result[] = new Entity($con , $row["id"]);
      }

      return $result ;   
    }

    public static function getSearchEntities($con, $term){
        
      $sql = "SELECT * FROM entities WHERE name LIKE CONCAT('%', :term, '%') LIMIT 30";

      $query = $con->prepare($sql);

      $query->bindValue(":term", $term);
      $query->execute();

      $result = array();
      while($row = $query->fetch(PDO::FETCH_ASSOC)){ 
        $result[] = new Entity($con , $row);
      }

      return $result ;   
    }

  }
          
?>