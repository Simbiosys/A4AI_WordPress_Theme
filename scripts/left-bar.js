(function() {
  var clearActive, closeMenu, direction, li, openMenu, setActiveArticle, _i, _len, _ref;

  direction = 1;

  $(function() {
    var body, footerHeight, height, html, leftBar, leftBarHeight, msie6, previousY, top, _ref;
    msie6 = $.browser === "msie" && $.browser.version < 7;
    leftBar = $(".left-bar");
    top = null;
    body = document.body;
    html = document.documentElement;
    height = Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight);
    footerHeight = (_ref = document.getElementById("Footer")) != null ? _ref.clientHeight : void 0;

    if (footerHeight) {
      height -= footerHeight;
    }

    leftBarHeight = leftBar.height();
    previousY = -1;

    if (!msie6) {
      return $(window).scroll(function(event) {
        var y;

        if (top == null) {
          top = leftBar.offset().top;
        }

        y = $(this).scrollTop();
        direction = y - previousY;

        if (y >= top && (y + leftBarHeight) < height) {
          leftBar.addClass("fixed");
        } else {
          leftBar.removeClass("fixed");
        }

        return previousY = y;
      });
    }
  });

  setActiveArticle = function(id) {
    var a;
    a = document.querySelector("a[href='\#" + id + "']");
    clearActive();

    if (a && a.parentNode) {
      a.parentNode.className = "active";
    }
  };

  //////////////////////////////////////////////////////////////////////////////
  //                            Scroll management
  //////////////////////////////////////////////////////////////////////////////

  var manual_click = false;

  var articles = document.querySelectorAll("article.text-article");
  var articles_length = articles.length;

  for (var i = 0; i < articles_length; i++) {
    var article = articles[i];
    var id = article.id;
    var children = article.children;
    var children_length = children.length;

    for (var j = 0; j < children_length; j++) {
      var child = children[j];
      child.setAttribute("data-chapter-id", id);
    }
  }

  $("[data-chapter-id]").scrolledIntoView().on('scrolledin', function() {
    var id = $(this).attr('data-chapter-id');
    setActiveArticle(id);
  }).on('scrolledout', function() {
    if (manual_click) {
      return;
    }

    if (direction < 0) {
      var previousChapter = $(this).prev().attr('data-chapter-id');
      setActiveArticle(previousChapter);
    }
  });

  $(".report-title").scrolledIntoView().on('scrolledin', function() {
    clearActive();
  });

  clearActive = function() {
    var li, _i, _len, _ref, _results;
    _ref = document.querySelectorAll(".left-bar .tags li.active");
    _results = [];

    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
      li = _ref[_i];
      _results.push(li.className = "");
    }

    return _results;
  };

  openMenu = function() {
    var leftBar = document.querySelector(".left-bar");

    if (leftBar.className.indexOf("opened") === -1) {
      return leftBar.className = leftBar.className + " opened";
    }
  };

  closeMenu = function() {
    var leftBar = document.querySelector(".left-bar");

    if (leftBar.className.indexOf("opened") !== -1) {
      return leftBar.className = leftBar.className.replace(" opened", "");
    }
  };

  _ref = document.querySelectorAll(".left-bar .tags li");

  for (_i = 0, _len = _ref.length; _i < _len; _i++) {
    li = _ref[_i];

    li.onclick = function() {
      manual_click = true;

      if (this.className !== "active") {
        clearActive();
        this.className = "active";
        closeMenu();
        return true;
      } else {
        openMenu();
        return false;
      }

      manual_click = false;
    };
  }

}).call(this);
