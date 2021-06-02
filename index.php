<?php
include 'DataBase/dataBaseFunction.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/vanilla-calendar-min.css">
  <!-- <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/> -->
  <title>Booking Calander</title>
</head>
<body>
  <?php
  $weekOfEmployee = '';
  $employeeId = '';
  $EmployeeStartTime = '';
  $EmployeeEndTime = '';
  $Duration = '';
    // select_where('employeedata',$where);
  $employeeData = select_all('employeedata');
  if(!empty($employeeData)){
    $weekOfEmployee = $employeeData[0]['EmployeeWorkingDay'];
    $employeeId = $employeeData[0]['EmployeeId'];
    $EmployeeStartTime = $employeeData[0]['EmployeeStartTime'];
    $EmployeeEndTime = $employeeData[0]['EmployeeEndTime'];
    $Duration = $employeeData[0]['Duration'];
    ?>
    <div class="container-fluid">
      <button type="button" id="backButton" onclick="gotoMainPage();" style="display:none;"> < Back </button>
      <div class="row">
        <div class="col-5">
          <div class="row">
            <div class="col">
              <?php
                $img = explode("/",$employeeData[0]['EmployeeImage']);
              ?>
              <img src="<?php echo $img[1]."/".$img[2];?>" width=200; height=200;>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <span><?php echo $employeeData[0]['EmployeeName'];?></span>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <strong><?php echo $employeeData[0]['EmployeeServiceTitle'];?></strong>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <span>Start:</span><?php echo $employeeData[0]['EmployeeStartTime'];?>
            </div>
            <div class="col">
              <span>End</span><?php echo $employeeData[0]['EmployeeEndTime'];?>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <span>Duration:</span><?php echo $employeeData[0]['Duration'];?>
            </div>
            <div class="col">
              <span>Call:</span><?php echo $employeeData[0]['EmployeeNumber'];?>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <span><?php echo $employeeData[0]['Description'];?></span>
            </div>
          </div>
        </div>
        <div class="col-4" id="calanderDiv">
          <div id="myCalendar" class="vanilla-calendar"></div>
        </div>
        <div class="col" style="display: none;" id="bookingForm">
          <form method="POST" action="">
          <div class="row">
            <div class="col">
              <label class="form-control-label">Name</label>
              <input class="form-control" type="text" name="name" id="name">
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label class="form-control-label">Email</label>
              <input class="form-control" type="Email" name="email" id="email">
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label class="form-control-label">Mobile No</label>
              <input class="form-control" type="text" name="mobile" id="mobile">
            </div>
          </div>
          <?php
          $selectQuestion = select_where('employequestion',array('EmployeeId'=>1));
          if($selectQuestion){
            foreach($selectQuestion as $question){
              ?>
              <div class="row">
                <div class="col">
                  <label class="form-control-label"><?php echo $question['question'];?></label>
                  <textarea class="form-control" id="<?php echo $question['id'];?>"></textarea>
                </div>
              </div>
              <?php
            }
          }
          ?>
          <button class="btn btn-primary" type="button" name="saveData" id="saveData">Book Now</button>
          </form>
        </div>
        <div class="col-3" id="timeDiv">
          <div id="timeButton"></div>
        </div>
      </div>
    </div>
    <?php
  }else{
    echo "Employee not found.";
  }
  ?>
</body>
<footer>
  <script src="js/jquery-3.6.0.min.js"></script>
  <script src="js/jQueryUI.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/vanilla-calendar-min.js"></script>
  <script type="text/javascript">
    let myCalendar = new VanillaCalendar({
      selector: "#myCalendar",
      datesFilter: true,
      pastDates: false,
      onSelect: (data, elem) => {
        var availableTime = [];
        var ID = '<?php echo $employeeId;?>';
        $('#timeButton').html('');
        var d = new Date(data.date);
        var str = $.datepicker.formatDate('yy-mm-dd', d);
    // $.ajax({
    //   url: "checkAvailability.php",
    //   type: 'POST',
    //   dataType: "json",
    //   data: {date:str,id:ID},
    //   async: false,
    //   success: function (data) {
    //     if(data.status==true){
    //       availableTime = data.fillTime;
    //     }
    //   }
    // });
    var dateArray = [];
    // let availableTime = '01:00:00';
    let starttime = "<?php echo $EmployeeStartTime;?>";
    let endtime = "<?php echo $EmployeeEndTime;?>";
    let duration = "<?php echo $Duration?>";
    if(starttime != '' && endtime != '' && duration != ''){
      var str1 = starttime;
      var str2 = endtime;
      str1 =  str1.split(':');
      str2 =  str2.split(':');
      totalSeconds1 = parseInt(str1[0]*3600)+parseInt(str1[1]*60);
      totalSeconds2 = parseInt(str2[0]*3600)+parseInt(str2[1]*60);
      var i = '';
      var j = 1;
      for(i=parseInt(totalSeconds1); i<=parseInt(totalSeconds2); i+=(parseInt(duration)*60)){
        var formattedTime = new Date(i * 1e3).toISOString().slice(-13, -5);
        if($.inArray(formattedTime, availableTime) > -1 ){
    // console.log(formattedTime);
  }
  else{
    formattedTime1 = formattedTime.split(':');
    dateArray += '<div class="half d-box"><button class="BookForm" id="'+formattedTime+'" value="'+str+'" onclick="toggalButton(this);">'+formattedTime1[0]+':'+formattedTime1[1]+'</button></div>';
    j++;
  }
}
$('#timeButton').append(dateArray);
}
}
});
    var days = [];
    var weekData = '<?php echo $weekOfEmployee;?>';
    if(weekData != ''){
      var weekData = JSON.parse(weekData);
      if(weekData.Sunday==1)
      {
        var obj = {};
        obj.day="sunday";
        days.push(obj);
      }
      if(weekData.Monday==1)
      {
        var obj = {};
        obj.day="monday";
        days.push(obj);
      }
      if(weekData.Tuesday==1)
      {
        var obj = {};
        obj.day="tuesday";
        days.push(obj);
      }
      if(weekData.Wednesday==1)
      {
        var obj = {};
        obj.day="wednesday";
        days.push(obj);
      }
      if(weekData.Thursday==1)
      {
        var obj = {};
        obj.day="thursday";
        days.push(obj);
      }
      if(weekData.Friday==1)
      {
        var obj = {};
        obj.day="friday";
        days.push(obj);
      }
      if(weekData.Saturday==1)
      {
        var obj = {};
        obj.day="saturday";
        days.push(obj);
      }
      myCalendar.set({availableWeekDays: days});
    }
    function toggalButton(a) {
      $('.remove').remove();
      id = a.id;
      value = a.value;
      $(a).after('<button class="remove" id="'+id+'" value="'+value+'" onclick="gotoRegister(this.id,this.value)">Confirm</button>');
    }
    function gotoRegister(time,selectDate){
      $('#backButton').show();
      $('#bookingForm').show();
      $('#calanderDiv').hide();
      $('#timeDiv').hide();
    }
    function gotoMainPage(){
      $('#backButton').hide(); 
      $('#bookingForm').hide(); 
      $('#calanderDiv').show(); 
      $('#timeDiv').show(); 
    }
    $('#saveData').on('click',function(){
      let count = 0;
      $('.error').html('');
      $('input:text,textarea').each(function() {
        if($(this).val() == ''){
          count++;
          $(this).after('<span class="error" >Fill it.</span>');
        }
      });
      let answerArray = [];
      $('textarea').each(function() {
        if($(this).val() != ''){
          answer[$(this).attr('id')] = $(this).attr('value'); 
        }
      });
      let name = $('#name').val();
      let email = $('#email').val();
      let mobile = $('#mobile').val();
      if(count > 0){
        return false;
      }
    });
  </script>
</footer>
</html>