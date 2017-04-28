<?php 

// Filters: Projects

?>

<ul class="filter-toggle-list list">
    <li class="filter-toggle-list__item list__item">
        <a href="#filter-group-services" data-target="#filter-group-services" class="filter-group-toggle is-active js-fade-toggle">Services</a>
    </li>
    <li class="filter-toggle-list__item list__item">
        <a href="#filter-group-issues" data-target="#filter-group-issues" class="filter-group-toggle js-fade-toggle">Issues</a>
    </li>
    <li class="filter-toggle-list__item list__item">
        <a href="#filter-group-date" data-target="#filter-group-date" class="filter-group-toggle js-fade-toggle">Date</a>
    </li>
    <li class="filter-toggle-list__item list__item">
        <a href="#filter-group-status" data-target="#filter-group-status" class="filter-group-toggle js-fade-toggle">Status</a>
    </li>
    <li class="filter-toggle-list__item list__item">
        <a href="#filter-group-location" data-target="#filter-group-location" class="filter-group-toggle js-fade-toggle">Location</a>
    </li>
</ul>

<div class="filter-groups">

    <?php 
    // SERVICES 

    $services = get_terms( array( 'taxonomy' => 'service', 'hide_empty' => false, 'parent' => 0 ) );
    if ( $services ) : ?>

        <ul id="filter-group-services" class="filter-group is-active list u-mt-2">

            <?php foreach ( $services as $service ) : 
            $children = get_terms( array( 'taxonomy' => 'service', 'hide_empty' => false, 'parent' => $service->term_id ) ); ?>

                <li class="list__item u-mt-1"> 
                    <span class="u-caps"><?php echo $service->name; ?></span>
                </li>

                <?php foreach( $children as $child ) : ?>
                    <li class="list__item">
                        <a href="#" data-filter="<?php echo $child->slug ?>" class="filter-group__item u-color-hover-orange"><?php echo $child->name; ?></a>
                    </li>
                <?php endforeach; ?>

            <?php endforeach; ?>

        </ul>

    <?php endif; ?>

    <?php 
    // Issues 

    $issues = get_terms( array( 'taxonomy' => 'issue', 'hide_empty' => false ) );
    if ( $issues ) : ?>

        <ul id="filter-group-issues" class="filter-group is-active list u-mt-2">

            <?php foreach ( $issues as $issue ) : ?>

                <li class="list__item">
                    <a href="#" data-filter="<?php echo $issue->slug ?>" class="filter-group__item u-color-hover-orange"><?php echo $issue->name; ?></a>
                </li>

            <?php endforeach; ?>

        </ul>

    <?php endif; ?>

    <ul id="filter-group-date" class="filter-group list u-mt-2">
        <li class="list__item">
            <a href="#" class="filter-group__item u-color-hover-orange">Last Month</a>
        </li>
        <li class="list__item">
            <a href="#" class="filter-group__item u-color-hover-orange">Last 3 Months</a>
        </li>
        <li class="list__item">
            <a href="#" class="filter-group__item u-color-hover-orange">Last 6 Months</a>
        </li>
        <li class="list__item">
            <a href="#" class="filter-group__item u-color-hover-orange">Last Year</a>
        </li>
        <li class="list__item">
            <a href="#" class="filter-group__item u-color-hover-orange">Last 3 Years</a>
        </li>
    </ul>

</div>