function frmLogin(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const chave = document.getElementById("chave");
    if (usuario.value == "") {
        chave.classList.remove("is-invalid");
        usuario.classList.add("is-invalid");
        usuario.focus();
    } else if (chave.value == "") {
        usuario.classList.remove("is-invalid");
        chave.classList.add("is-invalid");
        chave.focus();
    } else {
        const url = base_url + "Usuarios/validar";
        const frm = document.getElementById("frmLogin");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res.icone == "success") {
                    window.location = base_url + "Configuracao/admin";
                } else {
                    document.getElementById("alerta").classList.remove("d-none");
                    document.getElementById("alerta").innerHTML = res.msg;
                }
            }
        }
    }
}