jQuery(document).ready(function($) {
    $('#deleteAllExcerpts').submit(function(event) {
      var confirmar = confirm('¿Estás seguro de que deseas borrar todas las descripciones de los productos de tu sitio?');
      if (!confirmar) {
        event.preventDefault();
      }
    });
  });