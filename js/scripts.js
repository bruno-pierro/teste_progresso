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