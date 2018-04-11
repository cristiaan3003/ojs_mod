<?php

/**
 * @file plugins/generic/openSNRD/OpenSNRDDAO.inc.php
 *
 * Copyright (c) 2014-2017 Simon Fraser University
 * Copyright (c) 2003-2017 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class OpenSNRDDAO
 * @ingroup plugins_generic_openSNRD
 *
 * @brief DAO operations for OpenSNRD.
 */

import('classes.oai.ojs.OAIDAO');


class OpenSNRDDAO extends OAIDAO {

	/**
	 * Set parent OAI object.
	 * @param JournalOAI
	 */
	function setOAI(&$oai) {
		$this->oai = $oai;
	}

	//
	// Records
	//

	/**
	 * Return set of OAI records matching specified parameters.
	 * @param $setIds array Objects ids that specify an OAI set, in this case only journal ID.
	 * @param $from int timestamp
	 * @param $until int timestamp
	 * @param $offset int
	 * @param $limit int
	 * @param $total int
	 * @param $funcName string
	 * @return array OAIRecord
	 */
	function &getOpenSNRDRecordsOrIdentifiers($setIds, $from, $until, $offset, $limit, &$total, $funcName) {
		$records = array();

		$result = $this->_getRecordsRecordSet($setIds, $from, $until, null);

		$total = $result->RecordCount();

		$result->Move($offset);
		for ($count = 0; $count < $limit && !$result->EOF; $count++) {
			$row = $result->GetRowAssoc(false);
			if ($this->isOpenSNRDRecord($row)) {
				$records[] = $this->_returnRecordFromRow($row);
			}
			$result->MoveNext();
		}

		$result->Close();
		return $records;
	}

	/**
	 * Check if it's an OpenSNRD record, if it contains snrdID.
	 * @param $row array of database fields
	 * @return boolean
	 */
	function isOpenSNRDRecord($row) {
		if (!isset($row['tombstone_id'])) {
			$params = array('snrdID', (int) $row['submission_id']);
			$result = $this->retrieve(
				'SELECT COUNT(*) FROM submission_settings WHERE setting_name = ? AND setting_value = \'100000\' AND setting_value <> \'\' AND submission_id = ?',
				$params
			);
			$returner = (isset($result->fields[0]) && $result->fields[0] == 0) ? true : false;
			$result->Close();
			return $returner;
		} else {
			$dataObjectTombstoneSettingsDao = DAORegistry::getDAO('DataObjectTombstoneSettingsDAO');
			return $dataObjectTombstoneSettingsDao->getSetting($row['tombstone_id'], 'opensnrd');
		}
	}

	/**
	 * Check if it's an OpenSNRD article, if it contains snrdID.
	 * @param $articleId int
	 * @return boolean
	 */
	function isOpenSNRDArticle($articleId) {
		$params = array('snrdID', (int) $articleId);
		$result = $this->retrieve(
			'SELECT COUNT(*) FROM submission_settings WHERE setting_name = ? AND setting_value = \'100000\' AND setting_value <> \'\' AND submission_id = ?',
			$params
		);
		$returner = (isset($result->fields[0]) && $result->fields[0] == 0) ? true : false;
		$result->Close();
		return $returner;
	}
}

?>
