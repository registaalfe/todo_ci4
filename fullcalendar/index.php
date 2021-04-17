<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <!-- Mycss -->
    <link type="text/css" rel="stylesheet" href="materialize.css"  media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=?<?php echo time(); ?>">

    <!-- fullcalendar -->
    <link rel="stylesheet" href="dist/fullcalendar.min.css?v=?<?php echo time(); ?>">
    <script src="jquery.min.js?v=?<?php echo time(); ?>"></script>
    <script src="moment.js?v=?<?php echo time(); ?>"></script>
    <script src="dist/fullcalendar.min.js?v=?<?php echo time(); ?>"></script>
    <script src="dist/script.js?v=?<?php echo time(); ?>"></script>

    <script type="text/javascript">
      $('#calendar').fullCalendar({
      eventClick: function(event, element) {

        event.title = "CLICKED!";

        $('#calendar').fullCalendar('updateEvent', event);

      }
    });
    </script>

    <title>ToDo List</title>
    
</head>

<body>
    <div class="navbar-fixed">
        <nav class="grey darken-3">
          <div class="container">
            <div class="nav-wrapper">
              <a href="#home" class="brand-logo">ToDo List</a>
            </div>
          </div>
        </nav>
      </div>
      
      <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">TAMBAH EVENT</button>

      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Add Event</h4>
            </div>
            <div class="modal-body">
              <form method="POST" action="agenda.php">
                  <div style="font-weight: bold;">
                      Name
                  </div>
                  <input type="text" name="eventname" value="Meeting">
                  <br><br>

                  <div style="font-weight: bold;">
                      Start
                  </div>
                  <input type="text" name="startdate" value="2021-04-18 10:00:00">
                  <br><br>

                  <div style="font-weight: bold;">
                      End
                  </div>
                  <input type="text" name="enddate" value="2021-04-18 12:00:00">
                  <br>

                  <input type="submit" name="addevent" value="Kirim">
              </form>
            </div>
          </div>
          
        </div>
      </div>

      <div id="calendar"></div>


    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script> -->

</body>

</html>