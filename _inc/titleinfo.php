<title>
  <?php bloginfo('name'); ?>|

  <?php if (is_front_page()) : //トップページ 
  ?>
    安心・安全な猫専門ペットショップ
  <?php elseif (is_post_type_archive('shop')) : ?>
    店舗記事一覧
  <?php elseif (is_post_type_archive('blog')) : ?>
    ブログ記事一覧
  <?php elseif (is_post_type_archive('cat')) : ?>
    猫ちゃん一覧
  <?php elseif (is_page('cat_type') || is_tag() || is_single()) : ?>
    <?php wp_title(''); ?>
  <?php elseif (is_tax('cat_type')) : ?>
    <?php single_term_title(); ?>
  <?php elseif (is_tax('input_shop_type')) : ?>
    <?php single_term_title(); ?>ブログ
  <?php elseif (is_tax('hand_shop_type')) : ?>
    <?php single_term_title(); ?>の猫ちゃん一覧
  <?php
  elseif (is_404()) : //404ページ
    echo '404:ページが存在しません。';
  endif;
  ?>

</title>