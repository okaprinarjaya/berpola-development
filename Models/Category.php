<?php
class Category extends Model {
	public function createCategory(array $data) {
		$dbh = $this->getConnection();
		$sth = $dbh->prepare("INSERT INTO category (name) VALUES (?)");

		$save = false;

		try {
			$save = $sth->execute(array($data['name']));

		} catch (Exception $e) {
			$save = false;
		}

		return $save;
	}

	public function editCategory($id, array $data) {
		$dbh = $this->getConnection();
		$sth = $dbh->prepare("UPDATE category SET name=? WHERE id=?");

		$save = false;

		try {
			$save = $sth->execute(array($data['name'],$id));

		} catch (Exception $e) {
			$save = false;
		}

		return $save;		
	}

	public function findAllCategory($resultType = 'keyval') {
		$data = array();

		$dbh = $this->getConnection();
		$sth = $dbh->query("SELECT * FROM category");
		$sth->setFetchMode(PDO::FETCH_ASSOC);

		while ($row = $sth->fetch()) {
			
			if ($resultType == 'keyval') {
				$item = array();

				$item['id'] = $row['id'];
				$item['name'] = $row['name'];

				array_push($data, $item);

			} else if ($resultType == 'list') {
				$data[$row['id']] = $row['name'];
			}

			
		}

		return $data;
	}
}