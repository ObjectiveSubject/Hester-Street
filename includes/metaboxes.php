<?php
/**
 * Metaboxes
 *
 * Metaboxes are segmented by concerns to make the codebase more manageable
 * Create a new file under the metaboxes directory when appropriate.
 */

require_once HSC_INC . 'metaboxes/events.php';
require_once HSC_INC . 'metaboxes/posts.php';
require_once HSC_INC . 'metaboxes/team-members.php';

// Add General metabox first, so it always appears at top
HSC\MetaBoxes\Events\setup();
HSC\MetaBoxes\Posts\setup();
HSC\MetaBoxes\TeamMembers\setup();

// Add other metaboxes here
