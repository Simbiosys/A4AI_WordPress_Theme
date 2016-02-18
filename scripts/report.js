
/*
visualisations = document.querySelectorAll(".hidden-visualisations div.visualisation")

for visualisation in visualisations
  anchor = visualisation.getAttribute("data-anchor")

  if anchor
    wrapper = document.querySelector(".visualisation-wrapper[data-visualisation='#{anchor}']")
    if wrapper
      wrapper.appendChild(visualisation)
      continue

  position = visualisation.getAttribute("data-position")

  if !position then continue

  container = document.querySelector(".report-articles article:nth-child(#{position})")

  if !container then continue

  nav = container.querySelector("nav")

  if !nav then continue

  nav.parentNode.insertBefore(visualisation, nav.nextSibling);
 */

(function() {
  var className, i, item, items, numberOfCells, row, rows, table, tables, td, tdClosed, tdOpened, tr, _i, _j, _k, _len, _len1, _ref;

  items = document.querySelectorAll("#table-of-contents i.fa");

  for (_i = 0, _len = items.length; _i < _len; _i++) {
    item = items[_i];
    item.opened = false;
    item.arrow = item;
    item.onclick = function(event) {
      var list, opened;
      opened = !this.opened;
      this.opened = opened;
      list = this.parentNode.querySelector("ol, ul");
      if (opened) {
        this.arrow.className = "fa fa-angle-up fa-2x";
        return list.style.display = "block";
      } else {
        this.arrow.className = "fa fa-angle-down fa-2x";
        return list.style.display = "none";
      }
    };
  }

  tables = document.querySelectorAll("table.data-table:not(.full-table)");

  tdOpened = "View less <i class='fa fa-angle-double-up'></i>";

  tdClosed = "View more <i class='fa fa-angle-double-down'></i>";

  for (_j = 0, _len1 = tables.length; _j < _len1; _j++) {
    table = tables[_j];
    var tbody = table.querySelector("tbody");
    rows = tbody.children;

    if (rows.length < 10) {
      continue;
    }

    table.setAttribute("data-collapsable", "collapsed");

    numberOfCells = 1;

    for (i = _k = 10, _ref = rows.length - 1; 10 <= _ref ? _k <= _ref : _k >= _ref; i = 10 <= _ref ? ++_k : --_k) {
      row = rows[i];
      className = row.className;
      row.className = "" + className + " hidden";
      numberOfCells = row.children.length;
    }

    tr = document.createElement("tr");
    tr.className = "view-more";
    tr.setAttribute("data-view-more", "");
    tbody.appendChild(tr);
    td = document.createElement("td");
    td.setAttribute("colspan", numberOfCells);
    td.innerHTML = tdClosed;
    tr.appendChild(td);
    td.opened = false;
    td.table = tbody;

    td.onclick = function(event) {
      var opened;
      opened = !this.opened;
      this.opened = opened;
      this.table.className = opened ? "opened" : "";
      return this.innerHTML = opened ? tdOpened : tdClosed;
    };

    table.render = function() {
      var tbody = this.querySelector("tbody");
      var rows = tbody.children;
      var rows_length = rows.length;

      for (var i = 0; i < rows_length; i++) {
        var row = rows[i];

        if (row.hasAttribute("data-view-more")) {
          continue;
        }

        row.className = row.className.replace(" hidden", "");

        if (i >= 10) {
          row.className = row.className + " hidden";
        }
      }
    }
  }

  // Sortable tables
  var tables = document.querySelectorAll("[data-sortable]");
  var tables_length = tables.length;

  for (var i = 0; i < tables_length; i++) {
    var table = tables[i];

    (function (table) {
      var headers = table.querySelectorAll("thead tr:last-child th");
      var headers_length = headers.length;

      for (var j = 0; j < headers_length; j++) {
        var header = headers[j];
        header.setAttribute("data-index", j);

        if (!header.hasAttribute("data-status")) {
          header.setAttribute("data-status", "empty");
        }

        var a = document.createElement('a');
        a.href = 'javascript:void(0)';
        a.title = 'Click to sort column';
        a.className = 'sortable-column';
        a.innerHTML = header.innerHTML;

        header.innerHTML = '';

        var span = document.createElement('span');
        span.className = 'table-sorter';
        a.appendChild(span);

        header.appendChild(a);

        var up = document.createElement('i');
        up.className = 'fa fa-caret-up fa-2x';
        span.appendChild(up);

        var down = document.createElement('i');
        down.className = 'fa fa-caret-down fa-2x';
        span.appendChild(down);

        header.onclick = function(event) {
          var index = this.getAttribute("data-index");
          var rows = table.querySelectorAll("tbody tr");
          rows = Array.prototype.slice.call(rows, 0);
          var rows_length = rows.length;

          var status = this.getAttribute("data-status");

          switch (status) {
            case "empty":
              status = "up";
              break;
            case "up":
              status = "down";
              break;
            case "down":
              status = "up";
              break;
          }

          // Restore all headers to empty
          for (var i = 0; i < headers_length; i++) {
            var header = headers[i];
            header.setAttribute("data-status", "empty");
          }

          this.setAttribute("data-status", status);

          rows.sort(function(a, b) {
            if (a.hasAttribute("data-view-more")) {
              return 1;
            }
            else if (b.hasAttribute("data-view-more")) {
              return -1;
            }

            var a_cell = a.cells[index];
            var b_cell = b.cells[index];

            var a_value = a_cell.getAttribute("data-value");
            var b_value = b_cell.getAttribute("data-value");

            if (a_cell.hasAttribute("data-number")) {
              if (!a_value) {
                a_value = 0;
              }

              a_value = parseFloat(a_value);
            }

            if (b_cell.hasAttribute("data-number")) {
              if (!b_value) {
                b_value = 0;
              }

              b_value = parseFloat(b_value);
            }

            if (a_value === b_value) {
              return 0;
            }

            var increment = status === "down" ? 1 : -1;

            return a_value < b_value ? increment : -increment;
          });

          for (var i = 0; i < rows_length; i++) {
            var row = rows[i];
            row.parentNode.appendChild(row);
          }

          if (table.hasAttribute("data-collapsable") && table.getAttribute("data-collapsable") === "collapsed") {
            table.render();
          }
        }
      }
    })(table);
  }

  // External links
  function getDomainName(domain) {
      var parts = domain.split('.').reverse();
      var cnt = parts.length;

      if (cnt >= 3) {
          // see if the second level domain is a common SLD.
          if (parts[1].match(/^(com|edu|gov|net|mil|org|nom|co|name|info|biz)$/i)) {
              return parts[2] + '.' + parts[1] + '.' + parts[0];
          }
      }
      return parts[1] + '.' + parts[0];
  }

  function isExternalUrl(url) {
  	var curLocationUrl = getDomainName(location.href.replace("http://", "").replace("https://", "").replace("//", "").split("/")[0].toLowerCase());
  	var destinationUrl = getDomainName(url.replace("http://", "").replace("https://", "").replace("//", "").split("/")[0].toLowerCase());
  	return !(curLocationUrl === destinationUrl)
  }

  var anchors = document.querySelectorAll("[data-report-content] a");
  var anchors_length = anchors.length;

  for (var i = 0; i < anchors_length; i++) {
    var anchor = anchors[i];
    var href = anchor.href;

    if (!href.startsWith || !href.startsWith("http")) {
      continue;
    }

    var external = isExternalUrl(href);

    if (external) {
      anchor.setAttribute("target", "_blank");
/*
      var ie = document.createElement('i');
      ie.className = "fa fa-external-link external-link";
      anchor.appendChild(ie); */
    }
  }

  // Year Selector
  document.getElementById("btn-year").onclick = function(event) {
    var url = document.getElementById("year-selector").value;
    window.location.href = url;
  }

  // Footnotes
  var footnotes = document.querySelectorAll(".footnote-text");
  var footnotes_length = footnotes.length;

  if (footnotes_length > 0) {
    document.getElementById("footnotes").style.display = 'block';
  }

  var footnotes_container = document.getElementById("footnotes_container");

  for (var i = 0; i < footnotes_length; i++) {
    var footnote = footnotes[i];
    footnote.id = "footnote_" + (i + 1);
    footnote.href = "#footnotes";

    var sup = document.createElement("sup");
    sup.innerHTML = i + 1;
    footnote.appendChild(sup);

    var title = footnote.getAttribute("title");
    var li = document.createElement("li");

    var a_to_top = document.createElement("a");
    a_to_top.id = "footnote_desc_" + (i + 1);
    a_to_top.href = "#" + footnote.id;
    a_to_top.innerHTML = '<i class="fa fa-level-up fa-flip-horizontal"></i>';
    li.appendChild(a_to_top);

    var text = document.createTextNode(title);
    li.appendChild(text);

    footnotes_container.appendChild(li);
  }
}).call(this);
