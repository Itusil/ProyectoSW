$(document).ready(function(){
  $("#botINS").click(function(){
	let myForm = document.getElementById('fquestion');
	let formData = new FormData(myForm);
	$.ajax({
			url: 'AddQuestionWithImageAJAX.php',
			type: 'POST',
			dataType: "html",
			data: formData,
			contentType: false,
			processData: false,
			success:function(datos){
				$('#pregAnadida').fadeIn().html(datos);},
			cache : false,
			error:function(){
				$('#pregAnadida').fadeIn().html('<p class="error"><strong>El servidor parece que no responde</p>');
	}});
  });
});