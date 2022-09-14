$(document).ready(function () {

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  loadColor();
  $('.change-level').change(function (e) {
    $("#myModal").modal();
    var number = $(this).val();
    var userid = $(this).data('userid');
    var skillid = $(this).data('skillid');
    // alert(skillid);

    $('#userId').val(userid);
    $('#skillId').val(skillid);
    $('#number').val(number);
  });

  $('#submit').click(function (e) {
    e.preventDefault();
    var time = $('#time').val();

    if (time == "" || time < 1) {
      $('.error').html('Enter time!');
    } else {
      $.ajax({
        type: 'POST',
        url: "/storelevel",
        data: {
          'userid': $('#userId').val(),
          'skillid': $('#skillId').val(),
          'number': $('#number').val(),
          'time': $('#time').val(),
        },
        dataType: 'json',
        success: function (data) {
          console.log(data)
          loadColor();
          $("#myModal").modal('hide');
        }
      })
    }
  })

  function loadColor() {
    $(".change-level").each(function () {
      var value = $(this).val();
      switch (value) {
        case '-1':
          $(this).css('background-color', '#ff33ff');
          break;
        case '0':
          $(this).css('background-color', '#990099');
          break;
        case '1':
          $(this).css('background-color', '#ff8080');
          break;
        case '2':
          $(this).css('background-color', '#ff4d4d');
          break;
        case '3':
          $(this).css('background-color', '#FFD567');
          break;
        case '4':
          $(this).css('background-color', '#FFD567');
          break;
        case '5':
          $(this).css('background-color', '#FFD567');
          break;
        default:
          $(this).css('background-color', '#ffffff');
          break;
      }
      $(".change-level option").css('background-color', '#ffffff');
    });
  }


  // skill page

  get_data();

  $('#addSkill').click(function (e) {
    e.preventDefault();
    var skillid = $('#optionSkill').val();
    var position = $('#position').val();
    console.log(skillid);
    console.log(position);

    if (position == '' || position < 0) {
      $('.error').html('Error!!');
    } else {
      $.ajax({
        type: 'post',
        data: {
          'skillid': skillid,
          'position': position,
        },
        url: '/addskill',
        success: function (data) {
          console.log(data);
          $('#position').val('');
          $('#optionSkill').val('');
          $('.error').html('');
          get_data();
        }
      })
    }
  })

  $('body').on('click', '#deleteSkill', function (e) {
    e.preventDefault();
    var skillid = $(this).data('skillid');
    var position = $(this).data('position');
    $.ajax({
      url: '/skills/delete/' + skillid,
      type: 'GET',
      data: {
        id: skillid,
        position: position
      },
      success: function (response) {
        console.log(response);
        get_data();
      }
    });
  })

  function get_data() {
    $.ajax({
      url: '/getdata',
      type: 'GET',
      data: {
      }
    }).done(function (data) {
      console.log(data.selectedSkills);
      var rows = '';
      var count = 1;

      $.each(data.selectedSkills, function (key, value) {
        rows += '<tr>';
        rows += '<td style="text-align: center">' + count + ' </td>';
        rows += '<td>' + value.name + '</td>';
        rows += '<td style="text-align: center">' + value.position + '</td>';
        rows += '<td><a class="delete-skill" id="deleteSkill" data-skillid="' + value.id + '" data-position="' + value.position + '">Delete</a></td>';
        rows += '</tr>';
        count++;
      });
      $('#getSkillList').html(rows);

      var skill = '';
      skill += '<option value="">Add skill</option>'
      $.each(data.optionSkills, function (key, value) {
        skill += '<option value="' + value.id + '">' + value.name + '</option>'
      })
      $('#optionSkill').html(skill);
    });
  }
});
