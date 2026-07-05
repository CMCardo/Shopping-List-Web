<?php include 'views/layout/header.php'; ?>

<main class="page">
  <header class="page__header">
  </header>

  <section class="grid">
    <?php foreach ($categories as $categoria): ?>
      <div class="category">
        
        <button type="button" class="category__edit-btn" onclick="obrirModal(<?= $categoria['id'] ?>, '<?= addslashes($categoria['nom']) ?>')" title="Editar">⋮</button>
        
        <a class="category__link" href="index.php?action=productes&id_categoria=<?= $categoria['id'] ?>">
          <div class="category__image">
            <?php if (!empty($categoria['imatge'])): ?>
              <img src="public/uploads/<?= $categoria['imatge'] ?>" alt="<?= $categoria['nom'] ?>" />
            <?php else: ?>
              <div class="category__fallback">
                <span class="category__fallback-text"><?= mb_substr($categoria['nom'], 0, 1) ?></span>
              </div>
            <?php endif; ?>
          </div>
          <div class="category__body">
            <h2 class="category__name"><?= $categoria['nom'] ?></h2>
          </div>
        </a>
      </div>
    <?php endforeach; ?>

    <a class="category category--add" href="index.php?action=nova_categoria">
      <div class="category__add-icon">+</div>
    </a>
  </section>
  
  <div id="modalEdicio" class="modal">
    <div class="modal__content">
      <span class="modal__close" onclick="tancarModal()">&times;</span>
      <h2>Edit</h2>
      
      <form action="index.php?action=actualitzar_categoria" method="POST" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:16px;">
        <input type="hidden" name="id" id="modal_id">
        
        <div style="display:flex; flex-direction:column; gap:4px;">
          <label style="color:#9ca3af; font-size:14px;">Name:</label>
          <input type="text" name="nom" id="modal_nom" required style="padding:10px; border-radius:6px; background:#111827; border:1px solid #374151; color:white;">
        </div>
        
        <div style="display:flex; flex-direction:column; gap:4px;">
          <label style="color:#9ca3af; font-size:14px;">Image:</label>
          <input type="file" name="imatge" accept="image/*" style="color:#9ca3af;">
        </div>
        
        <button type="submit" style="padding:10px; background:#2563eb; color:white; border:none; border-radius:6px; cursor:pointer; font-weight:bold;">Guardar Canvis</button>
      </form>

      <hr>
      
      <a href="#" id="modal_delete_link" class="btn-delete" onclick="return confirm('Segur que vols eliminar aquesta categoria? S\'esborraran també els seus productes.')">Eliminar Categoria</a>
    </div>
  </div>

  <script>
    function obrirModal(id, nom) {
      document.getElementById('modalEdicio').style.display = 'flex';
      document.getElementById('modal_id').value = id;
      document.getElementById('modal_nom').value = nom;
      document.getElementById('modal_delete_link').href = 'index.php?action=eliminar_categoria&id=' + id;
    }
    function tancarModal() {
      document.getElementById('modalEdicio').style.display = 'none';
    }
  </script>
</main>

<?php include 'views/layout/footer.php'; ?>