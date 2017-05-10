<?php $id = sanitize_key( get_sub_field( 'section_title' ) ); ?>

<section id="<?php echo $id; ?>" class="section">
    <div class="u-container">
        <div class="flex">
            <div class="section__content flex__item <?php echo 'u-' . get_sub_field( 'basic_layout' ); ?>">
                <div class="module module--basic u-pt-6">

                    <?php if ( get_sub_field( 'section_title' ) ) : ?>
                        <div class="module__title">
                            <h4><?php the_sub_field( 'section_title' ); ?></h4>
                        </div>
                    <?php endif; ?>

                    <?php if ( get_sub_field( 'basic_content' ) ) : ?>
                        <div class="module__content">
                            <?php the_sub_field( 'basic_content' ); ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</section>