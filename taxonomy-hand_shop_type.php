<?php get_header(); ?>


<section class="catList">
  <div class="catList__inner inner">
    <!-- breadcrumb -->
    <?php get_template_part('_inc/breadcrumbs'); ?>
    <!-- /breadcrumb -->

    <div class="catList__head">
      <h2 class="catList__title"><?php echo single_term_title(); ?>の一覧</h2>
    </div>

    <ul class="cat__lists">

      <?php
      $type = get_query_var('hand_shop_type');
      $paged = get_query_var('paged') ? get_query_var('paged') : 1;
      $args = array(
        'tax_query' => array(
          array(
            'taxonomy' => 'hand_shop_type',
            'field' => 'slug',
            'terms' => $type
          ),
        ),
        'post_type' => 'cat', //ポストタイプのスラッグ
        'order' => 'DESC', //並び順
        'paged' => $paged
      );
      $my_query = new WP_Query($args); //インスタンス
      $pages = $my_query->max_num_pages;
      $wp_query->max_num_pages = $pages;
      if ($my_query->have_posts()) :
        while ($my_query->have_posts()) : $my_query->the_post();
      ?>


          <li class="cat__list">
            <a href="#" class="cast__list__img hover">
              <?php foreach (SCF::get('ねこちゃんのサムネイル画像') as $field_name => $field_value) : ?>
                <?php
                $carousel_thumbnail = wp_get_attachment_image_src($field_value['cat_img'], 'large');
                $carousel_thumbnail = esc_url($carousel_thumbnail[0]);
                if (!$carousel_thumbnail) {
                  $carousel_thumbnail = 'https://placehold.jp/584x340.png';
                }
                ?>
                <img src="<?php echo $carousel_thumbnail; ?>" alt="<?php echo the_title(); ?>">
              <?php break;
              endforeach; ?>
            </a>
            <div class="cat__list__body">
              <div class="cat__list__head">
                <div href="#" class="cat__list__label hover">
                  <?php
                  $post_object = get_field('cat_shop');
                  echo get_the_title($post_object);
                  ?>
                </div>
                <div href="#" class="cat__list__title"><?php echo the_title(); ?></div>
              </div>
              <dl class="cat__list__content">
                <dt>生年月日</dt>
                <dd><?php echo get_field('cat_birthday'); ?></dd>
                <dt>性別</dt>
                <dd>
                  <?php if (get_field('cat_sex') === "men") {
                    echo "オス";
                  } else {
                    echo "メス";
                  }
                  ?>
                </dd>
                <dt>生体価格</dt>
                <dd><span class="cat__price"><?php echo get_field('cat_price'); ?></span>円（税抜）</dd>
              </dl>
              <div class="cat__list__footer">
                <div class="cat__list__footer--store-more">
                  <a href="<?php the_permalink($post_object); ?>" class="more__link more--store hover">お取扱い店舗を見る</a>
                </div>
                <div class="cat__list__footer--cat__more">
                  <a href="<?php the_permalink(); ?>" class="more__link more--cat hover">この猫を詳しく見る</a>
                </div>
              </div>
            </div>
          </li>


        <?php endwhile; ?>
      <?php else : ?>
        <p style="font-size: 16px;">該当する猫ちゃんが見つかりませんでした。</p>
      <?php endif; ?>

    </ul>

    <!-- pagenation -->
    <?php get_template_part('_inc/pager'); ?>



    <div class="about__store">

      <?php
      $term_id = get_queried_object_id();
      $term_idsp = "hand_shop_type_" . $term_id; //タクソノミーの名前＋タームIDが必要
      $post_object = get_field('link_shop', $term_idsp);
      $image = get_post_meta($post_object, 'shop_img', true);
      $size = 'full';
      // $post_object_num = $post_object->ID;
      ?>

      <a href="#" class="about__store__img hover">
        <?php echo wp_get_attachment_image($image, $size); ?>
      </a>
      <div class="about__store__body">
        <div class="about__store__head">
          <a href="#" class="store__list__title hover"><?php echo get_the_title($post_object); ?></a>
        </div>
        <dl class="about__store__content">
          <dt>住所</dt>
          <dd><?php echo get_post_meta($post_object, 'shop_address', true) ?></dd>
          <dt>TEL</dt>
          <dd><?php echo get_post_meta($post_object, 'shop_tel', true) ?></dd>
          <dt>営業時間</dt>
          <dd><?php echo get_post_meta($post_object, 'shop_hours', true) ?></dd>
        </dl>
        <div class="about__store__footer">
          <a href="<?php echo get_permalink($post_object); ?>" class="util__link">お取扱い店舗を見る</a>
        </div>
      </div>
    </div>

  </div><!-- /pagenation -->
</section>
<!-- /.anotherPet -->

<?php get_footer(); ?>


</body>

</html>