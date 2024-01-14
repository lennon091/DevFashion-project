$(document).ready(function() {
	const removeProductButtons = document.getElementsByClassName("remove-product-button")
	for (var i = 0; i < removeProductButtons.length; i++){
		removeProductButtons [i]. addEventListener("click", removerRoupaCarrinho);
	}


});

function removeProduct(event){
	removerRoupaCarrinho(event.target.parentElement.parentElement.id);

}

function updateTotal (){
	let totalAmount = 0;
	const cartProducts = document.getElementsByClassName("cart-product");

	for (var i = 0; i < cartProducts.length; i++) {
		const productPrice = cartProducts [i].getElementsByClassName("cart-product-price")[0].innerText.replace("R$","").replace(",",".");
		const productQuantity = cartProducts [i].getElementsByClassName("product-qtd-input")[0].value;

		totalAmount += productPrice * productQuantity;
	}

	totalAmount = totalAmount.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

	document.querySelector(".cart-total-container span").innerText = totalAmount
}

function removerRoupaCarrinho(event) {
	let iIdRoupa = event.target.parentElement.parentElement.id;

	$.ajax({
		url: "../../shop/removerRoupaCarrinho",
		type: "POST",
		data: {iRpaId:iIdRoupa},
		dataType: "JSON",
		success: function (json) {
			if (json.status) {
				event.target.parentElement.parentElement.remove();
				let eContadorCarrinho = $("#contador_itens_carrinho");
				let iQuantidadeRoupa = parseInt(eContadorCarrinho.text());
				iQuantidadeRoupa--;

				if (iQuantidadeRoupa === 0) {
					$(".purchase-button").attr("disabled",true);
				}

				eContadorCarrinho.text(iQuantidadeRoupa);
				updateTotal();
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