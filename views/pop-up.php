<div
  class="<?php echo_array_if([
    "demo-pop-up" => true,
    "demo-pop-up_$lang_name" => true,
    "demo-pop-up_shimmering" => @$shimmering,
    "hidden disabled" => $hidden,
  ]); ?>"
  data-demo-pop-up="<?php echo $pop_up_name; ?>"
  data-demo-pop-up-active-after-out-click
  <?php if (@$ignore_esc): ?>
    data-demo-pop-up-ignore-esc
  <?php endif; ?>
  <?php echo_array_if($tags); ?>
>
  <div class="demo-pop-up__wrap">

    <div class="demo-pop-up__content" data-demo-pop-up-content>
      <div class="demo-notice <?php echo_array_if([
        "clicked" => @$clicked
      ]); ?>" data-click-to="<?php echo $pop_up_name; ?>" data-click-set="<?php echo $pop_up_name; ?>">
        <div class="demo-notice__header">
          <?php ob_start(); ?>
          <div class="demo-notice__logo">
            <a
              href="<?php echo CONFIG['target_domain']; ?><?php
                if (Languages::get_current_name() !== CONFIG['default_target_domain_lang']) {
                  echo '/' . Languages::get_current_name() . '/';
                }
              ?>"
              target="_blank"
              class="demo-notice__link not-link-style"
              onclick="return checkClicked('<?php echo $pop_up_name; ?>');"
              title="<?php echo lang('created_by'); ?>"
            >
              <?php readfile(PATH_PREFIX . "/public/assets/img/ilve-$lang_name.svg"); ?>
            </a>
            <!-- /.demo-notice__link -->
          </div>
          <!-- /.demo-notice__logo -->
          <?php $logo_html = ob_get_clean(); ?>
          <?php echo $logo_html; ?>

          <div class="demo-notice__title">
            <?php echo lang('demo_site'); ?>
          </div>
          <!-- /.demo-notice__title -->
          <div class="void demo-notice__balance-logo">
            <?php echo $logo_html; ?>
          </div>
          <!-- /.void -->
          <div class="demo-notice__close-wrap">
            <button class="demo-notice__close not-button-style click-extender" data-demo-pop-up-close-button="<?php echo $pop_up_name; ?>">
              <?php readfile(PATH_PREFIX . "/public/assets/img/close.svg"); ?>
            </button>
            <!-- /.demo-notice__close -->
          </div>
          <!-- /.demo-notice__close-wrap -->
        </div>
        <!-- /.demo-notice__header -->
        <div class="demo-notice__content">
          <div class="demo-text">
            <?php foreach ($demo_text as $paragraph): ?>
              <p class="demo-text__p">
                <?php echo $paragraph['text']; ?><?php if ($paragraph['link']): ?><a href="<?php echo $link; ?>" target="_blank" class="demo-text__link" rel="noopener noreferrer"><?php echo $paragraph['link']; ?></a>.<?php endif; ?>
              </p>
              <!-- /.demo-text__p -->
            <?php endforeach; ?>
          </div>
          <!-- /.demo-text -->
        </div>
        <!-- /.demo-notice__content -->
      </div>
      <!-- /.demo-notice -->
    </div>
    <!-- /.demo-pop-up__content -->
  </div>
  <!-- /.demo-pop-up__wrap -->
</div>
<!-- /.pop-up-for-demo -->