<?php 
include 'connection.php';
include 'function.php';
ob_start();
session_start();



//Admin - Rezervasyon Sil
if ($_GET['addStock']=="deleteReservation") {
	islemKontrol();
	$delete=$conn->prepare("DELETE from reservations where reservationid=:id");
	$push=$delete->execute(array(
		'id' => $_GET['reservationid']
		));
	if ($push) {
		$increaseStock=$conn->prepare("UPDATE cars SET stock=stock+1 WHERE
                    car_id=:carid
                    ");
                    $increase=$increaseStock->execute(array(
                    'carid' => $_GET['carid']
        ));
		header("location:admin_reservations.php?addStock=successfull_deleteReservation");
		exit;
	} else {
		header("location:admin_cars.php?addStock=error_deleteReservation");
		exit;
	}
}

//Admin - Arabaya repair car Ekleme
if ($_GET['addStock']=="increase_repair_car") {
	islemKontrol();
	if($_GET['atRepair'] <= $_GET['totalCarNumber'] && $_GET['stockCarNumber'] > 0 ){
		$delete=$conn->prepare("UPDATE cars SET atRepair=atRepair+1,stock=stock-1 WHERE car_id=:carid");
	$push=$delete->execute(array(
		'carid' => $_GET['car_id']
		));
		if ($push){
		header("location:admin_cars.php?addStock=basarili_increase");
		} else {
		header("location:admin_cars.php?addStock=basarisiz_increase");
		}
	}else{
		header("location:admin_cars.php?addStock=reachedMax");
	}
}

//Admin - Arabadan repair car  Çıkarma
if ($_GET['addStock']=="decrease_repair_car") {
	islemKontrol();
    if($_GET['atRepair'] > 0){
        $decrease=$conn->prepare("UPDATE cars SET atRepair=atRepair-1,stock=stock+1 where car_id=:carid");
	$push=$decrease->execute(array(
		'carid' => $_GET['car_id']
		));
        if ($push) {
            header("Location:admin_cars.php?addStock=basarili_decrease");
			exit;
        } else {
            header("location:admin_cars.php?addStock=basarisiz_decrease");
			exit;
        }
    }else{
        header("Location:admin_cars.php?addStock=zeroCar");
		exit;
    }
}


//Admin - Arabaya Stok Ekleme
if ($_GET['addStock']=="increase") {
	islemKontrol();
	if($_GET['stock'] < $_GET['totalCarNumber']){
		$delete=$conn->prepare("UPDATE cars SET stock=stock+1 WHERE car_id=:carid");
	$push=$delete->execute(array(
		'carid' => $_GET['car_id']
		));
	if ($push){
		header("location:admin_cars.php?addStock=basarili_increase");
	} else {
		header("location:admin_cars.php?addStock=basarisiz_increase");
	}
	}else{
		header("location:admin_cars.php?addStock=reachedMax");
	}
}

//Admin - Arabadan Stok Çıkarma
if ($_GET['addStock']=="decrease") {
	islemKontrol();
    if($_GET['stock'] > 0){
        $decrease=$conn->prepare("UPDATE cars SET stock=stock-1 where car_id=:carid");
	$push=$decrease->execute(array(
		'carid' => $_GET['car_id']
		));
        if ($push) {
            header("Location:admin_cars.php?addStock=basarili_decrease");
			exit;
        } else {
            header("location:admin_cars.php?addStock=basarisiz_decrease");
			exit;
        }
    }else{
        header("Location:admin_cars.php?addStock=zeroCar");
		exit;
    }
}

//Admin - Araba Fiyatını Arttırma
if ($_GET['addStock']=="increasePrice") {
	islemKontrol();
	$delete=$conn->prepare("UPDATE cars SET price=price+1 WHERE car_id=:carid");
	$push=$delete->execute(array(
		'carid' => $_GET['car_id']
		));
	if ($push){
		header("location:admin_cars.php?addStock=basarili_increase_price");
		exit;
	} else {
		header("location:admin_cars.php?addStock=basarisiz_increasePrice");
		exit;
	}
}

//Admin - Araba Fiyatını Azaltma
if ($_GET['addStock']=="decreasePrice") {
	islemKontrol();
    if($_GET['price']>0){
        $decrease=$conn->prepare("UPDATE cars SET price=price-1 where car_id=:carid");
	$push=$decrease->execute(array(
		'carid' => $_GET['car_id']
		));
        if ($push) {
            header("Location:admin_cars.php?addStock=basarili_decrease_price");
			exit;
        } else {
            header("location:admin_cars.php?addStock=basarisiz_decrease_price");
			exit;
        }
    }else{
        header("Location:admin_cars.php?addStock=zeroMoney");
		exit;
    }
}

//Admin - Profil Bilgilerini Düzenleme
if (isset($_POST['bilgi_duzenleme'])) {
	islemKontrol();
    $kullanici_id=$_SESSION['kullanici_id'];
	$ayarkaydet=$conn->prepare("UPDATE customers SET
		phoneNumber=:phoneNumber,
        firstname=:firstname,
        surname=:surname
		WHERE id=:id");

    if(strlen($_POST['phoneNumber']) == 10){
	$update=$ayarkaydet->execute(array(
		'firstname' => $_POST['firstname'],
		'surname' => $_POST['surname'],
        'phoneNumber' => $_POST['phoneNumber'],
        'id' => $kullanici_id
		));


	    if ($update) {
		    Header("Location:admin_profile.php?addStock=bilgi_duzenlendi");
			exit;

	    } else {

		    Header("Location:admin_profile.php?addStock=bilgi_duzenlenemedi");
			exit;
	    }

    }else{
        Header("Location:admin_profile.php?addStock=gecersiz_phoneNumber");
		exit;
    }
}

//Admin - Araba Fiyatını Azaltma
if ($_GET['addStock']=="decreasePrice") {
	islemKontrol();
    if($_GET['price']>0){
        $decrease=$conn->prepare("UPDATE cars SET price=price-1 where car_id=:carid");
	$push=$decrease->execute(array(
		'carid' => $_GET['car_id']
		));
        if ($push) {
            header("Location:admin_cars.php?addStock=basarili_decrease_price");
        } else {
            header("location:admin_cars.php?addStock=basarisiz_decrease_price");
        }
    }else{
        header("Location:admin_cars.php?addStock=zeroMoney");
    }
}

//Admin - Total Araba Adedini azaltma
if ($_GET['addStock']=="decrease_totalCarNumber") {
	islemKontrol();
    if($_GET['totalCarNumber']>0){
        $decrease=$conn->prepare("UPDATE cars SET totalCarNumber=totalCarNumber-1 where car_id=:carid");
	$push=$decrease->execute(array(
		'carid' => $_GET['car_id']
		));
        if ($push) {
			if($_GET['totalCarNumber']-$_GET['atRepair'] <= $_GET['stock']){
				$decrease=$conn->prepare("UPDATE cars SET stock=stock-1 where car_id=:carid");
				$push=$decrease->execute(array(
				'carid' => $_GET['car_id']
		));
			}
            header("Location:admin_cars.php?addStock=basarili_decrease_totalCarNumber");
        } else {
            header("location:admin_cars.php?addStock=basarisiz_decrease_totalCarNumber");
        }
    }else{
        header("Location:admin_cars.php?addStock=zeroTotalCar");
    }
}

//Admin - Total Araba adedini Arttırma
if ($_GET['addStock']=="increase_totalCarNumber") {
	islemKontrol();
	$delete=$conn->prepare("UPDATE cars SET totalCarNumber=totalCarNumber+1,stock=stock+1 WHERE car_id=:carid");
	$push=$delete->execute(array(
		'carid' => $_GET['car_id']
		));
	if ($push){
		header("location:admin_cars.php?addStock=basarili_increase_totalCarNumber");
	} else {
		header("location:admin_cars.php?addStock=basarisiz_increase_totalCarNumber");
	}
}


?>