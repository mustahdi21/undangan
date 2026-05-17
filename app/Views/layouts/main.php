<!doctype html>
<html lang="id" x-data="{dark:false}">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?? 'LuxInvite'; ?></title>
  <meta name="description" content="Platform undangan digital premium modern dengan fitur SaaS lengkap.">
  <meta property="og:title" content="<?= $title ?? 'LuxInvite'; ?>">
  <meta property="og:type" content="website">
  <meta property="og:image" content="/assets/img/og-default.jpg">
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body class="bg-slate-950 text-white">
<?= $content; ?>
<script src="/assets/js/app.js"></script>
</body>
</html>
