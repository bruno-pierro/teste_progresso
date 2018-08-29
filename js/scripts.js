	var x = 1;
	var y = 2;
	let quantidade = 0;
	let valFinal = 0;

	function checa(){

		if($('.questao1').eq(0).val() == "" || $('.questao1').eq(1).val() == "" || $('.questao1').eq(2).val() == ""){
			$('.monta1').after('<tr class="alert alert-danger alert-dismissible fade show" role="alert"><th colspan="4"><center><strong>OPS!</strong> Preencha todos os campos!<button type="button" class="close" data-dismiss="alert" aria-label="Close">    <span aria-hidden="true">&times;</span></button></th></center></tr>')
		}else{
			monta();
		}

	}

	function monta(){

		quantidade = parseInt($('input[name=quantidade'+x+']').val());
		if (valFinal < 30){
			$('tbody tr:last').after('<tr class="monta1"><th><input list="browsers" class="questao'+y+'"><datalist id="browsers"> <option value="Internet Explorer"><option value="Firefox"> <option value="Google Chrome"> <option value="Opera"><option value="Safari"></datalist></th><th><input class="questao'+y+'" type="number" min="1" max="10" name="quantidade'+y+'"></th><th><input type="number" class="questao'+y+'" min="1" max="3" name="Materia"></th><th><button type="button" class="btn btn-secondary bt'+y+'" onclick="checa()">Inserir</button></th></tr>')
			$('.bt'+x+'').prop('disabled', true);
			$('.questao'+x+'').prop('disabled', true);
			x +=1;
			y +=1;


			valFinal += quantidade;
			$('.contador').text('Quantidade de questões:'+valFinal.toString()+'');

		};

	}
//script que monta o preview da imagem 

$(document).ready( function() {
	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
		label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
	});

	$('.btn-file :file').on('fileselect', function(event, label) {

		var input = $(this).parents('.input-group').find(':text'),
		log = label;

		if( input.length ) {
			input.val(log);
		} else {
			if( log ) alert(log);
		}

	});
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#img-upload').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#imgInp").change(function(){
		readURL(this);
	}); 	
});


// função de conversão de imagem

function converte() {

	if (this.files && this.files[0]) {

		var FR= new FileReader();

		FR.addEventListener("load", function(e) {
			document.getElementById("img-upload").src       = e.target.result;
			document.getElementById("base64").value = e.target.result;
		}); 

		FR.readAsDataURL( this.files[0] );
	}

}

document.getElementById("imgInp").addEventListener("change", converte);


function edit(id) {
	var edit_id = id;
	$.ajax({
		method: "POST",
		url: 'edit.php',
		data:{'edit_id':'edit_id'},
		success:function(html) {
			location.href="edit.php?teste="+edit_id+"";
		}

	});
}

function editar(id) {
	var del_id = id;
	$.ajax({
		method: "POST",
		url: 'delete.php',
		data:{'del_id':del_id},
		success:function(html) {
			alert(html);
		}

	});
}

function exclui(id) {
	var del_id = id;
	$.ajax({
		method: "POST",
		url: 'delete.php',
		data:{'del_id':del_id},
		success:function(html) {
			alert(html);
		}

	});
}


function img(id){

	var imagens = id;
	var montagem =  $('#'+imagens).attr('src');
	$('.modalzin').html('<img src='+montagem+' style="width:100%; height:100%">');

}


