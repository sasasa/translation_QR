
<script type="module">
  $(function(){
      // alert($('#parent_id').val())

      // createOptions();

      $("#lang").change(function() {
        // alert($("#lang").val());
        createOptions();
      });

      function createOptions()
      {
        $('#parent_id > option').remove();
        var json1 = {
          "lang": $("#lang").val(),
        };
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
          url: "/json/parents/" + $("#lang").val(),
          type: "post",
          contentType: "application/json",
          data: JSON.stringify(json1),
          dataType: "json",
        }).done(function(data1, textStatus, jqXHR) {
            // alert(jqXHR.status);
            // alert(JSON.stringify(data1.genres));
            // alert(JSON.stringify(data1));
            $('#parent_id').append($('<option>').html('階層構造にする場合は選択してください').val(''));
            $.each(data1.genres, function(index, value) {
              $('#parent_id').append($('<option>').html(value).val(index))
            })
        }).fail(function(jqXHR, textStatus, errorThrown){
            // alert("err:" + jqXHR.status);
            // alert(textStatus);
            // alert(errorThrown);
        }).always(function(){
        });
      }

  });
  </script>