<?php
 include "Includes/header.php";
$sql = "SELECT id, title, start, end, assigned_users, color FROM events WHERE Approved = 'Approved' ";
$req = $bdd->prepare($sql);
$req->execute();
$events = $req->fetchAll();
?>
<div id="wrapper">
    <?php
    include "Includes/sidenav.php";
    include "Includes/topnav.php"; ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Calendar</h2>
        </ol>
    </div>
</div>

<!-- Page Content -->
    <div class="container" style="padding:5px;overflow-y:hidden !important">


                <div id="calendar" class="col-centered">
                </div>
        <!-- /.row -->

        <!-- Modal -->
        <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form class="form-horizontal" method="POST" action="addEvent.php">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Event</h4>
              </div>
              <div class="modal-body">

                  <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                      <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="color" class="col-sm-2 control-label">Color</label>
                    <div class="col-sm-10">
                      <select name="color" class="form-control" id="color">
                          <option value="">Choose</option>
                          <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
                          <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
                          <option style="color:#008000;" value="#008000">&#9724; Green</option>
                          <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
                          <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
                          <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
                          <option style="color:#000;" value="#000">&#9724; Black</option>

                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="start" class="col-sm-2 control-label">Start date</label>
                    <div class="col-sm-10">
                      <input type="datetime-local" name="start" class="form-control" id="start" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="end" class="col-sm-2 control-label">End date</label>
                    <div class="col-sm-10">
                      <input type="datetime-local" name="end" class="form-control" id="end">
                    </div>
                  </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
            </div>
          </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form class="form-horizontal" method="POST" action="editEventTitle.php">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Event</h4>
              </div>
              <div class="modal-body">

                  <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                      <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="color" class="col-sm-2 control-label">Color</label>
                    <div class="col-sm-10">
                      <select name="color" class="form-control" id="color">
                          <option value="">Choose</option>
                          <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
                          <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
                          <option style="color:#008000;" value="#008000">&#9724; Green</option>
                          <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
                          <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
                          <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
                          <option style="color:#000;" value="#000">&#9724; Black</option>

                        </select>
                    </div>
                  </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <div class="checkbox">
                            <label class="text-danger"><input type="checkbox"  name="delete"> Delete event</label>
                          </div>
                        </div>
                    </div>

                  <input type="hidden" name="id" class="form-control" id="id">


              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
            </div>
          </div>
        </div>

    </div>
</div>
</div>
</div>
</div>
</div>


</div>


<?php include "Includes/footer.php" ?>

<script>


    $(document).ready(function() {

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            firstDay: 1,
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            selectHelper: true,
            allDay: true,
            select: function(start, end) {

                $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                $('#ModalAdd').modal('show');
            },

            eventRender: function(event, element) {
                element.bind('dblclick', function() {
                    $('#ModalEdit #id').val(event.id);
                    $('#ModalEdit #title').val(event.title);
                    $('#ModalEdit #color').val(event.color);
                    $('#ModalEdit').modal('show');
                });
            },
            eventDrop: function(event, delta, revertFunc) {

                edit(event);

            },
            eventResize: function(event,dayDelta,minuteDelta,revertFunc) {
                edit(event);
            },
            eventDataTransform: function(event) {
              if(event.color === '#02d1e0' ) {
                event.end = moment(event.end).add(1, 'days')
              }
              return event;
            },
            events: [
            <?php foreach($events as $event):

                $start = explode(" ", $event['start']);
                $end = explode(" ", $event['end']);
                if($start[1] == '00:00:00'){
                    $start = $start[0];
                }else{
                    $start = $event['start'];
                }
                if($end[1] == '00:00:00'){
                    $end = $end[0];
                }else{
                    $end = $event['end'];
                }
            ?>
                {
                    id: '<?php echo $event['id']; ?>',
                    title: '<?php echo $event['title']?>',
                    start: '<?php echo $start; ?>',
                    end: '<?php echo $end; ?>',
                    color: '<?php echo $event['color']; ?>',
                },
            <?php endforeach; ?>
            ]
        });

        function edit(event){
            start = event.start.format('YYYY-MM-DD HH:mm:ss');
            if(event.end){
                end = event.end.format('YYYY-MM-DD HH:mm:ss');
            }else{
                end = start;
            }

            id =  event.id;

            Event = [];
            Event[0] = id;
            Event[1] = start;
            Event[2] = end;

            $.ajax({
             url: 'editEventDate.php',
             type: "POST",
             data: {Event:Event},
             success: function(rep) {
                    if(rep == 'OK'){
                        alert('Saved');
                    }else{
                        alert('Could not be saved. try again.');
                    }
                }
            });
        }

    });

</script>
</body>

</html>
