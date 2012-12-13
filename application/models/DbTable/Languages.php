<?php
class Application_Model_DbTable_Languages extends Zend_Db_Table_Abstract
{
	protected $_name = 'languages';

	public function getLanguage($idlanguage)
	{
		$idlanguage = (int)$idlanguage;
		$row = $this->fetchRow('idlanguage = ' . $idlanguage);
		if (!$row) {
			throw new Exception("Could not find row $idlanguage");
		}
		return $row->toArray();
	}
	public function addLanguage($language)
	{
		$data = array(
				'language' => $language,
		);
		$this->insert($data);
	}
	public function updateLanguage($idlanguage, $language)
	{
		$data = array(
				'language' => $language,
		);
		$this->update($data, 'idlanguage = '. (int)$idlanguage);
	}
	public function deleteLanguage($idlanguage)
	{
		$this->delete('idlanguage =' . (int)$idlanguage);
	}
}
?>