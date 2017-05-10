<?php
/**
 * API
 *
 * Aggregates the api files from the api directory
 * Create a new file under the metaboxes directory when appropriate.
 */

require_once HSC_INC . 'api/projects.php';
require_once HSC_INC . 'api/posts-events.php';
require_once HSC_INC . 'api/project-timelines.php';

HSC\API\Projects\setup();
HSC\API\PostsEvents\setup();
HSC\API\ProjectTimelines\setup();