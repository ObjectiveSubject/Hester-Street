<?php $id = sanitize_key( get_sub_field( 'section_title' ) ); ?>

<section id="<?php echo $id; ?>" class="section">
    <div class="u-container">
        <div class="flex">
            <div class="section__content flex__item">
                <div class="module module--basic-sidebar u-pt-6">

                    <?php if ( get_sub_field( 'section_title' ) ) : ?>
                        <div class="module__title">
                            <h4><?php the_sub_field( 'section_title' ); ?></h4>
                        </div>
                    <?php endif; ?>

                    <div class="u-clearfix">

                        <?php 
                        $layout = get_sub_field( 'basic_sidebar_layout' );
                        switch ( $layout) {
                            case 'one-one':
                                $main_width = 'u-span-6';
                                $aside_width = 'u-span-6';
                                break;
                            case 'three-one':
                                $main_width = 'u-span-9';
                                $aside_width = 'u-span-3';
                                break;
                            default:
                                $main_width = 'u-span-8';
                                $aside_width = 'u-span-4';
                        }
                        ?>

                        <?php if ( get_sub_field( 'basic_sidebar_main_content' ) ) : ?>
                            <main class="module__main-content <?php echo $main_width; ?>">
                                <?php the_sub_field( 'basic_sidebar_main_content' ); ?>
                            </main>
                        <?php endif; ?>

                        <?php if ( get_sub_field( 'basic_sidebar_aside_content' ) ) : ?>
                            <aside class="module__aside-content <?php echo $aside_width; ?>">
                                <?php the_sub_field( 'basic_sidebar_aside_content' ); ?>
                            </aside>
                        <?php endif; ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>