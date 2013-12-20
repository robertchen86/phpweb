;(function (exports) {
  Chart.FloatTag = function () {
    //set floatTag location, warning: the html content must be set before call this func,
    // because jqNode's width and height depend on it's content;
    var _changeLoc = function (m) {
      //m is mouse location, example: {x: 10, y: 20}
      var x = m.x;
      var y = m.y;
      var floatTagWidth = jqNode.outerWidth();
      var floatTagHeight = jqNode.outerHeight();
      if (floatTagWidth + x + 2 * mouseToFloatTag.x <=  $(container).width()) {
        x += mouseToFloatTag.x;
      } else {
        x = x - floatTagWidth - mouseToFloatTag.x;
      }
      if (y >= floatTagHeight + mouseToFloatTag.y) {
        y = y - mouseToFloatTag.y - floatTagHeight;
      } else {
        y += mouseToFloatTag.y;
      }
      jqNode.css("left",  x  + "px");
      jqNode.css("top",  y + "px");
    };
    var _mousemove = function (e) {
      var offset = $(container).offset();
      if (!(e.pageX && e.pageY)) {return false;}
      var x = e.pageX - offset.left,
          y = e.pageY - offset.top;

      setContent.call(this);
      _changeLoc({'x': x, 'y': y});
    };

    var mouseToFloatTag = {x: 20, y: 20};
    var setContent = function () {};
    var jqNode;
    var container;

    var floatTag = function (cont) {
      container = cont;
      jqNode = $("<div/>").css({
        "border": "1px solid",
        "border-color": $.browser.msie ? "rgb(0, 0, 0)" : "rgba(0, 0, 0, 0.8)",
        "background-color": $.browser.msie ? "rgb(0, 0, 0)" : "rgba(0, 0, 0, 0.75)",
        "color": "white",
        "border-radius": "2px",
        "padding": "12px 8px",
        //"line-height": "170%",
        //"opacity": 0.7,
        "font-size": "12px",
        "box-shadow": "3px 3px 6px 0px rgba(0,0,0,0.58)",
        "font-familiy": "宋体",
        "z-index": 10000,
        "text-align": "center",
        "visibility": "hidden",
        "position": "absolute"
      });
      $(container).append(jqNode)
        .mousemove(_mousemove);
      jqNode.creator = floatTag;
      return jqNode;
    };

    floatTag.setContent = function (sc) {
        if (arguments.length === 0) {
          return setContent;
        }
        setContent = sc;
        return floatTag;
    };

    floatTag.mouseToFloatTag = function (m) {
        if (arguments.length === 0) {
          return mouseToFloatTag;
        }
        mouseToFloatTag = m;
        return floatTag;
    };

    floatTag.changeLoc = _changeLoc;

    return floatTag;
  };
}(window.Chart = window.Chart || {}));