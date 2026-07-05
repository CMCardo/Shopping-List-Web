<?php include 'views/layout/header.php'; ?>

<main class="page">
    <a href="index.php?action=categories" class="page__back">← Go back</a>
    
    <header class="page__header" style="text-align: left;">
    </header>

    <form action="index.php?action=guardar_categoria" method="POST" enctype="multipart/form-data" class="form-add">
        
        <div class="form-group">
            <label for="nom">Name</label>
            <input type="text" id="nom" name="nom" required>
        </div>

        <div class="form-group">
            <label for="imatge">Image</label>
            <input type="file" id="imatge" name="imatge" accept="image/*">
        </div>

        <button type="submit" class="btn-submit">Save</button>
    </form>
</main>

<style>
.form-add { display: flex; flex-direction: column; gap: 24px; max-width: 500px; margin-top: 20px; }
.form-group { display: flex; flex-direction: column; gap: 8px; }
.form-group label { font-weight: 600; color: #9ca3af; font-size: 14px; }
.form-group input { padding: 12px; border-radius: 8px; border: 1px solid #374151; background-color: #1f2937; color: #f9fafb; font-size: 16px; font-family: inherit; }
.form-group input:focus { outline: none; border-color: #60a5fa; }
.form-group input[type="file"] { padding: 8px; color: #9ca3af; }
.btn-submit { padding: 12px 24px; background-color: #2563eb; color: #ffffff; font-size: 16px; font-weight: 600; border: none; border-radius: 8px; cursor: pointer; transition: background-color 0.15s ease; align-self: flex-start; }
.btn-submit:hover { background-color: #1d4ed8; }
</style>

<?php include 'views/layout/footer.php'; ?>