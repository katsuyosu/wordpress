<?php get_header(); ?>


<!-- main -->
<main class="main cntInner inner">
  <!-- パンくずリスト -->
  <?php get_template_part('_inc/breadcrumbs'); ?>
  <!-- /パンくずリスト -->
  <!-- content -->
  <section class="content">
    <div class="archive">
      <div class="archive__wrap">


        <?php
        $type = get_query_var('input_shop_type');
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $args = array(
          'tax_query' => array(
            array(
              'taxonomy' => 'input_shop_type',
              'field' => 'slug',
              'terms' => $type
            ),
          ),
          'post_type' => 'blog', //ポストタイプのスラッグ
          'order' => 'DESC', //並び順
          'paged' => $paged
        );
        $my_query = new WP_Query($args); //インスタンス
        $pages = $my_query->max_num_pages;
        $wp_query->max_num_pages = $pages;
        if ($my_query->have_posts()) :
          while ($my_query->have_posts()) : $my_query->the_post();
        ?>
            <div class="archive__card">
              <a href="<?php the_permalink(); ?>" class="archive__cardLink">
                <div class="archive__cardWrap">
                  <div class="archive__img">
                    <img src="<?php echo get_field('blog_img'); ?>" alt="<?php echo the_title(); ?>">
                  </div>
                  <div class="archive__content">
                    <span class="date"><?php echo the_time('Y.m.d') ?></span>
                    <div class="archive__ttl"><?php echo the_title(); ?></div>
                    <div class="archive__txt"><?php echo the_content(); ?></div>
                  </div>
                </div>
              </a>
              <div class="archive__tagItems">
                <?php the_tags('<div class="tag top_tag">', '</div><div class="tag top_tag">', '</div>') ?>
              </div>
            </div>
        <?php endwhile;
        endif; ?>
      </div>
    </div>


    <?php get_template_part('_inc/sidebar'); ?>

  </section>
  <!-- /content -->
</main>
<!-- /main -->
<section class="storeInfo">

  <?php
  $term_id = get_queried_object_id();
  $term_idsp = "input_shop_type_" . $term_id; //タクソノミーの名前＋タームIDが必要
  $post_object = get_field('link_shop', $term_idsp);
  $image = get_post_meta($post_object, 'shop_img', true);
  $size = 'full';
  // $post_object_num = $post_object->ID;
  ?>

  <div class="storeInfo__img">
    <?php echo wp_get_attachment_image($image, $size); ?>
  </div>
  <div class="storeInfo__content">
    <h3 class="storeInfo__ttl"><?php echo get_the_title($post_object); ?></h3>
    <table class="storeInfo__tbl">
      <tr class="storeInfo__items">
        <td class="storeInfo__label">住所</td>
        <td class="storeInfo__cnt"><?php echo get_post_meta($post_object, 'shop_address', true) ?></td>
      </tr>
      <tr class="storeInfo__items">
        <td class="storeInfo__label">TEL</td>
        <td class="storeInfo__cnt"><?php echo get_post_meta($post_object, 'shop_tel', true) ?></td>
      </tr>
      <tr class="storeInfo__items">
        <td class="storeInfo__label">営業時間</td>
        <td class="storeInfo__cnt"><?php echo get_post_meta($post_object, 'shop_hours', true) ?>
        </td>
      </tr>
    </table>
    <a href="<?php echo get_permalink($post_object); ?>" class="storeInfo__link link__btn"><span class="link__content">店舗の基本情報を見る</span></a>
  </div>
</section>


<?php get_footer(); ?>
</body>

</html>