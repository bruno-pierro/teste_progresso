var x = 1;
var y = 2;
let quantidade = 0;
let valFinal = 0;
let controle = 0;


	// var itm = $('#grade_questoes tr');



	function checa(){

		// if($('.questao1:last').eq(0).val() == "" || $('.questao1:last').eq(1).val() == "" || $('.questao1:last').eq(2).val() == ""){
		// 	$('.monta'+x+':last').after('<tr class="alert alert-danger alert-dismissible fade show" role="alert"><th colspan="4"><center><strong>OPS!</strong> Preencha todos os campos!<button type="button" class="close" data-dismiss="alert" aria-label="Close">    <span aria-hidden="true">&times;</span></button></th></center></tr>')
		// }
		if($('.monta'+x+' select').val() == null ||$('.monta'+x+' input:first').val() == "" || $('.monta'+x+' input:last').val() == ""){
			$('.monta'+x+':last').after('<tr class="alert alert-danger alert-dismissible fade show" role="alert"><th colspan="4"><center><strong>OPS!</strong> Preencha todos os campos!<button type="button" class="close" data-dismiss="alert" aria-label="Close">    <span aria-hidden="true">&times;</span></button></th></center></tr>')
		}else if($('.monta'+x+' input:first').val() > 10){
			$('.monta'+x+':last').after('<tr class="alert alert-danger alert-dismissible fade show" role="alert"><th colspan="4"><center><strong>OPS!</strong> Número máximo de questões excedido: MAX 10<button type="button" class="close" data-dismiss="alert" aria-label="Close">    <span aria-hidden="true">&times;</span></button></th></center></tr>')
		}else{
			var q_id = 0;
			// var inputQuestao = $('.questao1').eq(0).val();
			var inputQuestao = $('.questao1').eq(0).val();

			q_id = $('#materias').find('option[value="' +inputQuestao + '"]').attr('id');
			
			monta();
		}

	}

	function monta(){

		quantidade = parseInt($('.monta'+x+' input[name=quantidade'+x+']').val());

		controle = quantidade + valFinal;


		


		if (controle < 30){
			// $('tbody tr:last').after('<tr class="monta1 questao'+y+'" "><th><select id="materias" class="questao1" onchange="select_materia_prova(this)">'<?php include("materia_prova.php")?>'</select></th><th><input class="questao'+y+'"  type="number" min="1" max="10" name="quantidade'+y+'"  style="width:100%"></th><th><input type="number" class="questao'+y+'" min="1" max="3" name="Materia"  style="width:100%"></th><th><button type="button" class="btn btn-secondary bt'+y+'" onclick="checa()">Inserir</button></th></tr>')
			// var cln = itm.clone(true);


			// $('#grade_questoes tr:last').after(cln)

			$('#grade_questoes tr:last').clone().appendTo('#grade_questoes');


			$('.monta'+x+' ').eq(1).addClass('monta'+y+'')
			$('.monta'+x+' ').eq(1).removeClass('monta'+x+' ');
			
			$('input[name=quantidade'+x+']:last').attr('name','quantidade'+y+'');
			$('input[name=quantidade'+x+']').attr('name','quantidade'+y+'');

			$('.monta'+x+' select').prop('disabled', true);
			$('.monta'+x+' input').prop('disabled', true);
			$('.monta'+x+' button').prop('disabled', true);
			$('.monta'+y+' input').val('');

			x +=1;
			y +=1;


			valFinal += quantidade;
			$('.contador').text('Quantidade de questões:'+valFinal.toString()+'');

			if (valFinal > 20){
				var max = 30 - valFinal;
				$('.monta'+x+' input:first').attr('max', max);
			}

		}else{

			$('.monta'+x+' select').prop('disabled', true);
			$('.monta'+x+' input').prop('disabled', true);
			$('.monta'+x+' button').prop('disabled', true);

			x +=1;
			y +=1;


			valFinal += quantidade;
			$('.contador').text('Quantidade de questões:'+valFinal.toString()+'');
		};

	}
	function gera(){
		if (valFinal < 30) {
			alert('Não foi inserida a quantidade total de questões para a prova! \nTente Novamente\n\nTotal de questões inseridas: '+valFinal+'');
		}
		else {

			var prova = '{ "prova": { "questoes": [';

			$('.ddlMaterias').each(function (index, item) {
				
				var materia = $(this).val();
				//var materia = $("#materias option:selected");
				
				var ddlQuantidade = $($('.ddlQtd')[index]);

				//console.log(ddlQuantidade);
				
				var qtd = $(ddlQuantidade).val()

				var ddlDificuldade = $($('.ddlDificuldade')[index]);
				
				var dificuldade = $(ddlDificuldade).val()

				prova += '{ "materia": "' + materia + '", "qtd": ' + qtd + ', "dificuldade": "' + dificuldade + '" }' 
				+ (index + 1 != $('.ddlMaterias').length ? "," : "");

			});

			prova += ' ] } }';
			
			//console.log(prova);
			
			$.ajax({
				method: "POST",
				url: 'exportar_prova.php',
				data: { "data": JSON.stringify(prova) },
				success: function(html) {
					$('form').append('<a href="prova-teste.pdf">PDF GERADO COM SUCESSO</a>');
				}

			});
			
		}
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
		method: "GET",
		url: 'edit.php',
		data:{'edit_id':edit_id},
		success:function(html) {
			location.href="edit.php?id_edicao="+edit_id+"";
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


function select_materia(x){
	var id_materia = x[x.selectedIndex].id;
	console.log(id_materia);
	$.ajax({
		method: "POST",
		url: 'change.php',
		data:{'change':id_materia},
		success:function(html) {
			$('#materias_select').prop('disabled',false);
			$('#materias_select').html(html);

		}

	});
}
var id_materia_selecionada ;
function select_materia_prova(x){
	id_materia_selecionada = x[x.selectedIndex].id;
	$("#"+id_materia_selecionada+"").attr('disabled');
}

function checaID(){
	$('#btnTipo').attr('disabled',false);
}