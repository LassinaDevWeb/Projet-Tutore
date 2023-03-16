$(document).ready(function () {
  // objet qui permet de verifier les inputes de la connection 
  var $mini = $('#mini'),
    $max = $('#max'),
    $envoi = $('#submit'),
    $input = $('.input'),
    $erreur2 = $('#erreur2'),
    $erreur1 = $('#erreur1');


  $mini.keyup(function () {
    if ($(this).val() >= $max.val()) {
      $erreur1.css({
        color: "red",
      })
      $erreur1.text('Nombre de participant maximum ou minimum incorrect');
      $(this).css({
        borderColor: "red",
        color: "red",
      });

      $max.css({
        borderColor: "red",
        color: "red",
      })

    }
    else if ($(this).val() <= $max.val()) {
      $erreur1.text('');
      $(this).css({
        borderColor: "green",
        color: "green",
      });

      $max.css({
        borderColor: "green",
        color: "green",
      })
    }
  });

  $max.keyup(function () {
    if ($(this).val() <= $mini.val()) {
      $erreur1.css({
        color: "red",
      })
      $erreur1.text('Nombre de participant maximum ou minimum incorrect');
      $(this).css({
        borderColor: "red",
        color: "red",
      });

      $mini.css({
        borderColor: "red",
        color: "red",
      })

    }
    else if ($(this).val() >= $mini.val()) {
      $erreur1.text('');
      $(this).css({
        borderColor: "green",
        color: "green",
      });

      $mini.css({
        borderColor: "green",
        color: "green",
      })
    }
  });

  $envoi.click(function (e) {

    verifier($input);

    if (verifier($input)) {
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
      return true;
    }
    else {
      $erreur2.text('');

    }
  }
});

