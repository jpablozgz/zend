<?php
class Application_Model_DbTable_Pets extends Zend_Db_Table_Abstract
{
	protected $_name = 'pets';

	public function getPet($idpet)
	{
		$idpet = (int)$idpet;
		$row = $this->fetchRow('idpet = ' . $idpet);
		if (!$row) {
			throw new Exception("Could not find row $idpet");
		}
		return $row->toArray();
	}
	public function addPet($pet)
	{
		$data = array(
				'pet' => $pet,
		);
		$this->insert($data);
	}
	public function updatePet($idpet, $pet)
	{
		$data = array(
				'pet' => $pet,
		);
		$this->update($data, 'idpet = '. (int)$idpet);
	}
	public function deletePet($idpet)
	{
		$this->delete('idpet =' . (int)$idpet);
	}
}
?>