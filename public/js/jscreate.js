$(document).ready(function () {
 // objet qui permet de verifier les inputes de la connection 
    var $titre = $('#titre'),
    $contenu = $('#contenu'),
    $envoi = $('#submit'),
    $prerequis = $('#prerequis'),
    $input = $('.input'),
    $objectif = $('#objectif'),
    $erreur2 = $('#erreur2'),
    $erreur1 = $('#erreur1'); 



    $titre.keyup(function () {
        if ($(this).val().length > 50 ) {
           $erreur1.css({
               color: "red",
             })
           $erreur1.text('Le titre ne doit pas dépasser 50 caractères !');
           $(this).css({
               borderColor: "red",
               color: "red",
             });
       
            
        }
        else if ($(this).val().length < 50 ){
           $erreur1.text('');
           $(this).css({
               borderColor: "green",
               color: "green",
             });
       
        }
           });

           $prerequis.keyup(function () {
            if ($(this).val().length > 50 ) {
               $erreur1.css({
                   color: "red",
                 })
               $erreur1.text('Le prerequis ne doit pas dépasser 50 caractères !');
               $(this).css({
                   borderColor: "red",
                   color: "red",
                 });
           
                
            }
            else if ($(this).val().length < 50 ){
               $erreur1.text('');
               $(this).css({
                   borderColor: "green",
                   color: "green",
                 });
           
            }
               });

               $objectif.keyup(function () {
                if ($(this).val().length > 50 ) {
                   $erreur1.css({
                       color: "red",
                     })
                   $erreur1.text("L'objectif ne doit pas dépasser 50 caractères !");
                   $(this).css({
                       borderColor: "red",
                       color: "red",
                     });
               
                    
                }
                else if ($(this).val().length < 50 ){
                   $erreur1.text('');
                   $(this).css({
                       borderColor: "green",
                       color: "green",
                     });
               
                }
                   });

                   $contenu.keyup(function () {
                    if ($(this).val().length > 255 ) {
                       $erreur1.css({
                           color: "red",
                         })
                       $erreur1.text("Le contenu ne doit pas dépasser 255 caractères !");
                       $(this).css({
                           borderColor: "red",
                           color: "red",
                         });
                   
                        
                    }
                    else if ($(this).val().length < 255 ){
                       $erreur1.text('');
                       $(this).css({
                           borderColor: "green",
                           color: "green",
                         });
                   
                    }
                       });


                   $envoi.click(function (e) {
     
                    verifier($input);
                   
                    
                    if(verifier($input)){
                  e.preventDefault();
                }
                  });
                
                  // la fonction verifier , verifie si un champs est vide.
                  function verifier(input) {
                    if (input.val() == "") {
                        $erreur2.css({
                            color: "red",
                          })
                      $erreur2.text('champs vides');
                
                      input.css({
                        borderColor: 'red',
                        color: 'red'
                      });
                      return true ; 
                    }
                    else {
                      $erreur2.text('');
            
                    }
                  }
            

});