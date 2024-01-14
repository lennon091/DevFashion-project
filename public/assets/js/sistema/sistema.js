$(document).ready(function() {
	changeListaDesejos();
	adicionarRoupaNoCarrinho();
});

function changeListaDesejos() {
	const SIM = 1;
	const NAO = 2;

	$(".btn_lista_desejos").click(function() {
		let eElementHearth = $(this);
		let iIdRoupa = $(this).data("id");
		let eElementRoupa = $(`#lista_desejo_${iIdRoupa}`);

		if (parseInt(eElementRoupa.val()) === SIM) {
			removerRoupadaListaDeDesejos(iIdRoupa,eElementHearth,eElementRoupa);
		} else if (parseInt(eElementRoupa.val()) === NAO) {
			adicionarRoupaNaListaDeDesejos(iIdRoupa,eElementHearth,eElementRoupa);
		}
	});
}

function adicionarRoupaNoCarrinho() {
	$(".btn_add_roupa").click(function() {
		adicionarRoupa($(this).data("id"));
	});
}

function adicionarRoupaNaListaDeDesejos(iIdRoupa,eElementHearth,eElementRoupa) {
	$.ajax({
		url: "../../cliente/adicionarRoupaNaListaDesejo",
		type: "POST",
		data: {iRpaId:iIdRoupa},
		dataType: "JSON",
		success: function (json) {
			if (json.status) {
				changeRoupaAdicionada(eElementHearth,eElementRoupa,true);
				carregarToast("success","Sucesso",json.msg);
			} else {
				let sMensagem = "<b>Desculpe, ocorreu um erro!</b>";
				if (json.msg) {
					sMensagem = `<b>${json.msg}</b>`;
				}

				carregarToast("warning","Atenção",sMensagem);
			}
		}
	});
}

function removerRoupadaListaDeDesejos(iIdRoupa,eElementHearth,eElementRoupa) {
	$.ajax({
		url: "../../cliente/removerRoupaDaListaDesejo",
		type: "POST",
		data: {iRpaId:iIdRoupa},
		dataType: "JSON",
		success: function (json) {
			if (json.status) {
				changeRoupaAdicionada(eElementHearth,eElementRoupa,false);
				removerDivRoupa(eElementRoupa);
				carregarToast("success","Sucesso",json.msg);
			} else {
				let sMensagem = "<b>Desculpe, ocorreu um erro!</b>";
				if (json.msg) {
					sMensagem = `<b>${json.msg}</b>`;
				}

				carregarToast("warning","Atenção",sMensagem);
			}
		}
	});
}

function changeRoupaAdicionada(eElementButton, eElementRoupa, bMarcar) {
	const HEARTH_CHECK = "<svg xmlns=\"http://www.w3.org/2000/svg\" height=\"22px\" viewBox=\"0 0 512 512\"><style>svg{fill: #009288}</style><path d=\"M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z\"/></svg>";
	const HEART_UNCHECK = "<svg xmlns=\"http://www.w3.org/2000/svg\" height=\"22px\" viewBox=\"0 0 512 512\"><style>svg{fill: #009288}</style><path d=\"M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z\"/></svg>";
	const SIM = 1;
	const NAO = 2;

	if (bMarcar) {
		eElementRoupa.val(SIM);
		eElementButton.find("svg").remove();
		eElementButton.append(HEARTH_CHECK);
	} else {
		eElementRoupa.val(NAO);
		eElementButton.find("svg").remove();
		eElementButton.append(HEART_UNCHECK);
	}
}

function carregarToast(sType, sTitulo, sMensagem) {
	$.toast({
		type: sType,
		title: `<b>${sTitulo}</b>`,
		content: `<b>${sMensagem}</b>`,
		delay: 3000
	});
}

function removerDivRoupa(eElementRoupa) {
	let aPaginaAtual = window.location.href.split("/");
	let sPaginaAtual = aPaginaAtual.pop();


	if (sPaginaAtual === "lista") {
		let eListaDesejos = $("#qtd_lista_desejos");
		let iQuantidade = parseInt(eListaDesejos.val());

		iQuantidade--;
		eListaDesejos.val(iQuantidade);
		eElementRoupa.parent().remove();

		if (iQuantidade === 0) {
			$(".destaques").remove();
			$(".lista-desejos").after(getContentEmptyList());
		}
	}
}

function getContentEmptyList() {
	let sContent = "";
	sContent += "<div class=\"lista-desejos-vazia\"";
	sContent += "<div style='padding-top: 15vh'>";
	sContent += "<svg xmlns=\"http://www.w3.org/2000/svg\" height=\"3em\" viewBox=\"0 0 512 512\"><path d=\"M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z\"/></svg>";
	sContent += "<p style='font-size: 30px'>Você ainda não possui itens salvos na sua Lista de Desejos.</p>";
	sContent += "</div>";
	sContent += "</div>";

	return sContent;
}

function adicionarRoupa(iIdRoupa) {
	$.ajax({
		url: "../../shop/adicionarRoupaCarrinho",
		type: "POST",
		data: {iRpaId:iIdRoupa},
		dataType: "JSON",
		success: function (json) {
			if (json.status) {
				carregarToast("success","Sucesso",json.msg);
				atualizarQuantidadeRoupasNoCarrinho();
			} else {
				let sMensagem = "<b>Desculpe, ocorreu um erro!</b>";
				if (json.msg) {
					sMensagem = `<b>${json.msg}</b>`;
				}

				carregarToast("warning","Atenção",sMensagem);
			}
		}
	});
}

function atualizarQuantidadeRoupasNoCarrinho() {
	$.ajax({
		url: "../../cliente/atualizarQuantidadeRoupasCarrinho",
		type: "POST",
		dataType: "JSON",
		success: function (json) {
			if (json.status) {
				$("#contador_itens_carrinho").text(json.quantidade_roupas);
			}
		}
	});
}