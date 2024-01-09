<?php 
class ExpedisiController{

	private $table='expedisi';
	private $primary_key='id';
	private $conn;

	public function __construct() {
		require '../config/conn.php';
		$this->conn = $conn;
	}

	public function data()
	{
		return $data=[
			[
				'rate_name'=>'jne',
				'name'=>'JNE',
				'status'=>0,
			],
			[
				'rate_name'=>'pos',
				'name'=>'POS',
				'status'=>0,
			],
			[
				'rate_name'=>'tiki',
				'name'=>'TIKI',
				'status'=>0,
			],
			[
				'rate_name'=>'rpx',
				'name'=>'RPX',
				'status'=>0,
			],
			[
				'rate_name'=>'pandu',
				'name'=>'Pandu Logistik',
				'status'=>0,
			],
			[
				'rate_name'=>'wahana',
				'name'=>'Wahana',
				'status'=>0,
			],
			[
				'rate_name'=>'sicepat',
				'name'=>'Sicepat',
				'status'=>0,
			],
			[
				'rate_name'=>'jnt',
				'name'=>'J&T',
				'status'=>0,
			],
			[
				'rate_name'=>'pahala',
				'name'=>'Pahala Express',
				'status'=>0,
			],
			[
				'rate_name'=>'sap',
				'name'=>'SAP',
				'status'=>0,
			],
			[
				'rate_name'=>'jet',
				'name'=>'Jet Express',
				'status'=>0,
			],
			[
				'rate_name'=>'indah',
				'name'=>'Indah Cargo',
				'status'=>0,
			],
			[
				'rate_name'=>'dse',
				'name'=>'DSE Logistic',
				'status'=>0,
			],
			[
				'rate_name'=>'slis',
				'name'=>'Solusi Express',
				'status'=>0,
			],
			[
				'rate_name'=>'first',
				'name'=>'First Logistics',
				'status'=>0,
			],
			[
				'rate_name'=>'ncs',
				'name'=>'NCS kurir',
				'status'=>0,
			],
			[
				'rate_name'=>'star',
				'name'=>'Star Logistics',
				'status'=>0,
			],
			[
				'rate_name'=>'ninja',
				'name'=>'Ninja Express',
				'status'=>0,
			],
			[
				'rate_name'=>'lion',
				'name'=>'Lion Parcel',
				'status'=>0,
			],
			[
				'rate_name'=>'idl',
				'name'=>'IDL Cargo',
				'status'=>0,
			],
			[
				'rate_name'=>'rex',
				'name'=>'REX',
				'status'=>0,
			],
			[
				'rate_name'=>'sentral',
				'name'=>'Sentral Cargo',
				'status'=>0,
			],
			[
				'rate_name'=>'jtl',
				'name'=>'HTL Express',
				'status'=>0,
			],
		];
	}

	public function insert()
	{
		$query = "INSERT INTO expedisi (id, rate_name, name, status) VALUES ('', '{$value['rate_name']}', '{$value['name']}', '{$value['status']}')";
		if ($conn->query($query) === TRUE) {
			echo "Rekaman baru berhasil dibuat";
		} else {
			echo "Error: " . $query . "<br>" . $conn->error;
		}
	}

	public function get() {
		$query = "SELECT id, rate_name, name, status FROM {$this->table}";
		$result = $this->conn->query($query);

		if ($result->num_rows > 0) {
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		} else {
			return array();
		}
	}

	public function getActive()
	{
		$query = "SELECT id, rate_name, name, status FROM {$this->table} WHERE status=1";
		$result = $this->conn->query($query);

		if ($result->num_rows > 0) {
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		} else {
			return array();
		}
	}

	public function updateStatus($id, $status) {
		$query = "UPDATE {$this->table} SET status = '$status' WHERE id = '$id'";

		if ($this->conn->query($query) === TRUE) {
            return true; // Update data berhasil
        } else {
            return false; // Update data gagal
        }
    }
}
?>