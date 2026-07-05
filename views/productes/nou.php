<?php include 'views/layout/header.php'; ?>

<main class="page">
    <a href="index.php?action=productes&id_categoria=<?= $id_categoria ?>" class="page__back">← Go back</a>
    
    <header class="page__header" style="text-align: left;">
        <h1 class="page__title">New Product</h1>
    </header>

    <form action="index.php?action=guardar_producte" method="POST" enctype="multipart/form-data" class="form-add" style="display:flex; flex-direction:column; gap:20px; max-width:500px;">
        
        <input type="hidden" name="id_categoria" value="<?= $id_categoria ?>">

        <div style="display:flex; flex-direction:column; gap:6px;">
            <label for="nom" style="font-weight:600;">Name</label>
            <input type="text" id="nom" name="nom" required style="padding:12px; border-radius:8px; background:#1f2937; border:1px solid #374151; color:white; font-size:16px;">
        </div>

        <div style="display:flex; flex-direction:column; gap:6px;">
            <label for="imatge" style="font-weight:600;">Image</label>
            <input type="file" id="imatge" name="imatge" accept="image/*" style="padding:10px 0; color:#9ca3af;">
        </div>

        <button type="submit" style="padding:14px; background:#2563eb; color:white; border:none; border-radius:8px; font-size:16px; font-weight:bold; cursor:pointer; margin-top:10px;">Crear Grup</button>
    </form>
</main>

<?php include 'views/layout/footer.php'; ?>