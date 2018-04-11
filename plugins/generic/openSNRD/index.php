<?php

/**
 * @defgroup plugins_generic_openSNRD OpenSNRD Plugin
 */
 
/**
 * @file plugins/generic/openSNRD/index.php
 *
 * Copyright (c) 2014-2017 Simon Fraser University
 * Copyright (c) 2003-2017 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @ingroup plugins_generic_openSNRD
 * @brief Wrapper for openSNRD plugin.
 *
 */
require_once('OpenSNRDPlugin.inc.php');

return new OpenSNRDPlugin();

?>
