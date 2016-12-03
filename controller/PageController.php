
<?php
class PageController extends Controller{

    
    function view($id){
         $this->loadModele('Post'); // chargement du modele
         $d['page']= $this->Post->findFirst(array(
             'conditions' =>array ('id' =>$id, 'type' =>'page' )
         ));
         
    if(empty($d['page'])){
//        die ('errur');
            $this->e404('Page introuvable');
    } 
          $d['pages']= $this->Post->find(array(
             'conditions' =>array ('type' =>'page' )));
        $this->set($d);
    
        
         
         
             
}

    }
    

     
    


