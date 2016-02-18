(function() {
  var global = {
    "report_items": document.getElementById("report_items"),
    "expand_all": document.getElementById("expand_all")
  };

  report.onchange = function(event) {
    setGetParameter("report", this.value);
  }

  function setGetParameter(paramName, paramValue) {
      var url = window.location.href;
      var hash = location.hash;
      url = url.replace(hash, '');

      var queryString = null;
      var parts = url.split("?");
      var host = parts[0];

      var found = false;

      if (parts.length > 0) {
        queryString = parts[1];

        var parameters = queryString ? queryString.split("&") : [];
        var parameters_length = parameters.length;

        var processed = [];

        for (var i = 0; i < parameters_length; i++) {
          var parameter = parameters[i];
          var parameter = parameter.split("=");
          var name = parameter[0];
          var value = parameter[1] ? parameter[1] : "";

          if (name == paramName) {
            value = paramValue;
            found = true;
          }

          processed.push(name + "=" + value);
        }
      }

      if (!found) {
        processed.push(paramName + "=" + paramValue);
      }

      queryString = processed.length > 0 ? processed.join("&") : null;

      window.location.href = host + (queryString ? ("?" + queryString) : "");
  }

  //////////////////////////////////////////////////////////////////////////////
  //                          MOVE ITEMS MANUALLY
  //////////////////////////////////////////////////////////////////////////////
  function move(elements, direction) {
    var elements_length = elements.length;

    for (var i = 0; i < elements_length; i++) {
      var element = elements[i];

      element.onclick = function(event) {
        var id = this.getAttribute("data-move-" + direction);
        var item = document.querySelector("[data-report-item='" + id + "']");

        if (direction === "up") {
          if (item && item.previousElementSibling) {
            item.parentNode.insertBefore(item, item.previousElementSibling);
          }
        }
        else {
          var next = item && item.nextElementSibling ? item.nextElementSibling : null;
          next = next && next.nextElementSibling ? next.nextElementSibling : null;

          if (next) {
            item.parentNode.insertBefore(item, next);
          }
          else {
            item.parentNode.appendChild(item);
          }
        }

        item.setAttribute("data-moved", "");

        setTimeout(function() {
          item.removeAttribute("data-moved");
        }, 500);

        var data = {
          'action': 'move',
          'id': id,
          'direction': direction
        };

        jQuery.post(ajaxurl, data, function(response) {

        });
      }
    }

    renumber();
  }

  move(document.querySelectorAll("[data-move-up]"), "up");
  move(document.querySelectorAll("[data-move-down]"), "down");

  //////////////////////////////////////////////////////////////////////////////
  //                              DRAG & DROP
  //////////////////////////////////////////////////////////////////////////////

  dragula(
    [document.getElementById("report_items")],
    {

    }
  ).on('drag', function (el) {
    document.body.setAttribute("data-dragging", "");
  })
  .on('drop', function (el) {
    document.body.removeAttribute("data-dragging");

    var report_items = document.querySelectorAll("[data-report-item]:not(.gu-mirror)");
    var report_items_length = report_items.length;

    var elements = [];

    for (var i = 0; i < report_items_length; i++) {
      var report_item = report_items[i];
      var id = report_item.getAttribute("data-report-item");

      elements.push(id);
    }

    var data = {
      'action': 'drag',
      'elements': elements
    };

    jQuery.post(ajaxurl, data, function(response) {

    });

    renumber();
  })

  //////////////////////////////////////////////////////////////////////////////
  //                                OPEN BUTTONS
  //////////////////////////////////////////////////////////////////////////////
  var buttons = document.querySelectorAll("[data-open]");
  var buttons_length = buttons.length;

  for (var i = 0; i < buttons_length; i++) {
    var button = buttons[i];

    button.onmouseover = function(event) {
      var id = this.getAttribute("data-open");
      var content = document.querySelector("[data-content='" + id + "']");
      content.setAttribute("data-opened", "");
    }

    button.onmouseout = function(event) {
      if (this.clicked) {
        return;
      }

      var id = this.getAttribute("data-open");
      var content = document.querySelector("[data-content='" + id + "']");
      content.removeAttribute("data-opened");
    }

    button.onclick = function(event) {
      this.clicked = !this.clicked;
      this.innerHTML = this.clicked ? '<i class="fa fa-eye-slash fa-2x"></i>' : '<i class="fa fa-eye fa-2x"></i>';
    }
  }

  //////////////////////////////////////////////////////////////////////////////
  //                                  ANCHOR
  //////////////////////////////////////////////////////////////////////////////
  var anchored = document.querySelectorAll("[data-anchor]");
  var anchored_length = anchored.length;

  for (var i = 0; i < anchored_length; i++) {
    var anchor = anchored[i];

    anchor.onclick = function(event) {
      var id = this.getAttribute("data-anchor");
      var value = this.getAttribute("data-anchored");

      value = (value !== "true") ? "true" : "false";
      this.setAttribute("data-anchored", value);

      var data = {
        'action': 'anchor',
        'element': id,
        'value': value
      };

      jQuery.post(ajaxurl, data, function(response) {

      });
    }
  }

  //////////////////////////////////////////////////////////////////////////////
  //                                    AUX
  //////////////////////////////////////////////////////////////////////////////

  global.expand_all.onclick = function(event) {
    for (var i = 0; i < buttons_length; i++) {
      var button = buttons[i];

      if (!button.clicked) {
        button.click();
        button.onmouseover();
      }
    }
  }

  //////////////////////////////////////////////////////////////////////////////
  //                                    AUX
  //////////////////////////////////////////////////////////////////////////////

  function renumber() {
    var numbers = document.querySelectorAll("[data-order-number]");
    var numbers_length = numbers.length;

    for (var i = 0; i < numbers_length; i++) {
      var number = numbers[i];
      number.innerHTML = (i + 1);
    }
  }
})();
