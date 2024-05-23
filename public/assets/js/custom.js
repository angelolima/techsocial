$(document).ready(function() {

    $("#btn-signin").on('click', function() {
        
        email = $('#email').val();
        password = $('#password').val();

        if(!email && !fnValidaEmail(email)){
            Materialize.toast('Verifique o e-mail informado.', 1500, 'rounded');
            $('#email').focus();
        }
        if(!password){
            Materialize.toast('Informe a senha.', 1500, 'rounded');
            $('#password').focus();
        }

        if(email && password){
            $(this).removeAttr('id');
            $('#login_form').submit();
        }

    });

    $("#btn-signup").on('click', function() {
        
        email = $('#email').val();
        cpf = $('#document').val();
        password = $('#password').val();
        password_retry = $('#password2').val();

        if(!email || !fnValidaEmail(email)){
            Materialize.toast('Verifique o e-mail informado.', 1500, 'rounded');
            $('#email').focus();
        }
        if(!valida_cpf(cpf)){
            Materialize.toast('Verifique o CPF informado.', 1500, 'rounded');
            $('#document').focus();
        }
        if(!password){
            Materialize.toast('Informe a senha.', 1500, 'rounded');
            $('#password').focus();
        }

        if(password != password_retry){
            Materialize.toast('As senhas informadas não conferem.', 1500, 'rounded');
            $('#password2').focus();
        }else{
            $(this).removeAttr('id');
            $('#signup_form').submit();
        }

    });

    $("#btn-update-user").on('click', function() {

        email = $('#email').val();
        cpf = $('#document').val();
        password = $('#password').val();
        password_retry = $('#password2').val();

        if(!email || !fnValidaEmail(email)){
            Materialize.toast('Verifique o e-mail informado.', 1500, 'rounded');
            $('#email').focus();
        }
        if(!valida_cpf(cpf)){
            Materialize.toast('Verifique o CPF informado.', 1500, 'rounded');
            $('#document').focus();
        }
        if(!password){
            Materialize.toast('Informe a senha.', 1500, 'rounded');
            $('#password').focus();
        }

        if(password != password_retry){
            Materialize.toast('As senhas informadas não conferem.', 1500, 'rounded');
            $('#password2').focus();
        }else{
            $(this).removeAttr('id');
            $('#FormX').submit();
        }

    });

    $("#btn-create-order").on('click', function() {

        user_id = $('#user_id').val();
        description = $('#description').val();
        quantity = $('#quantity').val();
        price = $('#price').val();

        if(!user_id){
            Materialize.toast('Informe um cliente.', 1500, 'rounded');
            $('#user_id').focus();
            return false;
        }
        if(!description){
            Materialize.toast('Informe uma descricão do item.', 1500, 'rounded');
            $('#description').focus();
            return false;
        }
        if(!quantity){
            Materialize.toast('Informe a quantidade.', 1500, 'rounded');
            $('#quantity').focus();
            return false;
        }
        if(!price){
            Materialize.toast('Informe o valor.', 1500, 'rounded');
            $('#price').focus();
            return false;
        }
        
        $(this).removeAttr('id');
        $('#FormX').submit();

    });

});
