<?php get_header(); ?>

<section class="page-shopDetail">
  <div class="mainvisual">
    <div class="mainvisual__img inner">

      <?php get_template_part('_inc/breadcrumbs'); ?>

      <!-- breadcrumb__inner inner -->
      <img src="<?php echo get_field('shop_img'); ?>" alt="<?php echo the_title(); ?>">
    </div>
  </div><!-- mainvisual -->

  <section class="access">
    <div class="inner">
      <h2 class="section__title"><?php echo the_title(); ?>の基本情報</h2>
      <div class="access__inner">
        <div class="access__text">
          <dl>
            <dt>住所</dt>
            <dd><?php echo get_field('shop_address'); ?></dd>
            <dt>TEL</dt>
            <dd><?php echo get_field('shop_tel'); ?></dd>
            <dt>営業時間</dt>
            <dd><?php echo get_field('shop_hours'); ?></dd>
            <dd>休日：年中無休</dd>
            <dt>アクセス</dt>
            <dd><?php echo get_field('shop_access'); ?></dd>
          </dl>
        </div><!-- access__text -->

        <div class="access__map">
          <dd><?php echo get_field('shop_map'); ?></dd>
        </div><!-- access__map -->
      </div><!-- access__inner -->
    </div><!-- inner -->
  </section><!-- access -->

  <section class="catlist">
    <div class="inner">
      <h2 class="section__title"><?php echo the_title(); ?>の新入りの猫ちゃん</h2>
      <ul class="catlist__items">


        <?php
        $taxonomy = 'hand_shop_type';
        $term_slug = $post->post_name;
        $args = array(
          'tax_query' => array(
            array(
              'taxonomy' => $taxonomy,
              'field' => 'slug',
              'terms' => $term_slug
            ),
          ),
          'post_type' => 'cat', //ポストタイプのスラッグ
          'order' => 'ASC', //並び順
          'posts_per_page' => 3
        );
        $my_query = new WP_Query($args); //インスタンス

        if ($my_query->have_posts()) :
          while ($my_query->have_posts()) : $my_query->the_post();
        ?>

            <li class="catlist__item">
              <a href="<?php echo the_permalink(); ?>">

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


                <h3 class="catlist__item__title">アメリカンショートヘア</h3>
                <dl>
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
              </a>
            </li><!-- catlist__item 1-->


        <?php endwhile;
        endif;
        wp_reset_postdata(); ?>


      </ul>

      <div class="btn">
        <a href="<?php echo get_term_link($term_slug, $taxonomy); ?>" class="btn__item">この店舗の猫ちゃんを見る</a>
      </div><!-- btn__item -->

    </div><!-- inner -->
  </section><!-- catlist -->

  <section class="concept">
    <div class="inner">
      <h2 class="section__title">店長よりごあいさつ</h2>
      <div class="concept__inner">
        <div class="concept__left">
          <img src="<?php echo get_field('shop_manager_img'); ?>" alt="<?php echo the_title(); ?>">
        </div><!-- concept__left -->

        <div class="concept__right">
          <h3 class="concept__subtitle"><?php echo get_field('shop_manager_title'); ?></h3>
          <p class="concept__text"><?php echo get_field('shop_manager_text'); ?></p>
        </div><!-- concept__right -->
      </div><!-- concept__inner -->
    </div><!-- inner -->
  </section><!-- concept -->

  <section class="blog">
    <div class="inner">
      <h2 class="section__title"><?php echo the_title(); ?>の最新ブログ</h2>

      <ul class="blog__items">

        <?php
        $taxonomy = 'input_shop_type';
        $term_slug = $post->post_name;
        $args = array(
          'tax_query' => array(
            array(
              'taxonomy' => $taxonomy,
              'field' => 'slug',
              'terms' => $term_slug
            ),
          ),
          'post_type' => 'blog', //ポストタイプのスラッグ
          'order' => 'ASC', //並び順
          'posts_per_page' => 3
        );
        $my_query = new WP_Query($args); //インスタンス

        if ($my_query->have_posts()) :
          while ($my_query->have_posts()) : $my_query->the_post();
        ?>


            <li class="blog__item">
              <a href="#">
                <img src="<?php echo get_field('blog_img'); ?>" alt="<?php echo the_title(); ?>">
                <div class="blog__item__text">
                  <p class="date"><?php echo the_time('Y.m.d'); ?></p>
                  <h3 class="blog__subtitle"><?php echo the_title(); ?></h3>
                  <div class="blog__text"><?php echo the_content(); ?></div>
                  <div class="blog__tagItems">
                    <?php the_tags('<div class="tag top_tag">', '</div><div class="tag top_tag">', '</div>') ?>
                  </div>
                </div><!-- blog__item__text -->
              </a>
            </li><!-- blog__item -->

        <?php endwhile;
        endif;
        wp_reset_postdata(); ?>


      </ul><!-- blog__items-->

      <div class="btn">
        <a href="<?php echo get_term_link($term_slug, $taxonomy); ?>" class="btn__item">この店舗のブログを見る</a>
      </div><!-- btn__item -->

    </div><!-- inner -->
  </section><!-- blog -->
</section>

<?php get_footer(); ?>

</body>

</html>