<link rel="preload" href="/demo/fonts/Manrope-Regular.woff2" as="font" crossorigin="anonymous">

<?php foreach ($styles as $style): ?>
  <?php echo self::get_style(
    $style, 
    (!self::get_request_property('test') && CONFIG['production'])
      ? []
      : [CONFIG['main_domain'] => CONFIG['dev_domain']]
  ); ?>
<?php endforeach; ?>

<?php if ($test): ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
<?php endif; ?>