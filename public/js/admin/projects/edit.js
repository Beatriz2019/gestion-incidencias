$(function(){

	//alert('script utilizado');

	//$('#select').on('click', func);
	//toma y¿un selector que está en la página y le asigna una función

	$('[data-category]').on('click', editCategoryModal);
	$('[data-level]').on('click', editLevelModal);
});

function editCategoryModal() {
	//id
    //A través de this podemos acceder al elemento al cual se ha hecho clic
	var category_id = $(this).data('category');
	//alert(category_id);
	$('#category_id').val(category_id); 
	//le asignamos al id category_id el valor de la variable category_id
	
	//name
	//$(this) es el botón que está en edit.blade.php en views/admin/projects
    var category_name = $(this).parent().prev().text();
    //alert(name);
    $('#category_name').val(category_name); 
	//show
	$('#modalEditCategory').modal('show');
	//modalEditCategory s el id del modal de categoría
	//modalEditCategory es el id de jquery, luego llamamos a la funcipón modal pasándole como
	//parámetro show para que lo muestre

}

function editLevelModal() {
	//id
    //A través de this podemos acceder al elemento al cual se ha hecho clic
	var level_id = $(this).data('level');
	//alert(category_id);
	$('#level_id').val(level_id); 
	//le asignamos al id level_id el valor de la variable level_id
	
	//name
	//$(this) es el botón que está en edit.blade.php en views/admin/projects
    var level_name = $(this).parent().prev().text();
    //alert(name);
    $('#level_name').val(level_name); 
	//show
	$('#modalEditLevel').modal('show');
	//modalEditCategory s el id del modal de categoría
	//modalEditCategory es el id de jquery, luego llamamos a la funcipón modal pasándole como
	//parámetro show para que lo muestre

}