<?php include 'views/layout/header.php'; ?>

<main class="page">
  <header class="page__header">
    <a href="index.php?action=categories" class="page__back">← Go back</a>
    <h1 class="page__title"><?= htmlspecialchars($categoria_actual['nom']) ?></h1>
  </header>

  <section class="grid">
    <?php if (empty($productes)): ?>
        <p style="grid-column: 1 / -1; color: #9ca3af; font-size: 18px; padding: 20px 0;">
        </p>
    <?php endif; ?>

    <?php foreach ($productes as $producte): ?>
      <div class="product">
        
        <button type="button" class="product__edit-btn" 
                data-id="<?= $producte['id'] ?>"
                data-nom="<?= htmlspecialchars($producte['nom'], ENT_QUOTES) ?>"
                onclick="obrirModalProducte(this);" 
                title="Editar">⋮</button>
        
        <a class="product__link" href="index.php?action=detall&id=<?= $producte['id'] ?>">
          <div class="product__image">
            <?php if (!empty($producte['imatge'])): ?>
              <img src="public/uploads/<?= $producte['imatge'] ?>" alt="<?= htmlspecialchars($producte['nom'], ENT_QUOTES) ?>" />
            <?php else: ?>
              <div class="category__fallback">
                <span class="category__fallback-text"><?= mb_substr($producte['nom'], 0, 1) ?></span>
              </div>
            <?php endif; ?>
          </div>
          
          <div class="product__body">
            <h2 class="product__name"><?= htmlspecialchars($producte['nom']) ?></h2>
            <span class="product__price"><?= $producte['rang_preus'] ?></span>
          </div>
        </a>
      </div>
    <?php endforeach; ?>

    <a class="product product--add" href="index.php?action=nou_producte&id_categoria=<?= $id_categoria ?>">
      <div class="category__add-icon">+</div>
    </a>
  </section>

  <div id="modalEdicioProducte" class="modal" style="display: none;">
    <div class="modal__content" style="max-height: 90vh; overflow-y: auto;">
      <span class="modal__close" onclick="tancarModal()">&times;</span>
      <h2>Edit</h2>
      
      <form action="index.php?action=actualitzar_producte" method="POST" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:16px;">
        <input type="hidden" name="id" id="modal_id">
        <input type="hidden" name="id_categoria" value="<?= $id_categoria ?>">
        
        <div style="display:flex; flex-direction:column; gap:4px;">
          <label style="color:#9ca3af; font-size:14px;">Name:</label>
          <input type="text" name="nom" id="modal_nom" required style="padding:10px; border-radius:6px; background:#111827; border:1px solid #374151; color:white;">
        </div>

        <div style="display:flex; flex-direction:column; gap:4px;">
          <label style="color:#9ca3af; font-size:14px;">Image:</label>
          <input type="file" name="imatge" accept="image/*" style="color:#9ca3af;">
        </div>
        
        <button type="submit" style="padding:10px; background:#2563eb; color:white; border:none; border-radius:6px; cursor:pointer; font-weight:bold;">Save Changes</button>
      </form>
      <hr>
      <a href="#" id="modal_delete_link" class="btn-delete" onclick="return confirm('Segur que vols eliminar aquest grup sencer?')">Delete</a>
    </div>
  </div>

  <script>
    function obrirModalProducte(boto) {
      document.getElementById('modalEdicioProducte').style.display = 'flex';
      
      let id = boto.getAttribute('data-id');
      let nom = boto.getAttribute('data-nom');
      
      document.getElementById('modal_id').value = id;
      document.getElementById('modal_nom').value = nom;
      
      document.getElementById('modal_delete_link').href = 'index.php?action=eliminar_producte&id=' + id + '&id_categoria=<?= $id_categoria ?>';
    }
    
    function tancarModal() {
      document.getElementById('modalEdicioProducte').style.display = 'none';
    }
  </script>
</main>

<?php include 'views/layout/footer.php'; ?>