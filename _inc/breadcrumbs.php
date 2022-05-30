<nav>
  <ol class="breadcrumbs">
    <li class="breadcrumbs__item"><a href="<?php echo home_url(); ?>" class="breadcrumbs__link">ホーム</a></li>

    <!-- ブログ一覧 -->
    <?php if (is_post_type_archive('blog')) : ?>
      <li class="breadcrumbs__item">ブログ一覧</li>


      <!-- ブログ詳細 -->
    <?php elseif (is_singular('blog')) : ?>
      <li class="breadcrumbs__item"><a href="<?php echo get_post_type_archive_link('blog'); ?>" class="breadcrumbs__link">ブログ一覧</a></li>
      <li class="breadcrumbs__item"><?php echo the_title(); ?></li>


      <!-- ショップ一覧 -->
    <?php elseif (is_post_type_archive('shop')) : ?>
      <li class="breadcrumbs__item">ショップ一覧</li>


      <!-- ショップ詳細 -->
    <?php elseif (is_singular('shop')) : ?>
      <li class="breadcrumbs__item"><a href="<?php echo get_post_type_archive_link('shop'); ?>" class="breadcrumbs__link">ショップ一覧</a></li>
      <li class="breadcrumbs__item"><?php echo the_title(); ?></li>


      <!-- 猫種詳細 -->
    <?php elseif (is_singular('cat')) : ?>
      <li class="breadcrumbs__item"><a href="<?php echo get_post_type_archive_link('cat'); ?>" class="breadcrumbs__link">猫種一覧</a></li>
      <li class="breadcrumbs__item"><?php echo the_title(); ?></li>
      <li class="breadcrumbs__item">猫ちゃん詳細</li>

      <!-- 猫種一覧（固定ページ） -->
    <?php elseif (is_page('cat_type')) : ?>
      <li class="breadcrumbs__item">猫種一覧</li>


      <!-- 猫種詳細一覧（タクソノミー） -->
    <?php elseif (is_tax('cat_type')) : ?>
      <li class="breadcrumbs__item"><a href="<?php echo get_permalink(get_page_by_path('cat_type')->ID); ?>" class="breadcrumbs__link">猫種一覧</a></li>
      <li class="breadcrumbs__item"><?php echo single_term_title(); ?></li>


      <!-- タグの一覧 -->
    <?php elseif (is_tag()) : ?>
      <li class="breadcrumbs__item"><a href="<?php echo get_post_type_archive_link('blog'); ?>" class="breadcrumbs__link">ブログ一覧</a></li>
      <li class="breadcrumbs__item"><?php echo single_term_title(); ?></li>

    <?php endif; ?>

  </ol>
</nav>