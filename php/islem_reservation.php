<?php 
include 'connection.php';
include 'function.php';
ob_start();
session_start();


//UserAccount - Reservation
if(isset($_POST['continue_renting'])){

    $mustangPriceSor=$conn->prepare("SELECT price FROM cars where name='MUSTANG'");
$mustangPriceSor->execute();
$mustangPriceCek=$mustangPriceSor->fetch(PDO::FETCH_ASSOC);

$bmwPriceSor=$conn->prepare("SELECT price FROM cars where name='BMW'");
$bmwPriceSor->execute();
$bmwPriceCek=$bmwPriceSor->fetch(PDO::FETCH_ASSOC);

$mercedesPriceSor=$conn->prepare("SELECT price FROM cars where name='MERCEDES'");
$mercedesPriceSor->execute();
$mercedesPriceCek=$mercedesPriceSor->fetch(PDO::FETCH_ASSOC);

$hondaPriceSor=$conn->prepare("SELECT price FROM cars where name='HONDA'");
$hondaPriceSor->execute();
$hondaPriceCek=$hondaPriceSor->fetch(PDO::FETCH_ASSOC);
    $t=time();
    $currentTime = (date("Y-m-d",$t));
    $_SESSION['startDate'] = $_POST['startDate'];
    $_SESSION['endDate'] = $_POST['endDate'];
    $_SESSION['selectedCar'] = $_POST['car'];
    $datediff = strtotime($_SESSION['endDate']) - strtotime($_SESSION['startDate']);
    
    if($_SESSION['startDate'] >= $currentTime){
        if($_SESSION['startDate'] < $_SESSION['endDate']){
            $_SESSION['onReservation'] = 'ok';
            $time_interval = round($datediff / (60 * 60 * 24));
            if($_SESSION['selectedCar']=='MERCEDES'){
               $_SESSION['price']= ($time_interval)*$mercedesPriceCek['price'];
            } 
            if($_SESSION['selectedCar']=='BMW'){
                $_SESSION['price']= ($time_interval)*$bmwPriceCek['price'];
             }
             if($_SESSION['selectedCar']=='HONDA'){
               $_SESSION['price']= ($time_interval)*$hondaPriceCek['price'];
            }
            if($_SESSION['selectedCar']=='MUSTANG'){
                $_SESSION['price']= ($time_interval)*$mustangPriceCek['price'];
             }
            header("Location:loggedin_reservation.php?durum=ok&rezervasyon_sil=waiting");
        }else{
            header("Location:loggedin_cars.php?durum=false_rentDate");
        }
    }else{
        header("Location:loggedin_cars.php?durum=past_rentDate");
    }
    
}

//UserAccount - Rezervasyon tamamlama
if(isset($_POST['make_reservation'])){
    $_SESSION['carid'] = $_POST['carid'];
    $_SESSION['carName'] = $_POST['carName'];
    $startDate = $_SESSION['startDate'];
    $returnDate = $_SESSION['endDate'];
    $customerid = $_SESSION['kullanici_id'];

    $bmwStockSor=$conn->prepare("SELECT stock FROM cars where name='BMW'");
    $bmwStockSor->execute();
    $bmwStockCek=$bmwStockSor->fetch(PDO::FETCH_ASSOC);
    
    $mustangStockSor=$conn->prepare("SELECT stock FROM cars where name='MUSTANG'");
    $mustangStockSor->execute();
    $mustangStockCek=$mustangStockSor->fetch(PDO::FETCH_ASSOC);
    
    $hondaStockSor=$conn->prepare("SELECT stock FROM cars where name='HONDA'");
    $hondaStockSor->execute();
    $hondaStockCek=$hondaStockSor->fetch(PDO::FETCH_ASSOC);

    $mercedesStockSor=$conn->prepare("SELECT stock FROM cars where name='MERCEDES'");
    $mercedesStockSor->execute();
    $mercedesStockCek=$mercedesStockSor->fetch(PDO::FETCH_ASSOC);

    if($_SESSION['carName'] =='BMW'){
        if($bmwStockCek['stock'] <= 0){
        header("Location:loggedin_cars.php?durum=outOfStock");
        }else{
                $makeReservation=$conn->prepare("INSERT INTO reservations SET
                        startDate=:startDate,
                        returnDate=:returnDate,
                        customerid=:customerid,
                        carid=:carid,
                        price=:price,
                        carName=:carName,
                        situation=:situation
                        ");
                $push=$makeReservation->execute(array(
                        'startDate' => $startDate,
                        'returnDate' => $returnDate,
                        'customerid' => $customerid,
                        'carid' => $_SESSION['carid'],
                        'price' => $_SESSION['price'],
                        'carName' => $_SESSION['carName'],
                        'situation' => 'active'
            ));
            $total_income=$conn->prepare("UPDATE income SET
                        total_income=total_income+:price WHERE indicator=0
                        ");
                $total_income_push=$total_income->execute(array(
                        'price' => $_SESSION['price']
            ));
            if($push){
                header("Location:loggedin_index.php?durum=rezervasyon_islem_tamamlandi");
                $decreaseStock=$conn->prepare("UPDATE cars SET stock=stock-1 WHERE
                        car_id=:carid
                        ");
                        $decrease=$decreaseStock->execute(array(
                        'carid' => $_SESSION['carid']
            ));
            }else{
                header("Location:loggedin_index.php?durum=rezervasyon_islem_tamamlanamadi");
            }
        }
    }
    
    if($_SESSION['carName']=='MERCEDES'){
        if($mercedesStockCek['stock'] <= 0){
        header("Location:loggedin_cars.php?durum=outOfStock");
        }else{
                $makeReservation=$conn->prepare("INSERT INTO reservations SET
                        startDate=:startDate,
                        returnDate=:returnDate,
                        customerid=:customerid,
                        carid=:carid,
                        price=:price,
                        carName=:carName,
                        situation=:situation
                        ");
                $push=$makeReservation->execute(array(
                        'startDate' => $startDate,
                        'returnDate' => $returnDate,
                        'customerid' => $customerid,
                        'carid' => $_SESSION['carid'],
                        'price' => $_SESSION['price'],
                        'carName' => $_SESSION['carName'],
                        'situation' => 'active'
            ));
            $total_income=$conn->prepare("UPDATE income SET
                        total_income=total_income+:price WHERE indicator=0
                        ");
                $total_income_push=$total_income->execute(array(
                        'price' => $_SESSION['price']
            ));
            if($push){
                header("Location:loggedin_index.php?durum=rezervasyon_islem_tamamlandi");
                $decreaseStock=$conn->prepare("UPDATE cars SET stock=stock-1 WHERE
                        car_id=:carid
                        ");
                        $decrease=$decreaseStock->execute(array(
                        'carid' => $_SESSION['carid']
            ));
            }else{
                header("Location:loggedin_index.php?durum=rezervasyon_islem_tamamlanamadi");
            }
        }
    }
    
    if($_SESSION['carName']=='HONDA'){
        if($hondaStockCek['stock'] <= 0){
        header("Location:loggedin_cars.php?durum=outOfStock");
        }else{
                $makeReservation=$conn->prepare("INSERT INTO reservations SET
                        startDate=:startDate,
                        returnDate=:returnDate,
                        customerid=:customerid,
                        carid=:carid,
                        price=:price,
                        carName=:carName,
                        situation=:situation
                        ");
                $push=$makeReservation->execute(array(
                        'startDate' => $startDate,
                        'returnDate' => $returnDate,
                        'customerid' => $customerid,
                        'carid' => $_SESSION['carid'],
                        'price' => $_SESSION['price'],
                        'carName' => $_SESSION['carName'],
                        'situation' => 'active'
            ));
            $total_income=$conn->prepare("UPDATE income SET
                        total_income=total_income+:price WHERE indicator=0
                        ");
                $total_income_push=$total_income->execute(array(
                        'price' => $_SESSION['price']
            ));
            if($push){
                header("Location:loggedin_index.php?durum=rezervasyon_islem_tamamlandi");
                $decreaseStock=$conn->prepare("UPDATE cars SET stock=stock-1 WHERE
                        car_id=:carid
                        ");
                        $decrease=$decreaseStock->execute(array(
                        'carid' => $_SESSION['carid']
            ));
            }else{
                header("Location:loggedin_index.php?durum=rezervasyon_islem_tamamlanamadi");
            }
        }
    }
    
    if($_SESSION['carName']=='MUSTANG'){
        if($mustangStockCek['stock'] <= 0){
        header("Location:loggedin_cars.php?durum=outOfStock");
        }else{
                $makeReservation=$conn->prepare("INSERT INTO reservations SET
                        startDate=:startDate,
                        returnDate=:returnDate,
                        customerid=:customerid,
                        carid=:carid,
                        price=:price,
                        carName=:carName,
                        situation=:situation
                        ");
                $push=$makeReservation->execute(array(
                        'startDate' => $startDate,
                        'returnDate' => $returnDate,
                        'customerid' => $customerid,
                        'carid' => $_SESSION['carid'],
                        'price' => $_SESSION['price'],
                        'carName' => $_SESSION['carName'],
                        'situation' => 'active'
            ));
            $total_income=$conn->prepare("UPDATE income SET
                        total_income=total_income+:price WHERE indicator=0
                        ");
                $total_income_push=$total_income->execute(array(
                        'price' => $_SESSION['price']
            ));
            if($push){
                header("Location:loggedin_index.php?durum=rezervasyon_islem_tamamlandi");
                $decreaseStock=$conn->prepare("UPDATE cars SET stock=stock-1 WHERE
                        car_id=:carid
                        ");
                        $decrease=$decreaseStock->execute(array(
                        'carid' => $_SESSION['carid']
            ));
            }else{
                header("Location:loggedin_index.php?durum=rezervasyon_islem_tamamlanamadi");
            }
        }
    }



}


//UserAccount- Rezervasyon Sil
if ($_GET['rezervasyon_sil']=="ok") {
	$delete=$conn->prepare("DELETE from reservations where reservationid=:id");
	$control=$delete->execute(array(
		'id' => $_GET['reservationid']
		));
	if ($control) {
        $increaseStock=$conn->prepare("UPDATE cars SET stock=stock+1 WHERE
                    car_id=:carid
                    ");
                    $increase=$increaseStock->execute(array(
                    'carid' => $_GET['carid']
        ));
        $total_income=$conn->prepare("UPDATE income SET
                    total_income=total_income-:price WHERE indicator=0
                    ");
            $total_income_push=$total_income->execute(array(
                    'price' => $_GET['price']
        ));
		header("location:user_reservations.php?rezervasyon_sil=ok");
	} else {
		header("location:user_reservations.php?rezervasyon_sil=no");
	}


}

?>