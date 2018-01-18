<?php 

class log {

	public function logaction($log, $wonum, $user) {
		global $conn;
		$time = date('d/m/Y H:i:s');
		$stmt = $conn->prepare("INSERT INTO logs (user, notification, work_order, accessed) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $user, $log, $wonum, $time);
        $stmt->execute();
        $stmt->close();



	}


}



?>