

    function check(input) {
      if (input.value != document.getElementById('password').value) {
        input.setCustomValidity('Les deux password ne correspondent pas.');
      } else {
        // le champ est valide : on réinitialise le message d'erreur
        input.setCustomValidity('');
      }
    }