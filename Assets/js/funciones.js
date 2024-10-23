let tblUsuarios, tblEst, tblGenero, tblAutor, tblEditora, tblLivros, tblPrestar;
document.addEventListener("DOMContentLoaded", function(){
    document.querySelector("#modalPass").addEventListener("click", function () {
        document.querySelector('#frmCambiarPass').reset();
        $('#cambiarClave').modal('show');
    });
    const language = {
        "decimal": "",
        "emptyTable": "Não existem informações",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
        "infoEmpty": "Mostrando 0 to 0 of 0 registros",
        "infoFiltered": "(Filtrado de _MAX_  do total de registros)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Registros",
        "loadingRecords": "Carregando...",
        "processing": "Procesando...",
        "search": "Pesquisar:",
        "zeroRecords": "Nenhum resultado encontrado",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Próximo",
            "previous": "Anterior"
        }

    }
    const  buttons = [{
                //Botón para Excel
                extend: 'excel',
                footer: true,
                title: 'Arquivo',
                filename: 'Exportar_excel',

                //Aquí es donde generas el botón personalizado
                text: '<button class="btn btn-success"><i class="fa fa-file-excel-o"></i></button>'
            },
            //Botón para PDF
            {
                extend: 'pdf',
                footer: true,
                title: 'Arquivo PDF',
                filename: 'relatório',
                text: '<button class="btn btn-danger"><i class="fa fa-file-pdf-o"></i></button>'
            },
            //Botón para print
            {
                extend: 'print',
                footer: true,
                title: 'Relatórios',
                filename: 'Exportar_impressão',
                text: '<button class="btn btn-info"><i class="fa fa-print"></i></button>'
            }
        ]
            
    tblUsuarios = $('#tblUsuarios').DataTable({
        ajax: {
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        },
        columns: [
            {'data' : 'id'},
            {'data': 'usuario'},
            {'data': 'nome'},
            {'data': 'estado'},
            {'data': 'acciones'}
        ],
        responsive: true,
        bDestroy: true,
        iDisplayLength: 10,
        order: [
            [0, "desc"]
        ],
        language,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons
    });
    //Fin de la tabla usuarios
    tblEst = $('#tblEst').DataTable({
        ajax: {
            url: base_url + "Estudantes/listar",
            dataSrc: ''
        },
        columns: [{'data': 'id'},
            {'data': 'codigo'},
            {'data': 'dni'},
            {'data': 'nome'},
            {'data':'turma'},
            {'data': 'endereco'},
            {'data': 'telefone'},
            {'data': 'estado'},
            {'data': 'acciones'}
        ],
        language,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons
    });
    //Fin de la tabla Estudantes
    tblGenero = $('#tblGenero').DataTable({
        ajax: {
            url: base_url + "Genero/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'genero'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ],
        language,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons
    });
    //Fin de la tabla Generos
    tblAutor = $('#tblAutor').DataTable({
        ajax: {
            url: base_url + "Autor/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'imagem'
            },
            {
                'data': 'autor'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ],
        language,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons
    });
    //Fin de la tabla Autor
    tblEditora= $('#tblEditora').DataTable({
        ajax: {
            url: base_url + "Editora/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'editora'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ],
        language,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons
    });
    //Fin de la tabla editora
    tblLivros = $('#tblLivros').DataTable({
        ajax: {
            url: base_url + "Livros/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'titulo'
            },
            {
                'data': 'quantidade'
            },
            
            {
                'data': 'autor'
            },
            {
                'data': 'autor'
            },
            {
                'data': 'editora'
            },
            {
                'data': 'foto'
            },
            {
                'data': 'descricao'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ],
        language,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons
    });
    //fin Livros
    tblPrestar = $('#tblPrestar').DataTable({
        ajax: {
            url: base_url + "Emprestimo/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'titulo'
            },
            {
                'data': 'nome'
            },
            {
                'data': 'data_emprestimo'
            },

            {
                'data': 'data_devolucao'
            },
            {
                'data': 'quantidade'
            },
            {
                'data': 'observacao'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ],
        language,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons,
        "resonsieve": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [
            [0, "desc"]
        ]
    });
    $('.estudante').select2({
        placeholder: 'Buscar Estudante',
        minimumInputLength: 2,
        ajax: {
            url: base_url + 'Estudantes/buscarEstudante',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    est: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    $('.livro').select2({
        placeholder: 'Procurar livro',
            minimumInputLength: 2,
            ajax: {
                url: base_url + 'Livros/buscarLivro',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        lb: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
    });
    $('.autor').select2({
        placeholder: 'Procurar Autor',
        minimumInputLength: 2,
        ajax: {
            url: base_url + 'Autor/buscarAutor',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    $('.editora').select2({
        placeholder: 'Procurar Editora',
        minimumInputLength: 2,
        ajax: {
            url: base_url + 'Editora/buscarEditora',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    $('.genero').select2({
        placeholder: 'Procurar Gênero',
        minimumInputLength: 2,
        ajax: {
            url: base_url + 'Genero/buscarGenero',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    if (document.getElementById('nome_estudante')) {
        const http = new XMLHttpRequest();
        const url = base_url + 'Configuracao/verificar';
        http.open("GET", url);
        http.send();
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                let html = '';
                res.forEach(row => {
                    html += `
                    <a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-user-o fa-stack-1x fa-inverse"></i></span></span>
                        <div>
                            <p class="app-notification__message" id="nome_estudante">${row.nome}</p>
                            <p class="app-notification__meta" id="fecha_entrega">${row.fecha_devolucao}</p>
                        </div>
                    </a>
                    `;
                });
                document.getElementById('nome_estudante').innerHTML = html;
            }
        }
    }
})

function frmUsuario() {
    document.getElementById("title").textContent = "Novo Usuário";
    document.getElementById("btnAccion").textContent = "Cadastrar";
    document.getElementById("chaves").classList.remove("d-none");
    document.getElementById("frmUsuario").reset();
    document.getElementById("id").value = "";
    $("#novo_usuario").modal("show");
}
function registrarUser(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const nome = document.getElementById("nome");
    const chave = document.getElementById("chave");
    const confirmar = document.getElementById("confirmar");
    if (usuario.value == "" || nome.value == "") {
        alertas('Todos os campos são obrigatórios', 'warning');
    } else {
        const url = base_url + "Usuarios/registrar";
        const frm = document.getElementById("frmUsuario");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#novo_usuario").modal("hide");
                frm.reset();
                tblUsuarios.ajax.reload();
                alertas(res.msg, res.icone);
            }
        }
    }
}
function btnEditarUser(id) {
    document.getElementById("title").textContent = "Atualizar usuário";
    document.getElementById("btnAccion").textContent = "Alterar";
    const url = base_url + "Usuarios/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("usuario").value = res.usuario;
            document.getElementById("nome").value = res.nome;
            document.getElementById("chaves").classList.add("d-none");
            $("#novo_usuario").modal("show");
        }
    }
}
function btnEliminarUser(id) {
    Swal.fire({
        title: 'Deseja realmente eliminar este usuário?',
        text: "O usuário não será excluído permanentemente, apenas mudará o status para inativo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!',
        cancelButtonText: 'Não'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblUsuarios.ajax.reload();
                    alertas(res.msg, res.icone);
                }
            }
            
        }
    })
}
function btnReingresarUser(id) {
    Swal.fire({
        title: 'Deseja realmente reingresar este usuário?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!',
        cancelButtonText: 'Não'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblUsuarios.ajax.reload();
                    alertas(res.msg, res.icone);
                }
            }

        }
    })
}
//Fin Usuarios
function frmEstudante() {
    document.getElementById("title").textContent = "Novo estudante";
    document.getElementById("btnAccion").textContent = "Cadastrar";
    document.getElementById("frmEstudante").reset();
    document.getElementById("id").value = "";
    $("#novoEstudante").modal("show");
}

function registrarEstudante(e) {
    e.preventDefault();
    const codigo = document.getElementById("codigo");
    const dni = document.getElementById("dni");
    const nome = document.getElementById("nome");
    const turma = document.getElementById("turma");
    const telefone = document.getElementById("telefone");
    const endereco = document.getElementById("endereco");
    if (codigo.value == "" || dni.value == "" || nome.value == ""
    || telefone.value == "" || endereco.value == "" || turma.value == "") {
        alertas('Todos os campos são obrigatórios', 'warning');
    } else {
        const url = base_url + "Estudantes/registrar";
        const frm = document.getElementById("frmEstudante");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#novoEstudante").modal("hide");
                frm.reset();
                tblEst.ajax.reload();
                alertas(res.msg, res.icone);
            }
        }
    }
}

function btnEditarEst(id) {
    document.getElementById("title").textContent = "Atualizar estudante";
    document.getElementById("btnAccion").textContent = "Alterar";
    const url = base_url + "Estudantes/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("codigo").value = res.codigo;
            document.getElementById("dni").value = res.dni;
            document.getElementById("nome").value = res.nome;
            document.getElementById("turma").value = res.turma;
            document.getElementById("telefone").value = res.telefone;
            document.getElementById("endereco").value = res.endereco;
            $("#novoEstudante").modal("show");
        }
    }
}

function btnEliminarEst(id) {
    Swal.fire({
        title: 'Deseja realmente eliminar este estudante?',
        text: "O estudante não será excluído permanentemente, apenas mudará o status para inativo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!',
        cancelButtonText: 'Não'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Estudantes/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblEst.ajax.reload();
                    alertas(res.msg, res.icone);
                }
            }

        }
    })
}

function btnEliminarEstPerma(id) {
    Swal.fire({
        title: 'Deseja realmente eliminar permanentemente este estudante?',
        text: "ATENÇÃO! ESTÁ AÇÃO SÓ PODE SER USADA EM CASO DE SAÍDA DO ALUNO!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!',
        cancelButtonText: 'Não'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Estudantes/eliminarPermanentemente/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblEst.ajax.reload();
                    alertas(res.msg, res.icone);
                }
            }
        }
    })
}

function btnReingresarEst(id) {
    Swal.fire({
        title: 'Deseja reingressar o estudante?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!',
        cancelButtonText: 'Não'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Estudantes/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblEst.ajax.reload();
                    alertas(res.msg, res.icone);
                }
            }

        }
    })
}
//Fin Estudante
function frmGenero() {
    document.getElementById("title").textContent = "Nova gênero";
    document.getElementById("btnAccion").textContent = "Cadastrar";
    document.getElementById("frmGenero").reset();
    document.getElementById("id").value = "";
    $("#novoGenero").modal("show");
}

function registrarGenero(e) {
    e.preventDefault();
    const genero = document.getElementById("genero");
    if (genero.value == "") {
        alertas('La genero es requerido', 'warning');
    } else {
        const url = base_url + "Genero/registrar";
        const frm = document.getElementById("frmGenero");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#novoGenero").modal("hide");
                frm.reset();
                tblGenero.ajax.reload();
                alertas(res.msg, res.icone);
            }
        }
    }
}

function btnEditarMat(id) {
    document.getElementById("title").textContent = "Caixa de atualização";
    document.getElementById("btnAccion").textContent = "Alterar";
    const url = base_url + "Genero/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("genero").value = res.genero;
            $("#novoGenero").modal("show");
        }
    }
}

function btnEliminarMat(id) {
    Swal.fire({
        title: 'Deseja realmente elimiar esta gênero?',
        text: "A gênero não será excluída permanentemente, apenas mudará o estado para inativo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!',
        cancelButtonText: 'Não'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Genero/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblGenero.ajax.reload();
                    alertas(res.msg, res.icone);
                }
            }

        }
    })
}

function btnReingresarMat(id) {
    Swal.fire({
        title: 'Deseja realmente reingresar com esta gênero?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!',
        cancelButtonText: 'Não'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Genero/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblGenero.ajax.reload();
                    alertas(res.msg, res.icone);
                }
            }

        }
    })
}
//Fin Genero
function frmAutor() {
    document.getElementById("title").textContent= "Novo autor";
    document.getElementById("btnAccion").textContent= "Cadastrar";
    document.getElementById("frmAutor").reset();
    document.getElementById("id").value = "";
    deleteImg();
    $("#novoAutor").modal("show");
}

function registrarAutor(e) {
    e.preventDefault();
    const autor = document.getElementById("autor");
    if (autor.value == "") {
        alertas('O nome é obrigatório!', 'warning');
    } else {
        const url = base_url + "Autor/registrar";
        const frm = document.getElementById("frmAutor");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#novoAutor").modal("hide");
                frm.reset();
                tblAutor.ajax.reload();
                alertas(res.msg, res.icone);
            }
        }
    }
}

function btnEditarAutor(id) {
    document.getElementById("title").textContent = "Atualizar Autor";
    document.getElementById("btnAccion").textContent = "Alterar";
    const url = base_url + "Autor/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("autor").value = res.autor;
            document.getElementById("img-preview").src = base_url + 'Assets/img/autor/' + res.imagem;
            document.getElementById("icon-image").classList.add("d-none");
            document.getElementById("icon-cerrar").innerHTML = `
            <button class="btn btn-danger" onclick="deleteImg()">
            <i class="fa fa-times-circle"></i></button>`;
            $("#novoAutor").modal("show");
        }
    }
}

function btnEliminarAutor(id) {
    Swal.fire({
        title: 'Deseja realmente eliminar este autor?',
        text: "O autor não será excluído permanentemente, apenas mudará o estado para inativo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!',
        cancelButtonText: 'Não'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Autor/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblAutor.ajax.reload();
                    alertas(res.msg, res.icone);
                }
            }

        }
    })
}

function btnReingresarAutor(id) {
    Swal.fire({
        title: 'Deseja realmente reingressar este autor?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!',
        cancelButtonText: 'Não'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Autor/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblAutor.ajax.reload();
                    alertas(res.msg, res.icone);
                }
            }

        }
    })
}
//Fin Autor
function frmEditora() {
    document.getElementById("title").textContent = "Nova editora";
    document.getElementById("btnAccion").textContent = "Cadastrar";
    document.getElementById("frmEditora").reset();
    document.getElementById("id").value = "";
    $("#novoEditora").modal("show");
}

function registrarEditora(e) {
    e.preventDefault();
    const editora = document.getElementById("editora");
    if (editora.value == "") {
        alertas('El editora es requerido', 'warning');
    } else {
        const url = base_url + "Editora/registrar";
        const frm = document.getElementById("frmEditora");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#novoEditora").modal("hide");
                tblEditora.ajax.reload();
                alertas(res.msg, res.icone);
            }
        }
    }
}

function btnEditarEdi(id) {
    document.getElementById("title").textContent = "Atualizar Editora";
    document.getElementById("btnAccion").textContent = "Alterar";
    const url = base_url + "Editora/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("editora").value = res.editora;
            $("#novoEditora").modal("show");
        }
    }
}

function btnEliminarEdi(id) {
    Swal.fire({
        title: 'Deseja realmente eliminar essa editora?',
        text: "A editora não será excluído permanentemente, apenas mudará o estado para inativo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!',
        cancelButtonText: 'Não'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Editora/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblEditora.ajax.reload();
                    alertas(res.msg, res.icone);
                }
            }

        }
    })
}

function btnReingresarEdi(id) {
    Swal.fire({
        title: 'Deseja realmente reingresar esta editora?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!',
        cancelButtonText: 'Não'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Editora/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblEditora.ajax.reload();
                    alertas(res.msg, res.icone);
                }
            }

        }
    })
}
//Fin editora
function frmLivros() {
    document.getElementById("title").textContent = "Novo livro";
    document.getElementById("btnAccion").textContent = "Cadastrar";
    document.getElementById("frmLivro").reset();
    document.getElementById("id").value = "";
    $("#novoLivro").modal("show");
    deleteImg();
}

function registrarLivro(e) {
    e.preventDefault();
    const titulo = document.getElementById("titulo");
    const autor = document.getElementById("autor");
    const editora = document.getElementById("editora");
    const genero = document.getElementById("genero");
    const quantidade = document.getElementById("quantidade");
    const num_pagina = document.getElementById("num_pagina");

    if (titulo.value == '' || autor.value == '' || editora.value == ''
    || genero.value == '' || quantidade.value == '' || num_pagina.value == '') {
        alertas('Todo los campos son requeridos', 'warning');
    } else {
        const url = base_url + "Livros/registrar";
        const frm = document.getElementById("frmLivro");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#novoLivro").modal("hide");
                tblLivros.ajax.reload();
                frm.reset();
                alertas(res.msg, res.icone);
            }
        }
    }
}

function btnEditarLivro(id) {
    document.getElementById("title").textContent = "Atualizar Livro";
    document.getElementById("btnAccion").textContent = "Alterar";
    const url = base_url + "Livros/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
              document.getElementById("id").value = res.id;
              document.getElementById("titulo").value = res.titulo;
              document.getElementById("autor").value = res.id_autor;
              document.getElementById("editora").value = res.id_editora;
              document.getElementById("genero").value = res.id_genero;
              document.getElementById("quantidade").value = res.quantidade;
              document.getElementById("num_pagina").value = res.num_pagina;
              document.getElementById("ano_edicao").value = res.ano_edicao;
              document.getElementById("descricao").value = res.descricao;
            document.getElementById("img-preview").src = base_url + 'Assets/img/livros/'+ res.imagem;
            document.getElementById("icon-cerrar").innerHTML = `
            <button class="btn btn-danger" onclick="deleteImg()">
            <i class="fa fa-times-circle"></i></button>`;
            document.getElementById("icon-image").classList.add("d-none");
            document.getElementById("foto_atual").value = res.imagem;
            $("#novoLivro").modal("show");
        }
    }
}

function btnEliminarLivro(id) {
    Swal.fire({
        title: 'Deseja realmente eliminar este livro?',
        text: "O Livro não será excluído permanentemente, apenas mudará o estado para inativo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!',
        cancelButtonText: 'Não'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Livros/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblLivros.ajax.reload();
                    alertas(res.msg, res.icone);
                }
            }

        }
    })
}

function btnReingresarLivro(id) {
    Swal.fire({
        title: 'Deseja realmente reingresar com este livro?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!',
        cancelButtonText: 'Não'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Livros/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblLivros.ajax.reload();
                    alertas(res.msg, res.icone);
                }
            }

        }
    })
}
function preview(e) {
    var input = document.getElementById('imagem');
    var filePath = input.value;
    var extension = /(\.png|\.jpeg|\.jpg)$/i;
    if (!extension.exec(filePath)) {
        alertas('Selecione um aquivo válido!', 'warning');
        deleteImg();
        return false;
    }else{
        const url = e.target.files[0];
        const urlTmp = URL.createObjectURL(url);
        document.getElementById("img-preview").src = urlTmp;
        document.getElementById("icon-image").classList.add("d-none");
        document.getElementById("icon-cerrar").innerHTML = `
        <button class="btn btn-danger" onclick="deleteImg()"><i class="fa fa-times-circle"></i></button>
        `;
    }

}
function deleteImg() {
    document.getElementById("icon-cerrar").innerHTML = '';
    document.getElementById("icon-image").classList.remove("d-none");
    document.getElementById("img-preview").src = '';
    document.getElementById("imagem").value = '';
    document.getElementById("foto_atual").value = '';
}
function frmConfig(e) {
    e.preventDefault();
    const nome = document.getElementById("nome");
    const telefone = document.getElementById("telefone");
    const endereco = document.getElementById("endereco");
    const email = document.getElementById("email");
    if (nome.value == "" || telefone.value == "" || endereco.value == "" || email.value == "") {
        alertas('Todos os campos são obrigatórios!', 'warning');
    } else {
        const url = base_url + "Configuracao/atualizar";
        const frm = document.getElementById("frmConfig");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                alertas(res.msg, res.icone);
            }
        }
    }
}
function frmPrestar() {
    document.getElementById("frmPrestar").reset();
    $("#prestar").modal("show");
}
function btnEntregar(id) {
    Swal.fire({
        title: 'Receber livro?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!',
        cancelButtonText: 'Não'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Emprestimo/entregar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblPrestar.ajax.reload();
                    alertas(res.msg, res.icone);
                }
            }

        }
    })
}
function registroEmprestimo(e){
    e.preventDefault();
    const livro = document.getElementById("livro").value;
    const estudante = document.getElementById("estudante").value;
    const quantidade = document.getElementById("quantidade").value;
    const fecha_emprestimo = document.getElementById("fecha_emprestimo").value;
    const fecha_devolucao = document.getElementById("fecha_devolucao").value;
    if (livro == '' || estudante == '' || quantidade == '' || fecha_emprestimo == '' || fecha_devolucao == '') {
        alertas('Todos os campos são obrigatórios!', 'warning');
    } else {
        const frm = document.getElementById("frmPrestar");
        const url = base_url + "Emprestimo/registrar";
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                tblPrestar.ajax.reload();
                $("#prestar").modal("hide");
                alertas(res.msg, res.icone);
                if (res.icone == 'success') {
                    setTimeout(() => {
                        window.open(base_url + 'Emprestimo/ticked/'+ res.id, '_blank');
                    }, 3000);
                }
                
            }
        }
    }
}
function btnRolesUser(id) {
    const http = new XMLHttpRequest();
    const url = base_url + "Usuarios/permissoes/" + id;
    http.open("GET", url);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("frmPermisos").innerHTML = this.responseText;
            $("#permissoes").modal("show");
        }
    }
}
function registrarPermisos(e) {
    e.preventDefault();
    const http = new XMLHttpRequest();
    const frm = document.getElementById("frmPermisos");
    const url = base_url + "Usuarios/registrarPermisos";
    http.open("POST", url);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            $("#permissoes").modal("hide");
            if(res == 'ok'){
				alertas('Permissões atribuídas!', 'success');
			}else{
				alertas('Erro ao atribuir permissões!', 'error');
			}
        }
    }
}
function modificarClave(e) {
    e.preventDefault();
    var formClave = document.querySelector("#frmCambiarPass");
    formClave.onsubmit = function (e) {
        e.preventDefault();
        const chave_atual = document.querySelector("#chave_atual").value;
        const nova_chave = document.querySelector("#chave_nova").value;
        const confirmar_chave = document.querySelector("#chave_confirmar").value;
        if (chave_atual == "" || nova_chave == "" || confirmar_chave == "") {
            alertas('Todos os campos são obrigatórios!', 'warning');
        } else if (nova_chave != confirmar_chave) {
            alertas('As senhas não coincidem!', 'warning');
        } else {
            const http = new XMLHttpRequest();
            const frm = document.getElementById("frmPermisos");
            const url = base_url + "Usuarios/cambiarPas";
            http.open("POST", url);
            http.send(new FormData(formClave));
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    $('#cambiarClave').modal("hide");
                    alertas(res.msg, res.icone);                    
                }
            }            
        }

    }
}
if (document.getElementById("reporteEmprestimo")) {
    const url = base_url + "Configuracao/grafico";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
                const data = JSON.parse(this.responseText);
                let nome = [];
                let quantidade = [];
                for (let i = 0; i < data.length; i++) {
                    nome.push(data[i]['titulo']);
                    quantidade.push(data[i]['quantidade']);
                }
                var ctx = document.getElementById("reporteEmprestimo");
                var myPieChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: nome,
                        datasets: [{
                            label: 'Livros',
                            data: quantidade,
                            backgroundColor: ['#dc143c'],
                        }],
                    },
                });
            
        }
    }
}
function alertas(msg, icone) {
    Swal.fire({
        position: 'center',
        icon: icone,
        title: msg,
        showConfirmButton: false,
        timer: 3000
    })
}
function verificarLivro(e) {
    const livro = document.getElementById('livro').value;
    const cant = document.getElementById('quantidade').value;
    const http = new XMLHttpRequest();
    const url = base_url + 'Livros/verificar/' + livro;
    http.open("GET", url);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res.icone == 'success') {
                document.getElementById('msg_error').innerHTML = `<span class="badge badge-primary">Disponíveis: ${res.quantidade}</span>`;
            }else{
                alertas(res.msg, res.icone);
                return false;
            }
        }
    }
}
