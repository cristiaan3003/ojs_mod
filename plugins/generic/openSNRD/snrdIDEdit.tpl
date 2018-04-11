{**
 * plugins/generic/openSNRD/snrdIDEdit.tpl
 *
 * Copyright (c) 2014-2017 Simon Fraser University
 * Copyright (c) 2003-2017 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Edit OpenSNRD snrdID 
 *
 *}
{fbvFormArea id="openSNRD"}
	{fbvFormSection label="plugins.generic.openSNRD.snrdID" for="source" description="plugins.generic.openSNRD.snrdID.description"}
		{fbvElement type="text" name="snrdID" id="snrdID" value=$snrdID maxlength="255" readonly=$readOnly}
	{/fbvFormSection}
{/fbvFormArea}
