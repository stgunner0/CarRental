<?php
include 'admin_navbar.php';
$arabasor=$conn->prepare("select * from cars");
	$arabasor->execute();
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="chartjs-size-monitor">
    <div class="chartjs-size-monitor-expand">
      <div class=""></div>
    </div>
    <div class="chartjs-size-monitor-shrink">
      <div class=""></div>
    </div>
  </div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Cars</h1>
    <?php /*Başarılı kayıt */ if ($_GET['addStock']=="basarili_increase") {?>
      <div class="alert alert-success text-center">
        <strong >Add stock done succesfully.</strong>
        </div>
    <?php }?>
    <?php /*Başarılı kayıt */ if ($_GET['addStock']=="basarisiz_increase") {?>
      <div class="alert alert-danger text-center">
        <strong >ERROR!</strong> Something going wrong while adding stock!
        </div>
    <?php }?>
    <?php /*Başarılı kayıt */ if ($_GET['addStock']=="basarili_decrease") {?>
      <div class="alert alert-success text-center">
        <strong >Decrease stock done successfully.</strong>
        </div>
    <?php }?>
    <?php /*Başarılı kayıt */ if ($_GET['addStock']=="basarisiz_decrease") {?>
      <div class="alert alert-danger text-center">
        <strong >ERROR!</strong> Something going wrong while decreasing stock!
        </div>
    <?php }?>
    <?php /*Başarılı kayıt */ if ($_GET['addStock']=="zeroCar") {?>
      <div class="alert alert-danger text-center">
        <strong >ERROR!</strong> You can't decrease because there is not enough stock.
        </div>
    <?php }?>
    <?php /*Başarılı kayıt */ if ($_GET['addStock']=="basarili_increase_price") {?>
      <div class="alert alert-success text-center">
        <strong >SUCCESS!</strong> Increase price done successfully.
        </div>
    <?php }?>
    <?php /*Başarılı kayıt */ if ($_GET['addStock']=="basarisiz_increase_price") {?>
      <div class="alert alert-danger text-center">
        <strong >ERROR!</strong> Something going wrong when increasing price.
        </div>
    <?php }?>
    <?php /*Başarılı kayıt */ if ($_GET['addStock']=="basarili_decrease_price") {?>
      <div class="alert alert-success text-center">
        <strong >SUCCESS!</strong> Decrease price done successfully.
        </div>
    <?php }?>
    <?php /*Başarılı kayıt */ if ($_GET['addStock']=="basarisiz_decrease_price") {?>
      <div class="alert alert-danger text-center">
        <strong >ERROR!</strong> Something going wrong when decreasing price.
        </div>
    <?php }?>
    <?php /*Başarılı kayıt */ if ($_GET['addStock']=="zeroMoney") {?>
      <div class="alert alert-danger text-center">
        <strong >ERROR!</strong> You can't decrease because price is zero($0).
        </div>
    <?php }?>
    <?php /*Başarılı kayıt */ if ($_GET['addStock']=="reachedMax") {?>
      <div class="alert alert-danger text-center">
        <strong >ERROR!</strong> Reached maximum total car number.
        </div>
    <?php }?>
  </div>

  <h2>Cars</h2>
  <div class="table-responsive">
    <table id="datatable-responsive" style="table-layout:fixed;width=100%;"
      class="table table-striped table-bordered dt-responsive nowrap table-sm table-condensed" cellspacing="0">
      <thead>
        <tr>
          <th>Car Name</th>
          <th>Price</th>
          <th>Total Car Number</th>
          <th>Repairing Car</th>
          <th>Stock</th>
        </tr>
      </thead>

      <tbody>

        <?php 

                while($arabacek=$arabasor->fetch(PDO::FETCH_ASSOC)) {?>
        <tr>
          <td>
            <?php echo $arabacek['name'] ?>
            <div class="col-md-5">
                <center><a href="admin_car_reservations.php?car_id=<?php echo $arabacek['car_id'];?>&addStock=car_reservation"><button
                      class="btn btn-success btn-xs">See Rents</button></a></center>
              </div>
          </td>
          <td>
          <div class="row">
              <div class="col-md-2">
              <?php echo $arabacek['price'] ?>
              </div>
              <div class="col-md-5">
                <center><a href="islem_admin_reservations.php?car_id=<?php echo $arabacek['car_id'];?>&rezervasyon_sil=waiting&addStock=increasePrice"><button
                      class="btn btn-success btn-xs">Increase</button></a></center>
              </div>
              <div class="col-md-5">
                <center><a href="islem_admin_reservations.php?car_id=<?php echo $arabacek['car_id']; ?>&price=<?php echo $arabacek['price'];?>&rezervasyon_sil=ok&addStock=decreasePrice"><button
                      class="btn btn-danger btn-xs">Decrease</button></a></center>
              </div>
            </div>
          </td>
          <td>
          <div class="row">
              <div class="col-md-2">
                <?php echo $arabacek['totalCarNumber'] ?>
              </div>
              <div class="col-md-5">
                <center><a href="islem_admin_reservations.php?car_id=<?php echo $arabacek['car_id'];?>&totalCarNumber=<?php echo $arabacek['totalCarNumber'];?>&addStock=increase_totalCarNumber"><button
                      class="btn btn-success btn-xs">Increase</button></a></center>
              </div>
              <div class="col-md-5">
                <center><a href="islem_admin_reservations.php?car_id=<?php echo $arabacek['car_id']; ?>&stock=<?php echo $arabacek['stock'];?>&totalCarNumber=<?php echo $arabacek['totalCarNumber'];?>&addStock=decrease_totalCarNumber&atRepair=<?php echo $arabacek['atRepair'];?>"><button
                      class="btn btn-danger btn-xs">Decrease</button></a></center>
              </div>
            </div>
          </td>
          <td>
          <div class="row">
              <div class="col-md-2">
                <?php echo $arabacek['atRepair'] ?>
              </div>
              <div class="col-md-5">
                <center><a href="islem_admin_reservations.php?car_id=<?php echo $arabacek['car_id'];?>&stockCarNumber=<?php echo $arabacek['stock'];?>&addStock=increase_repair_car&atRepair=<?php echo $arabacek['atRepair'];?>&totalCarNumber=<?php echo $arabacek['totalCarNumber'];?>"><button
                      class="btn btn-success btn-xs">Push to Repair</button></a></center>
              </div>
              <div class="col-md-5">
                <center><a href="islem_admin_reservations.php?car_id=<?php echo $arabacek['car_id']; ?>&stockCarNumber=<?php echo $arabacek['stock'];?>&addStock=decrease_repair_car&atRepair=<?php echo $arabacek['atRepair'];?>&totalCarNumber=<?php echo $arabacek['totalCarNumber'];?>"><button
                      class="btn btn-danger btn-xs">Come from Repair</button></a></center>
              </div>
            </div>
          </td>
          <td>
            <div class="row">
              <div class="col-md-2">
                <?php echo $arabacek['stock'] ?>
              </div>
          </td>
        </tr>
        <?php } ?>

      </tbody>

    </table>
  </div>
</main>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>