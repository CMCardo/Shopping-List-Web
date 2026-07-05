<?php include 'views/layout/header.php'; ?>

<main class="page">
  <header class="page__header">
    <a href="index.php?action=productes&id_categoria=<?= $producte_actual['id_categoria'] ?>" class="page__back">← Go back</a>
    <h1 class="page__title"><?= htmlspecialchars($producte_actual['nom']) ?></h1>
  </header>

  <section class="variant-list">
    <?php if (empty($variants)): ?>
        <p style="color: #9ca3af; font-size: 18px; padding: 20px 0;">
        </p>
    <?php endif; ?>

    <?php foreach ($variants as $variant): ?>
      
      <?php $classe_comprat = ($variant['comprat'] == 1) ? 'variant-card--comprat' : ''; ?>
      
      <div class="variant-card <?= $classe_comprat ?>">
        
        <button type="button" class="product__edit-btn" 
                data-id="<?= $variant['id'] ?>"
                data-nom="<?= htmlspecialchars($variant['nom'], ENT_QUOTES) ?>"
                data-preu="<?= $variant['preu'] ?>"
                data-descripcio="<?= htmlspecialchars($variant['descripcio'] ?? '', ENT_QUOTES) ?>"
                data-enllac="<?= htmlspecialchars($variant['enllac_compra'] ?? '', ENT_QUOTES) ?>"
                data-comprat="<?= $variant['comprat'] ?>"
                onclick="obrirModalVariant(this);" 
                title="Editar">⋮</button>
        
        <div class="variant-card__image">
            <?php if (!empty($variant['imatge'])): ?>
              <img src="public/uploads/<?= $variant['imatge'] ?>" alt="<?= htmlspecialchars($variant['nom'], ENT_QUOTES) ?>" />
            <?php else: ?>
              <div class="category__fallback">
                <span class="category__fallback-text"><?= mb_substr($variant['nom'], 0, 1) ?></span>
              </div>
            <?php endif; ?>
        </div>
        
        <div class="variant-card__body">
            <h2 class="variant-card__title">
                <?= htmlspecialchars($variant['nom']) ?>
                <?php if ($variant['comprat'] == 1): ?>
                    <span style="font-size: 14px; background: #4b5563; padding: 2px 8px; border-radius: 4px; vertical-align: middle; margin-left: 8px;">COMPRAT</span>
                <?php endif; ?>
            </h2>
            <span class="variant-card__price"><?= $variant['preu'] ?> €</span>
            
            <?php if (!empty($variant['descripcio'])): ?>
                <p class="variant-card__desc"><?= nl2br(htmlspecialchars($variant['descripcio'])) ?></p>
            <?php else: ?>
            <?php endif; ?>
            
            <?php if (!empty($variant['enllac_compra'])): ?>
                <a class="variant-card__buy" href="<?= htmlspecialchars($variant['enllac_compra']) ?>" target="_blank">Buy</a>
            <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>

    <a class="variant-card--add" href="#" onclick="event.preventDefault(); obrirModalNovaVariant();">
      <div class="category__add-icon">+</div>
    </a>
  </section>

  <div id="modalVariant" class="modal" style="display: none;">
    <div class="modal__content" style="max-height: 90vh; overflow-y: auto;">
      <span class="modal__close" onclick="tancarModal()">&times;</span>
      
      <h2 id="modal_titol">New Model</h2>
      
      <form id="formVariant" action="index.php?action=guardar_variant" method="POST" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:16px;">
        <input type="hidden" name="id" id="modal_id">
        <input type="hidden" name="id_producte" value="<?= $id_producte ?>">
        
        <div style="display:flex; flex-direction:column; gap:4px;">
          <label style="color:#9ca3af; font-size:14px;">Name:</label>
          <input type="text" name="nom" id="modal_nom" required style="padding:10px; border-radius:6px; background:#111827; border:1px solid #374151; color:white;">
        </div>

        <div style="display:flex; flex-direction:column; gap:4px;">
          <label style="color:#9ca3af; font-size:14px;">Price:</label>
          <input type="number" name="preu" id="modal_preu" step="0.01" min="0" required style="padding:10px; border-radius:6px; background:#111827; border:1px solid #374151; color:white;">
        </div>

        <div style="display:flex; flex-direction:column; gap:4px;">
          <label style="color:#9ca3af; font-size:14px;">Description:</label>
          <textarea name="descripcio" id="modal_descripcio" rows="4" style="padding:10px; border-radius:6px; background:#111827; border:1px solid #374151; color:white; font-family:inherit; resize:vertical;"></textarea>
        </div>

        <div style="display:flex; flex-direction:column; gap:4px;">
          <label style="color:#9ca3af; font-size:14px;">Link:</label>
          <input type="url" name="enllac_compra" id="modal_enllaç" style="padding:10px; border-radius:6px; background:#111827; border:1px solid #374151; color:white;">
        </div>
        
        <div style="display:flex; flex-direction:column; gap:4px;">
          <label style="color:#9ca3af; font-size:14px;">Image:</label>
          <input type="file" name="imatge" accept="image/*" style="color:#9ca3af;">
        </div>
        
        <div id="div_comprat" style="display:none; align-items:center; gap:8px; margin-top:8px; padding: 12px; background: rgba(16, 185, 129, 0.1); border: 1px solid #10b981; border-radius: 8px;">
            <input type="checkbox" name="comprat" id="modal_comprat" value="1" style="width:18px; height:18px; cursor:pointer;">
            <label for="modal_comprat" style="color:#10b981; font-weight:bold; cursor:pointer;">Bought</label>
        </div>
        
        <button type="submit" style="padding:10px; background:#2563eb; color:white; border:none; border-radius:6px; cursor:pointer; font-weight:bold; margin-top: 8px;">Save</button>
      </form>
      
      <hr>
      <a href="#" id="modal_delete_link" class="btn-delete" style="display:none;" onclick="return confirm('Segur que vols eliminar aquest model?')">Delete Model</a>
    </div>
  </div>

  <script>
    function obrirModalNovaVariant() {
      document.getElementById('modalVariant').style.display = 'flex';
      document.getElementById('modal_titol').innerText = 'New Model';
      document.getElementById('formVariant').action = 'index.php?action=guardar_variant';
      
      document.getElementById('modal_id').value = '';
      document.getElementById('modal_nom').value = '';
      document.getElementById('modal_preu').value = '0.00';
      document.getElementById('modal_descripcio').value = '';
      document.getElementById('modal_enllaç').value = '';
      
      document.getElementById('modal_delete_link').style.display = 'none';
      document.getElementById('div_comprat').style.display = 'none';
    }

    function obrirModalVariant(boto) {
      document.getElementById('modalVariant').style.display = 'flex';
      document.getElementById('modal_titol').innerText = 'Edit Model';
      document.getElementById('formVariant').action = 'index.php?action=actualitzar_variant';
      
      let id = boto.getAttribute('data-id');
      document.getElementById('modal_id').value = id;
      document.getElementById('modal_nom').value = boto.getAttribute('data-nom');
      document.getElementById('modal_preu').value = boto.getAttribute('data-preu');
      document.getElementById('modal_descripcio').value = boto.getAttribute('data-descripcio');
      document.getElementById('modal_enllaç').value = boto.getAttribute('data-enllac');
      
      let esta_comprat = boto.getAttribute('data-comprat');
      document.getElementById('modal_comprat').checked = (esta_comprat == '1');
      document.getElementById('div_comprat').style.display = 'flex';
      
      document.getElementById('modal_delete_link').style.display = 'block';
      document.getElementById('modal_delete_link').href = 'index.php?action=eliminar_variant&id=' + id + '&id_producte=<?= $id_producte ?>';
    }
    
    function tancarModal() {
      document.getElementById('modalVariant').style.display = 'none';
    }
  </script>
</main>

<?php include 'views/layout/footer.php'; ?>