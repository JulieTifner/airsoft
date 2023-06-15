$(document).ready(function() {

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  var calendar = $('#calendar').fullCalendar({
      editable: true,
      events: SITEURL + "/events",
      displayEventTime: false,
      editable: true,
      selectable: true,
      selectHelper: true,
      eventRender: function(event, element, view) {

          if (event.allDay === 'true') {
              event.allDay = true;
          } else {
              event.allDay = false;
          }
          element.css('background-color', '#8ab586');

          element.css('border', '1px solid #8ab586');

          element.css('color', '#000000');

      },
      select: function(start, end, allDay) {
          $('#eventModal').modal('show');
          $('#eventModal').data('eventStart', start);

          $('#eventModal').find('.close').click(function() {
              $('#eventModal').modal('hide');

          });
          $('#eventModal').find('.modal-footer .btn-secondary').click(function() {
              $('#eventModal').modal('hide');
          });
      },
      eventDrop: function(event, delta) {
          var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
          var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

          $.ajax({
              url: SITEURL + '/fullcalenderAjax',
              data: {
                  title: event.title,
                  description: event.description,
                  cost: cost,
                  from: from,
                  to: to,
                  max_player: max_player,
                  start: start,
                  end: end,
                  id: event.id,
                  type: 'update'
              },
              type: "POST",
              success: function(response) {
                  displayMessage("Event Updated Successfully");
              }
          });
      },
      eventClick: function(event) {

          $.ajax({
              url: SITEURL + '/event',
              data: {
                  eventId: event.id
              },
              type: 'GET',
              success: function(response) {
                  var event = response.event;
                  var userNames = response.userNames;

                  $('#showEventModal').find('#eventModalLabel').text(event.title);
                  $('#showEventModal').find('#eventDescription').text(event.description);
                  $('#showEventModal').find('#eventMap').text(event.map.name);
                  $('#showEventModal').find('#eventType').text(event.type);
                  $('#showEventModal').find('#eventCost').text(event.cost);
                  $('#showEventModal').find('#eventFrom').text(event.from);
                  $('#showEventModal').find('#eventTo').text(event.to);
                  $('#showEventModal').find('#eventMaxPlayer').text(event.max_player);
                  $('#showEventModal').find('#enroll').click(function() {
                      var eventId = event.id;
                      var eventUrl = SITEURL + '/enroll/' + event.id;
                      eventUrl = eventUrl.replace(':eventId', eventId);
                      window.location.href = eventUrl;
                  });
                  $('#showEventModal').modal('show');

                  if (response.type == 1) {
                      $('#showEventModal').find('#eventType').text('Outdoor');
                  } else {
                      $('#showEventModal').find('#eventType').text('Indoor');
                  }

                var userList = $('#userEnrollmentModal').find('#userList');
                userList.empty();

                $.each(userNames, function(index, userName) {
                    console.log(response.userNames);
                    var tableRow = $('<tr>');
                    tableRow.append($('<th>').text(index + 1));
                    tableRow.append($('<td>').text(userName));

                    userList.append(tableRow);
                });
                  
              },
              error: function(xhr, status, error) {
                  console.log(error);
              }
          });

          $('#showEventModal').find('.close').click(function() {
              $('#showEventModal').modal('hide');
          });

          $('#userEnrollmentModal').find('.close').click(function() {
            $('#userEnrollmentModal').modal('hide');
          });

          $('#editEventModal').find('.close').click(function() {
            $('#editEventModal').modal('hide');
          });

          $('#showEventModal').find('.modal-footer .btn-secondary').click(function() {
              $('#showEventModal').modal('hide');
          });

          $('#userEnrollmentModal').find('.modal-footer .btn-secondary').click(function() {
            $('#showEventModal').modal('show');
            $('#userEnrollmentModal').modal('hide');

          });

          $('#editEventModal').find('.modal-footer .btn-secondary').click(function() {
              $('#editEventModal').modal('hide');
          });

          $('#showEventModal').find('#userEvent').click(function() {
              $('#showEventModal').modal('hide');
              $('#userEnrollmentModal').modal('show');
          });

          $('#showEventModal').find('#editEvent').click(function() {
              $('#showEventModal').modal('hide');
              $('#editEventModal').modal('show');
          });
          // Delete

          function deleteEvent(event) {
              var deleteMsg = confirm("Event wirklich löschen?");
              if (deleteMsg) {
                  $.ajax({
                      type: "POST",
                      url: SITEURL + '/fullcalenderAjax',
                      data: {
                          id: event.id,
                          type: 'delete'
                      },
                      success: function(response) {
                          calendar.fullCalendar('removeEvents', event.id);
                          displayMessage("Event Deleted Successfully");
                      }
                  });
              }
          }

          $('#showEventModal').data('event', event);
          $('#deleteEvent').click(function() {
              var event = $('#showEventModal').data('event');
              deleteEvent(event);
              $('#showEventModal').modal('hide');
          });

      },


      firstDay: 1,

  });

  $('#saveEvent').click(function() {
      var title = $('#eventModal').find('#eventTitle').val();
      var description = $('#eventModal').find('#eventDescription').val();
      var cost = $('#eventModal').find('#eventCost').val();
      var from = $('#eventModal').find('#eventFrom').val();
      var to = $('#eventModal').find('#eventTo').val();
      var max_player = $('#eventModal').find('#eventMaxPlayer').val();
      var gameType = $('#eventModal').find('#eventType').val();
      var map_id = $('#eventModal').find('#eventMap').val();
      var start = $('#eventModal').data('eventStart');
      var end = moment(start).endOf('day');

      console.log(map_id);

      if (gameType === 'spiel') {
          gameType = 1;
      } else if (gameType === 'training') {
          gameType = 0;
      }
      $.ajax({
          url: SITEURL + "/fullcalenderAjax",
          data: {
              title: title,
              description: description,
              cost: cost,
              from: from,
              to: to,
              max_player: max_player,
              gameType: gameType,
              map_id: map_id,
              start: start.format('YYYY-MM-DD'),
              end: end.format('YYYY-MM-DD'),
              type: 'add'
          },
          type: "POST",
          success: function(data) {
              displayMessage("Event Created Successfully");

              calendar.fullCalendar('renderEvent', {
                  id: data.id,
                  title: title,
                  description: description,
                  cost: cost,
                  from: from,
                  to: to,
                  max_player: max_player,
                  gameType: gameType,
                  start: start,
                  end: end,
                  allDay: true

              }, true);

              calendar.fullCalendar('unselect');
          }
      });

      $('#eventModal').modal('hide');
  });

  function displayMessage(message) {
      toastr.success(message, 'Event');
  }

});