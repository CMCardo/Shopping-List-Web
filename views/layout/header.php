<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shopping List</title>
  
<?php
    $fitxer_css = 'categories.css';
  ?>

  <link rel="stylesheet" href="/public/css/<?= $fitxer_css ?>?v=<?= time() ?>" />

  <a href="index.php?action=logout" style="color: #ef4444; text-decoration: none; font-size: 14px; position: absolute; right: 20px; top: 20px;">Log out</a>

  <style>
    body {
      font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
      background-color: #111827;
      color: #f3f4f6;
      line-height: 1.5;
      margin: 0;
      padding: 0;
    }
    .page { max-width: 1100px; margin: 0 auto; padding: 32px 20px; }
    .page__header { margin-bottom: 24px; }
    .page__title { font-size: 28px; font-weight: 700; }
    .page__subtitle { color: #9ca3af; font-size: 15px; margin-top: 4px; }
  </style>
</head>
<body>