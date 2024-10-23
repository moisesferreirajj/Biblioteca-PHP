</main>
<div id="cambiarClave" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="my-modal-title">| Alterar senha</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form autocomplete="off" id="frmCambiarPass" onsubmit="modificarClave(event)">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="chave_atual">Senha Atual</label>
                        <input id="chave_atual" class="form-control" type="password" name="chave_atual" id="chave_atual" placeholder="Insira sua senha atual" required>
                    </div>
                    <div class="form-group">
                        <label for="chave_nova">Nova senha</label>
                        <input id="chave_nova" class="form-control" type="password" name="chave_nova" placeholder="Insira sua senha nova" id="chave_nova" required>
                    </div>
                    <div class="form-group">
                        <label for="chave_confirmar">Confirmar Senha</label>
                        <input id="chave_confirmar" class="form-control" type="password" name="chave_confirmar" id="chave_confirmar" placeholder="Confirmar sua nova senha" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Alterar</button>
                    <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Essential javascripts for application to work-->
<script src="<?php echo base_url; ?>Assets/js/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="<?php echo base_url; ?>Assets/js/pace.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/chart.min.js" crossorigin="anonymous"></script>
<script>
    const base_url = "<?php echo base_url; ?>";
</script>
<script src="<?php echo base_url; ?>Assets/js/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="<?php echo base_url; ?>Assets/js/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo base_url; ?>Assets/js/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php echo base_url; ?>Assets/js/datatables.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/select2.min.js"></script>
<script src="<?php echo base_url; ?>Assets/js/funciones.js"></script>

<!-- Google analytics script-->
<script type="text/javascript">
    if (document.location.hostname == 'pratikborsadiya.in') {
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
    }
</script>
</body>

</html>