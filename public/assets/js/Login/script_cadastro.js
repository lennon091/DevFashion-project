// src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
src = "https://code.jquery.com/jquery-3.0.0.min.js"

const nome = document.getElementById('nome')
const cpf = document.getElementById('cpf').value
const email = document.getElementById('email').value
const senha = document.getElementById('senha').value
const confirmarSenha = document.getElementById('confirmarSenha').value
const dataNascimento = document.getElementById('dataNascimento').value
const sexo = document.getElementById('sexo').value
const cep = document.getElementById('cep').value
const logradouro = document.getElementById('logradouro').value
const numero = document.getElementById('numero').value
const bairro = document.getElementById('bairro').value
const uf = document.getElementById('uf').value
const complemento = document.getElementById('complemento').value
const telefone = document.getElementById('telefone').value
let numeroCpf = document.getElementById('cpf')
$("#cep").blur(function () {
    var cep = this.value.replace(/[^0-9]/, "");

    if (cep.length !== 8) {
        $("#cepErr").html("<font color='red'>CEP inválido </font>");
    } else {
        $("#cepErr").html("");
        var url = "https://viacep.com.br/ws/" + cep + "/json/";

        $.getJSON(url, function (dadosRetorno) {
            try {
                $("#logradouro").val(dadosRetorno.logradouro);
                $("#bairro").val(dadosRetorno.bairro);
                $("#cidade").val(dadosRetorno.localidade);
                $("#uf").val(dadosRetorno.uf);
            } catch (ex) {
            }
        });
    }
});

const inputCpf = document.getElementById('cpf')
inputCpf.addEventListener('keypress', () => {
    let inputLenght = inputCpf.value.length
    if (inputLenght === 3 || inputLenght === 7) {
        inputCpf.value += '.'
    } else if (inputLenght === 11) {
        inputCpf.value += '-'
    }
})

let emailCorreto = false

function validacaoEmail(field) {
    usuario = field.value.substring(0, field.value.indexOf("@"));
    dominio = field.value.substring(field.value.indexOf("@") + 1, field.value.length);

    if ((usuario.length >= 1) &&
        (dominio.length >= 3) &&
        (usuario.search("@") === -1) &&
        (dominio.search("@") === -1) &&
        (usuario.search(" ") === -1) &&
        (dominio.search(" ") === -1) &&
        (dominio.search(".") !== -1) &&
        (dominio.indexOf(".") >= 1) &&
        (dominio.lastIndexOf(".") < dominio.length - 1)) {
        emailCorreto = true
        return true
    } else {
        document.getElementById("msgemail").innerHTML = "<font color='red'>E-mail inválido </font>";
        return false
    }
}

function validarSenha() {
    if (document.getElementById("senha").value !== document.getElementById("confirmarSenha").value) {
        document.getElementById("senhaErr").innerHTML = "<font color='red'>Senhas incoerentes</font>"
        return false
    } else {
        document.getElementById("senhaErr").innerHTML = ""
        return true
    }
}

function TestaCPF(cpf) {
    let Soma;
    let Resto;
    Soma = 0;
    if (!(cpf === "00000000000" ||
        cpf === "11111111111" ||
        cpf === "22222222222" ||
        cpf === "33333333333" ||
        cpf === "44444444444" ||
        cpf === "55555555555" ||
        cpf === "66666666666" ||
        cpf === "77777777777" ||
        cpf === "88888888888" ||
        cpf === "99999999999")) {
        for (let i = 1; i <= 9; i++) Soma = Soma + parseInt(cpf.substring(i - 1, i)) * (11 - i);
        Resto = (Soma * 10) % 11;
        if ((Resto === 10) || (Resto === 11)) Resto = 0;
        if (Resto !== parseInt(cpf.substring(9, 10))) {
            document.getElementById("msgCpf").innerHTML = "<font color='red'>CPF inválido </font>"
            return false;
        }
        Soma = 0;
        for (let i = 1; i <= 10; i++) Soma = Soma + parseInt(cpf.substring(i - 1, i)) * (12 - i);
        Resto = (Soma * 10) % 11;
        if ((Resto === 10) || (Resto === 11)) Resto = 0;
        if (Resto !== parseInt(cpf.substring(10, 11))) {
            document.getElementById("msgCpf").innerHTML = "<font color='red'>CPF inválido </font>"
            return false;
        }
        document.getElementById("msgCpf").innerHTML = "";
        return true;
    } else {
        document.getElementById("msgCpf").innerHTML = "<font color='red'>CPF inválido </font>"
        return false;
    }

}
function validarForm(){
    if (TestaCPF(numeroCpf.value.replaceAll('.', '').replace('-', '')) &&
        validarSenha() &&
        validacaoEmail(email)){
        document.getElementById("cadastro").submit()
        return true
    }else{
        alert("REVISE OS DADOS PREENCHIDOS")
        return false
    }
}
function atualizarDados(){
    if (validarSenha()){
        document.getElementById("formulario").submit()
        return true
    }else{
        alert("ALTERE SUA SENHA")
        return false
    }
}
