<?php get_header(); ?>


<section class="catList">
  <div class="catList__inner inner">
    <!-- breadcrumb -->
    <?php get_template_part('_inc/breadcrumbs'); ?>
    <!-- /breadcrumb -->

    <div class="catList__head">
      <h2 class="catList__title">全ねこ一覧</h2>
    </div>

    <ul class="cat__lists">

      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>

          <li class="cat__list">
            <a href="<?php echo the_permalink(); ?>" class="cast__list__img hover">
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
                <div class="cat__list__label hover">
                  <?php
                  $post_object = get_field('cat_shop');
                  echo get_the_title($post_object);
                  ?>
                </div>
                <div class="cat__list__title"><?php echo the_title(); ?></div>
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

      <?php
        endwhile;
      endif; ?>

    </ul>

    <!-- pagenation -->
    <?php get_template_part('_inc/pager'); ?>

  </div><!-- /pagenation -->

  <div class="anotherPet__wrap">
    <div class="anotherPet__inner">
      <h3 class="catList__title">ほかにもこんな猫種が注目されています！</h3>
      <ul class="anotherPet__list">
        <li class="anotherPet__item hover">
          <a href="anotherPet__itemLink">
            <div class="anotherPet__catImg">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/typeList/4columns/01.png" alt="">
            </div>
            <p class="anotherPet__catName">スコティッシュ<br>フォールド</p>
          </a>
        </li>
        <li class="anotherPet__item hover">
          <a href="anotherPet__itemLink">
            <div class="anotherPet__catImg">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/typeList/4columns/03.png" alt="">
            </div>
            <p class="anotherPet__catName">メインクイーン</p>
          </a>
        </li>
        <li class="anotherPet__item hover">
          <a href="anotherPet__itemLink">
            <div class="anotherPet__catImg">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/typeList/4columns/04.png" alt="">
            </div>
            <p class="anotherPet__catName">エキゾチック<br>ショートヘア</p>
          </a>
        </li>
        <li class="anotherPet__item hover">
          <a href="anotherPet__itemLink">
            <div class="anotherPet__catImg">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/typeList/4columns/05.png" alt="">
            </div>
            <p class="anotherPet__catName">ラグドール</p>
          </a>
        </li>
      </ul>
    </div>
  </div>

  </div>
</section>
<!-- /.anotherPet -->

<?php get_footer(); ?>


</body>

</html>