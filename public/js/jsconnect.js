$(document).ready(function () {
    // objet qui permet de verifier les inputes de la connection 
    var $identifiant = $('#identifiant'),
        $pwd = $('#password'),
      $erreur2 = $('#erreur2'),
      $input = $('.input'),
      $envoi = $('#submit');

      $identifiant.keyup(function () {
        if ($(this).val().length < 2 ) {
           $erreur2.css({
               color: "red",
             })
           $erreur2.text("L'identifiant est incorrecte");
           $(this).css({
               borderColor: "red",
               color: "red",
             });
            }
            else if ($(this).val().length > 2 ){
              $erreur2.text('');
              $(this).css({
                  borderColor: "green",
                  color: "green",
                });
          
              }
            });
        

          $pwd.keyup(function () {
            if ($(this).val().length < 2 ) {
               $erreur2.css({
                   color: "red",
                 })
               $erreur2.text("Le mot de passe est incorrecte");
               $(this).css({
                   borderColor: "red",
                   color: "red",
                 });
                }
                else if ($(this).val().length > 2 ){
                  $erreur2.text('');
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