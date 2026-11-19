</main>
<footer>VetCare • Gestão veterinária • Ambiente didático de manutenção de sistemas</footer>

<div class="modal-sair" id="modalSair" role="dialog" aria-modal="true" aria-labelledby="tituloModalSair" hidden>
  <div class="modal-sair-conteudo">
    <div class="modal-sair-icone" aria-hidden="true">↪</div>
    <h2 id="tituloModalSair">Deseja sair?</h2>
    <p>Tem certeza de que deseja encerrar sua sessão no VetCare?</p>
    <div class="modal-sair-acoes">
      <button type="button" class="btn secondary" id="cancelarSaida"><span aria-hidden="true">×</span> CANCELAR</button>
      <a class="btn danger" id="confirmarSaida" href="<?= htmlspecialchars($baseUrl) ?>/logout.php"><span aria-hidden="true">↪</span> SIM, SAIR</a>
    </div>
  </div>
</div>

<script>
(function () {
  const abrir = document.getElementById('abrirConfirmacaoSair');
  const modal = document.getElementById('modalSair');
  const cancelar = document.getElementById('cancelarSaida');

  if (abrir && modal && cancelar) {
    abrir.addEventListener('click', function () {
      modal.hidden = false;
      document.body.classList.add('modal-aberto');
      cancelar.focus();
    });

    cancelar.addEventListener('click', function () {
      modal.hidden = true;
      document.body.classList.remove('modal-aberto');
      abrir.focus();
    });

    modal.addEventListener('click', function (evento) {
      if (evento.target === modal) {
        modal.hidden = true;
        document.body.classList.remove('modal-aberto');
        abrir.focus();
      }
    });

    document.addEventListener('keydown', function (evento) {
      if (evento.key === 'Escape' && !modal.hidden) {
        modal.hidden = true;
        document.body.classList.remove('modal-aberto');
        abrir.focus();
      }
    });
  }
})();
</script>
</body>
</html>
