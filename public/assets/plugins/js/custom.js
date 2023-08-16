(function ($) {
  "use strict";

  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });

  $.fn.initValidate = function () {
    $(this).validate({
      errorClass: "is-invalid text-danger",
      validClass: "",
    });
  };

  $.fn.initFormValidation = function () {
    var validator = $(this).validate({
      errorClass: "is-invalid",
      highlight: function (element, errorClass) {
        var elem = $(element);
        if (elem.hasClass("select2-hidden-accessible")) {
          $("#select2-" + elem.attr("id") + "-container")
            .parent()
            .addClass(errorClass);
        } else if (elem.hasClass("input-group")) {
          $("#" + elem.add("id"))
            .parents(".input-group")
            .append(errorClass);
        } else if (elem.parents().hasClass("image-checkbox")) {
          Notify("error", null, elem.parent().data("required"));
        } else {
          elem.addClass(errorClass);
        }
      },
      unhighlight: function (element, errorClass) {
        var elem = $(element);
        if (elem.hasClass("select2-hidden-accessible")) {
          $("#select2-" + elem.attr("id") + "-container")
            .parent()
            .removeClass(errorClass);
        } else {
          elem.removeClass(errorClass);
        }
      },
      errorPlacement: function (error, element) {
        var elem = $(element);
        if (elem.hasClass("select2-hidden-accessible")) {
          element = $("#select2-" + elem.attr("id") + "-container").parent();
          error.insertAfter(element);
        } else if (elem.parents().hasClass("image-checkbox")) {
        } else if (elem.parent().hasClass("form-floating")) {
          error.insertAfter(element.parent().css("color", "text-danger"));
        } else if (elem.parent().hasClass("input-group")) {
          error.insertAfter(element.parent());
        } else {
          error.insertAfter(element);
        }
      },
    });

    $(this).on("select2:select", function () {
      if (!$.isEmptyObject(validator.submitted)) {
        validator.form();
      }
    });
  };

  // Select2 Initialization
  var select2FocusFixInitialized = false;
  var initSelect2 = function () {
    // Check if jQuery included
    if (typeof jQuery == "undefined") {
      return;
    }

    // Check if select2 included
    if (typeof $.fn.select2 === "undefined") {
      return;
    }

    var elements = [].slice.call(
      document.querySelectorAll('[data-control="select2"]')
    );

    elements.map(function (element) {
      var options = {
        dir: document.body.getAttribute("direction"),
      };

      if (element.getAttribute("data-hide-search") == "true") {
        options.minimumResultsForSearch = Infinity;
      }

      if (element.hasAttribute("data-placeholder")) {
        options.placeholder = element.getAttribute("data-placeholder");
      }

      $(document).ready(function () {
        $(element).select2(options);
      });
    });

    /*
     * Hacky fix for a bug in select2 with jQuery 3.6.0's new nested-focus "protection"
     * see: https://github.com/select2/select2/issues/5993
     * see: https://github.com/jquery/jquery/issues/4382
     *
     * TODO: Recheck with the select2 GH issue and remove once this is fixed on their side
     */

    if (select2FocusFixInitialized === false) {
      select2FocusFixInitialized = true;

      $(document).on("select2:open", function (e) {
        var elements = document.querySelectorAll(
          ".select2-container--open .select2-search__field"
        );
        if (elements.length > 0) {
          elements[elements.length - 1].focus();
        }
      });
    }
  };

  initSelect2();
})(jQuery);

function showInputErrors(errors) {
  if (typeof errors["errors"] !== "undefined") {
    $.each(errors["errors"], function (index, value) {
      $("#" + index + "-error").remove();
      let $errorLable =
        '<label id="' +
        index +
        '-error" class="is-invalid" for="' +
        index +
        '">' +
        value +
        "</label>";
      if (
        $("#" + index)
          .parents()
          .hasClass("form-check")
      ) {
        $("#" + index)
          .parents()
          .find(".form-check")
          .append($errorLable);
      } else {
        $("#" + index)
          .addClass("is-invalid")
          .after($errorLable);
      }
    });
  }
}

$(document).ready(function () {
  if (window.sessionStorage.hasPreviousMessage === "true") {
    Notify(
      "success",
      null,
      window.sessionStorage.previousMessage,
      window.sessionStorage.redirect
    );
    window.sessionStorage.hasPreviousMessage = false;
  }
});

/*-------------------------------
Action Confirmation Alert
-----------------------------------*/
$(document).on("click", ".confirm-action", function (event) {
  event.preventDefault();

  let url = $(this).data("action") ?? $(this).attr("href");
  let method = $(this).data("method") ?? "POST";
  let icon = $(this).data("icon") ?? "fas fa-warning";

  $.confirm({
    title: "Heads Up!",
    icon: icon,
    theme: "modern",
    closeIcon: true,
    animation: "scale",
    type: "red",
    scrollToPreviousElement: false,
    scrollToPreviousElementAnimate: false,
    buttons: {
      confirm: {
        btnClass: "btn-red",
        action: function () {
          event.preventDefault();
          $.ajax({
            type: method,
            url: url,
            success: function (response) {
              if (response.redirect) {
                window.sessionStorage.hasPreviousMessage = true;
                window.sessionStorage.previousMessage =
                  response.message ?? null;

                location.href = response.redirect;
              } else {
                toastr.success(response.message);
              }
            },
            error: function (xhr, status, error) {
              Notify("error", xhr);
              toastr.error(xhr);
            },
          });
        },
      },
      close: {
        action: function () {
          this.buttons.close.hide();
        },
      },
    },
  });
});

let $savingLoader = '<div class="spinner-border spinner-border-sm" role="status">' +
'<span class="visually-hidden">Loading...</span>' +
'</div>';

// Show Success Message After Page Reload
let $ajaxform_instant_reload = $(".ajaxform_instant_reload");
$ajaxform_instant_reload.initFormValidation();

$(document).on("submit", ".ajaxform_instant_reload", function (e) {
  e.preventDefault();

  let $this = $(this);
  let $submitBtn = $this.find(".submit-btn");
  let $oldSubmitBtn = $submitBtn.html();

  if ($ajaxform_instant_reload.valid()) {
    $.ajax({
      type: "POST",
      url: this.action,
      data: new FormData(this),
      dataType: "json",
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function () {
        $submitBtn.html($savingLoader).addClass("disabled").attr("disabled", true);
      },
      success: function (res) {
        $submitBtn.html($oldSubmitBtn).removeClass("disabled").attr("disabled", false);
        window.sessionStorage.hasPreviousMessage = true;
        window.sessionStorage.previousMessage = res.message ?? null;

        if (res.redirect) {
          location.href = res.redirect;
        }
      },
      error: function (xhr) {
        $submitBtn.html($oldSubmitBtn).removeClass("disabled").attr("disabled", false);
        showInputErrors(xhr.responseJSON);
        toastr.error("error", xhr, null, xhr.responseJSON.url ?? null);
      },
    });
  }
});

let $ajaxform = $('.ajaxform');
$ajaxform.initFormValidation();

$(document).on('submit', '.ajaxform', function (e) {
    e.preventDefault();

    let $this = $(this);
    let $submitBtn = $this.find(".submit-btn");
    let $oldSubmitBtn = $submitBtn.html();

    if ($ajaxform.valid()) {
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
              $submitBtn.html($savingLoader).addClass("disabled").attr("disabled", true);
            },
            success: function (res) {
              $submitBtn.html($oldSubmitBtn).removeClass("disabled").attr("disabled", false);
              toastr.success(res.message);
            },
            error: function (xhr) {
              $submitBtn.html($oldSubmitBtn).removeClass("disabled").attr("disabled", false);
              showInputErrors(xhr.responseJSON);
              toastr.error(xhr);
            }
        });
    }
});
