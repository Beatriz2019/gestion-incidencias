$(function() {
	//cuando se detecte un cambio en select-project, llamamos a la función onSelectProjectChange
	$('#select-project').on('change', onSelectProjectChange);
});

function onSelectProjectChange() {
	//capturamos el id del proyecto seleccionado por el usuario
	//$(this) es el proyecto seleccionado, o sea es el objeto de cuando se llama a
	//esta función
	var project_id = $(this).val();
	//alert($project_id);

	if (! project_id) { //si project_id está vacío
      $('#select-level').html('<option value="">Seleccione Nivel</option>');
      return; 
    }
	//Ajax
	//hacemnos una petición ajax para buscar los niveles de un proyecto
    //llamamos a un get de jquery y le pasamos la ruta de la que quermos hacer la petición
    //escribimos una función de collback que es la que se va a llamar cuando la petición 
    // haya terminado
	//$.get('/gestion-incidencias/public/api/proyecto/1/niveles', function(data) {
	$.get('/gestion-incidencias/public/api/proyecto/'+project_id+'/niveles', function(data) {
         //console.log(data);

         var html_select = '<option value="">Seleccione Nivel</option>';
         for (var i=0; i<data.length; ++i)
             // console.log(data[i]);
          //este for crea un objeto por cada nivel con todos los datos de la db para cada uno
          //esto lo hacemos para formar un html con estos datos
          
          //concatenamos más opciones para mostrar en el select
          html_select += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
          //console.log(html_select);

           //con esto: $('#select-level'), seleccionamos el nivel, luego le indocamos
           //qué html queremos que contenga
          $('#select-level').html(html_select);
       });
}