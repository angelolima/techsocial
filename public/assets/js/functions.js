/*
 *
 * @param {type} email
 * @returns {Boolean}
 */
function fnValidaEmail(email) {

    var jSintaxe, jArroba, jPontos;
    var ExpReg = new RegExp('[^a-zA-Z0-9\.@_-]', 'g');
    jSintaxe = !ExpReg.test(email);
    if (jSintaxe == false) {
        return false;
    }
    jPontos = (email.indexOf('.') > 0) && !(email.indexOf('..') > 0);
    if (jPontos == false) {
        return false;
    }
    jArroba = (email.indexOf('@') > 0) && (email.indexOf('@') == email.lastIndexOf('@'));
    if (jArroba == false) {
        return false;
    }
    return (jSintaxe && jPontos && jArroba);

}

/*
 *
 * @param {type} cpf
 * @returns {Boolean}
 */
function valida_cpf(cpf) {

    cpf = cpf.replace(/\./g, "");
    cpf = cpf.replace(/\-/g, "");
    cpf = cpf.replace(/\_/g, "");

    if (cpf.length != 11) {
        var result = false;
    }
    ;

    pri = eval(cpf.substring(0, 3));
    seg = eval(cpf.substring(4, 7));
    ter = eval(cpf.substring(8, 11));
    qua = eval(cpf.substring(12, 14));

    var i;
    var numero;

    numero = (pri + seg + ter + qua);

    c = cpf.substr(0, 9);

    var dv = cpf.substr(9, 2);

    var d1 = 0;

    for (i = 0; i < 9; i++) {
        d1 += c.charAt(i) * (10 - i);
    }

    if (d1 == 0) {
        var result = false;
    }

    d1 = 11 - (d1 % 11);
    if (d1 > 9)
        d1 = 0;

    if (dv.charAt(0) != d1) {
        var result = false;
    }

    d1 *= 2;
    for (i = 0; i < 9; i++) {
        d1 += c.charAt(i) * (11 - i);
    }

    d1 = 11 - (d1 % 11);
    if (d1 > 9)
        d1 = 0;

    if (dv.charAt(1) != d1) {
        var result = false;
    }

    if (result == false) {
        return false;
    } else {
        return true;
    }


}
/*
 *
 * @param {type} str
 * @param {type} sub
 * @returns {r|String}
 */
function remove(str, sub) {
    i = str.indexOf(sub);
    r = "";
    if (i == -1)
        return str;
    r += str.substring(0, i) + remove(str.substring(i + sub.length), sub);
    return r;
}


function mascara(o, f) {
    v_obj = o;
    v_fun = f;
    setTimeout("execmascara()", 1);
}

function execmascara() {
    v_obj.value = v_fun(v_obj.value);
}

function leech(v) {
    v = v.replace(/o/gi, "0");
    v = v.replace(/i/gi, "1");
    v = v.replace(/z/gi, "2");
    v = v.replace(/e/gi, "3");
    v = v.replace(/a/gi, "4");
    v = v.replace(/s/gi, "5");
    v = v.replace(/t/gi, "7");
    return v;
}
function soNumeros(v) {
    return v.replace(/\D/g, "");
}
function maskMonetario(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/(\d+)(\d{2})$/, "$1,$2");
    v = v.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
    return "R$" + v;
}
function maskcnpj(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/^(\d{2})(\d)/, "$1.$2");
    v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
    v = v.replace(/\.(\d{3})(\d)/, ".$1/$2");
    v = v.replace(/(\d{4})(\d)/, "$1-$2");
    return v;
}
function maskdata(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/(\d{2})(\d)/, "$1/$2");
    v = v.replace(/(\d{2})(\d)/, "$1/$2");
    return v;
}
function masktime(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/(\d{2})(\d)/, "$1:$2");
    v = v.replace(/(\d{2})(\d)/, "$1:$2");
    return v;
}
function masktelefone(v) {
    v = v.replace(/\D/g, "");
    //v = v.replace(/^(\d\d)(\d)/g, "($1) $2");
    v = v.replace(/^(\d\d)(\d)/g, "$2");
    v = v.replace(/(\d{4})(\d)/, "$2");
    return v;
}
function maskcelular(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/^(\d\d)(\d)/g, "($1) $2");
    v = v.replace(/(\d{5})(\d)/, "$1-$2");
    return v;
}
function maskhora(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/^(\d{2})(\d)/, "$1:$2");
    return v
}
function maskcpf(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/(\d{3})(\d)/, "$1.$2");
    v = v.replace(/(\d{3})(\d)/, "$1.$2");
    //de novo (para o segundo bloco de numeros)
    v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
    return v;
}
function maskcep(v) {
    v = v.replace(/D/g, "");
    v = v.replace(/^(\d{5})(\d)/, "$1-$2");
    return v;
}
function romanos(v) {
    v = v.toUpperCase();
    v = v.replace(/[^IVXLCDM]/g, "");
    while (v.replace(/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/, "") != "");
    v = v.replace(/.$/, "");
    return v;
}

function masksite(v) {
    v = v.replace(/^http:\/\/?/, "");
    dominio = v;
    caminho = "";
    if (v.indexOf("/") > -1)
        dominio = v.split("/")[0];
    caminho = v.replace(/[^\/]*/, "");
    dominio = dominio.replace(/[^\w\.\+-:@]/g, "");
    caminho = caminho.replace(/[^\w\d\+-@:\?&=%\(\)\.]/g, "");
    caminho = caminho.replace(/([\?&])=/, "$1");
    if (caminho != "")
        dominio = dominio.replace(/\.+$/, "");
    v = "http://" + dominio + caminho;
    return v;
}
