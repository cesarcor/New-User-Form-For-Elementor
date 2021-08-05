jQuery(document).ready(function ($) {
  $(".nuf-new-user-form").on("submit", function (e) {
    e.preventDefault();
    var form = $(this);

    $.ajax({
      url: nuf_ajax.ajax_url,
      method: "POST",
      data: form.serialize(),
      dataType: "JSON",
      success: function (response) {
        console.log(response);
        if (!response.success) {
          validation_handler(
            response.data.validation_error_type,
            response.data.validation_error_code,
            response.data.validation_error_message
          );
        }
      },
      error: function (xhr) {
        console.log(xhr.responseText);
      },
    });
  });

  //Manage where the validation message displays
  function validation_handler(type, code, message) {
    if (type === "input_error") {
      switch (code) {
        case "password_mismatch":
          display_input_error("user_password_confirm", message);
          break;
        case "existing_user_login":
          display_input_error("username", message);
          break;
        case "existing_user_email":
          display_input_error("user_email", message);
          break;
      }
    }
  }

  function display_input_error(input, error) {
    $('[name="' + input + '"]').after(function () {
      return "<span>" + error + "</span>";
    });
  }
});
