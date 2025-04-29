function logar(event){
    //impede o envio normal do formulario
    event.preventDefault();

    var usuario = document.getElementById('usuario').value;
    var senha = document.getElementById('senha').value;

    if(usuario == 'admin' && senha == 'admin'){
        Swal.fire({
            title: 'login realizado!',
            text:'Bem-vindo, ' + usuario + '!',
            icon:'success',
            confirmButtonText: 'OK'
        }).then(() =>{
            setTimeout(() => {
                location.href="./html/home.html";
            },110);
        });
    }else{
        
    }

}