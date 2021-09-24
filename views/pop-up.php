<div class="pop-up-for-demo demo-pop-up demo-pop-up_<?php echo $lang_name; ?> <?php echo $shimmering ? 'demo-pop-up_shimmering' : ''; ?> <?php echo $hidden ? ' hidden disabled' : ''; ?>" data-demo-pop-up="<?php echo $pop_up_name; ?>" <?php echo $data_pop_up_do_not_show_scroll_bar_on_hide ? 'data-demo-pop-up-do-not-show-scroll-bar-on-hide' : ''; ?>>
  <div class="demo-pop-up__background"></div>
  <div class="demo-pop-up__wrap">

    <div class="demo-pop-up__content container-size" data-demo-pop-up-content>
      <?php if ($closing_cross): ?>
        <button class="demo-pop-up__closing-cross-button" data-demo-pop-up-close-button="<?php echo $pop_up_name; ?>">
          <div class="demo-pop-up__closing-cross-wrap">
            <img src="/img/close.svg" alt="<?php echo lang('close'); ?>" class="demo-pop-up__closing-cross click-extender">
          </div>
          <!-- /.demo-pop-up__closing-cross-wrap -->
        </button>
        <!-- /.demo-pop-up__closing-cross-button -->
      <?php endif; ?>
      <?php if ($with_logo): ?>
        <div class="demo-pop-up__logo-block">
          <div class="name-logo demo-pop-up__logo-block">
            <span><?php echo lang('by'); ?> <span class="name-logo__name"><?php echo lang('by_my_name'); ?></span></span>
            
          </div>
          <!-- /.name-logo -->
        </div>
        <!-- /.demo-pop-up__logo-block -->
      <?php endif; ?>
      <div class="demo-pop-up__title page-title page-title_free-transform page-title_mini">
        <?php echo $title; ?>
      </div>
      <!-- /.demo-pop-up__title -->
      <div class="demo-pop-up__text">
        <?php foreach ($demo_text as $paragraph): ?>
          <p class="demo-pop-up__p">
            <?php echo $paragraph['text']; ?><?php if ($paragraph['link']): ?><a href="<?php echo $link; ?>" target="_blank" class="demo-pop-up__link" rel="noopener noreferrer"><?php echo $paragraph['link']; ?></a>.<?php endif; ?>
          </p>
          <!-- /.demo-pop-up__p -->
        <?php endforeach; ?>
      </div>
      <!-- /.demo-pop-up__text -->
      <div class="demo-pop-up__button-block">
        <?php if ($buttons) { ?>
          <?php foreach ($buttons as $button): ?>
            <<?php if ($button['is_link']) { ?>a href="<?php echo $button['link']; ?>" target="_blank"<?php } else { ?>div<?php }; ?> class="accent-button accent-button_extra-wide <?php echo $button['is_solid'] ? 'accent-button_solid' : 'accent-button_secondary accent-button_regular'?> demo-pop-up__button" <?php if ($button['close']): ?>data-demo-pop-up-close-button="<?php echo $pop_up_name; ?>"<?php endif; ?>>
              <span class="accent-button__text"><?php echo $button['text']; ?></span>
            </<?php if ($button['is_link']) { ?>a<?php } else { ?>div<?php } ?>>
            <!-- /.accent-button -->
          <?php endforeach; ?>
        <?php } else { ?>
          <button class="accent-button accent-button_extra-wide accent-button_solid demo-pop-up__button" data-demo-pop-up-close-button="<?php echo $pop_up_name; ?>">
            <span class="accent-button__text"><?php echo lang('hide_notification'); ?></span>
          </button>
          <!-- /.accent-button -->
        <?php }; ?>
      </div>
      <!-- /.demo-pop-up__button-block -->
      <noscript class="demo-pop-up__noscript">
        <?php echo lang('enable_js'); ?>
      </noscript>
      <!-- /.demo-pop-up__noscript -->
    </div>
    <!-- /.demo-pop-up__content -->

  </div>
  <!-- /.demo-pop-up__wrap -->
</div>
<!-- /.pop-up-for-demo -->