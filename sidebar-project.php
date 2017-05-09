<?php

// Sidebar: Project

$services = get_the_terms( $post->ID, 'service' );
$issues = get_the_terms( $post->ID, 'issue' );
$team_members = get_post_meta( $post->ID, 'project_team_members', true );
$collaborators = get_post_meta( $post->ID, 'project_collaborators', true );
$partners = get_post_meta( $post->ID, 'project_partners', true );
$site = get_post_meta( $post->ID, 'project_site', true );
$site_url = get_post_meta( $post->ID, 'project_site_url', true );
?>

<?php if ( $services ) : ?>

<div class="project-sidebar__group u-mb-3 u-mt-0">
    <div class="h6 u-mt-0">Scope</div>
    <ul class="u-mt-1">
        <?php foreach( $services as $service ) : ?>
            <li><?php echo $service->name; ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<?php if ( $issues ) : ?>
<div class="project-sidebar__group u-mb-3 u-mt-0">
    <div class="h6 u-mt-0">Issues</div>
    <ul class="u-mt-1">
        <?php foreach( $issues as $issue ) : ?>
            <li><?php echo $issue->name; ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<?php if ( $team_members ) : ?>
<div class="project-sidebar__group u-mb-3 u-mt-0">
    <div class="h6 u-mt-0">Team Members</div>
    <ul class="u-mt-1">
        <?php foreach ( $team_members as $member ) : ?>
            <li><a href="<?php echo get_permalink($member); ?>" class="u-color-hover-green"><?php echo get_the_title( $member ); ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<?php if ( $collaborators ) : ?>
<div class="project-sidebar__group u-mb-3 u-mt-0">
    <div class="h6 u-mt-0">Collaborators</div>
    <ul class="u-mt-1">
        <?php foreach ( $collaborators as $collaborator ) : ?>
            <li><a href="<?php echo get_permalink($collaborator); ?>" class="u-color-hover-green"><?php echo get_the_title( $collaborator ); ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<?php if ( $partners ) : ?>
<div class="project-sidebar__group u-mb-3 u-mt-0">
    <div class="h6 u-mt-0">Partners</div>
    <ul class="u-mt-1">
        <?php foreach ( $partners as $partner ) : 
            $link_action = get_post_meta( $partner, 'member_link_action', true );
            $website = get_post_meta( $partner, 'member_website', true );
            $target = ( $link_action ) ? '_blank' : '_self';
            $url = ( $link_action ) ? esc_url( $website ) : get_permalink($partner); ?>
            <li>
                <a href="<?php echo $url; ?>" target="<?php echo $target; ?>" class="u-color-hover-green">
                    <?php echo get_the_title( $partner ); ?>
                    <?php echo ( $link_action ) ? '&nearr;' : ''; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<?php if ( $site && $site_url ) : ?>
<div class="project-sidebar__group u-mb-3 u-mt-0">
    <div class="h6">Project Site</div>
    <ul class="u-mt-1">
        <li><a href="<?php echo esc_url($site_url); ?>" target="_blank" class="u-color-hover-green"><?php echo $site . ' &nearr;'; ?></a></li>
    </ul>
</div>

<?php endif; ?>