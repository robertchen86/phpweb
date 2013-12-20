;(function (exports) {
  /**
   * Matrix构造函数，继承自Chart
   * Options:
   *
   *   - `width` 数字，画布宽度，默认为500，表示图片高500px
   *   - `height` 数字，画布高度，默认为300
   *   - `margin` 数组，图表在画布中四周的留白，长度为4，分别代表[top, right, bottom, left], 默认值为[10, 10, 10, 10]
   *   - `hasMash` 布尔值，是否需要绘制网格线，默认为true
   *   - `mashStyle` {Object}，图表网格线样式，默认为{'stroke': '#efefef', 'stroke-width': 1, 'stroke-opacity': 1}
   *   - `fontStyle` {Object}，坐标轴文字样式，默认为{'font-size': 14, 'font-family': '方正兰亭黑简体', 'fill': '#000', 'text-anchor': 'end'}
   *   - `nTextPadding` 数字，左侧文本距离表格左侧边缘距离，默认为10
   *   - `adaptive` 布尔值，是否根据画布大小自适应排布以及圆球大小，默认为true
   *   - `minRadius` 数字，当不使用自适应排布时，手动设置的圆球最小半径，默认为0
   *   - `maxRadius` 数字，当不使用自适应排布时，手动设置的圆球最大半径，默认为0
   *   - `level` 数字，数据划分等级阶数，默认为6
   *   - `colors` 字符串数组，圆球填充色，默认为['#e72e8b', '#d94f21', '#f3c53c', '#8be62f', '#14cc14']

   * Create matrix in a dom node with id "chart", width is 500px; height is 600px;
   * Examples:
   * ```
   * var matrix = new Matrix("chart", {"width": 500, "height": 600});
   * ```
   * @param {Mix} node The dom node or dom node Id
   * @param {Object} options options json object for determin line style.
   */
   /*给出背景设置*/
  var Matrix = exports.Matrix = function (node, options) {
		this.node = node;
		
		this.defaults = {};
		this.defaults.width = 500;
		this.defaults.height = 300;
		this.defaults.margin = [10, 10, 10, 10];

		this.defaults.hasMash = true;
    this.defaults.mashStyle = {'stroke': '#efefef', 'stroke-width': 1, 'stroke-opacity': 1};
		this.defaults.fontStyle = {'font-size': 14, 'font-family': '方正兰亭黑简体', 'fill': '#000', 'text-anchor': 'end'};
    this.defaults.nTextPadding = 10;

		this.defaults.adaptive = true;
		this.defaults.minRadius = 0;
		this.defaults.maxRadius = 0;
    this.defaults.level = 10;
		//this.defaults.colors = ['#e72e8b', '#d94f21', '#f3c53c', '#8be62f', '#14cc14'] */;
		// 旧色盘由闻啸提供*/
		this.defaults.colors = ['#2f7ed8', '#0d233a', '#8bbc21', '#910000', '#1aadce', '#492970','#f28f43', '#77a1e5', '#c42525', '#a6c96a']
		// 新色盘和Highcharts的学生界面保持一致 */
		this.setOptions(options);
    this.createPaper();
	};

	Matrix.prototype.setOptions = function (options) {
    return _.extend(this.defaults, options);
  };

  Matrix.prototype.createPaper = function () {
    var conf = this.defaults;
    this.paper = new Raphael(this.node, conf.width, conf.height);
   
    this.canvasF = document.getElementById(this.node);
    canvasStyle = this.canvasF.style;
    canvasStyle.position = "relative";
    this.floatTag = Chart.FloatTag()(this.canvasF);
    this.floatTag.css({"visibility": "hidden"});

  };

  // 开始接收数据
  //input 1是总做题数，input 2 是做对题数
  Matrix.prototype.setSource = function (doneData, correctData) {
  	var conf = this.defaults;
  	var width = conf.width;
  	var height = conf.height;
  	var margin = conf.margin;
    var ntp = conf.nTextPadding;

    var nameList = _.pluck(doneData, 'name'); // 找出学生姓名
    var courseList = _.without(_.keys(doneData[0]), 'name');//除name外所有的field皆为课程名称
    var sNum = nameList.length;
    var cNum = courseList.length;
	/*自以下开始为自动设置字体*/
    var fontST = 'font-size';
    var fontSize = conf.fontStyle[fontST];
    var nameW = (_.max(nameList, function (d) {return d.length})).length; //找出最长字段名
    var courseW = (_.max(courseList, function (d) {return d.length})).length;

    var fontW = nameW * fontSize + ntp;
    var fontH = Math.round(1.5 * fontSize);
	/*自以下开始为设置圈大小*/
  	var adaptive = conf.adaptive;
  	var rW;
  	var rH;
    var rStep;
    var xStep;
    var yStep;
    var minR = conf.minRadius;
    var maxR = conf.maxRadius;
    var level = conf.level;
  	if (adaptive || minRadius >= maxRadius) {
  		rW = width - margin[1] - margin[3] - fontW;
      rH = height - margin[0] - margin[2] - fontH;

      xStep = Math.floor(rW / cNum);
      yStep = Math.floor(rH / sNum);

      rStep = _.min([xStep, yStep]);
      maxR = Math.floor(rStep * 0.95);
      minR = _.max([Math.floor(rStep * (1 / level)), 5]);
  	} else {
      rStep = Math.round(maxR / 0.9);
      rW = rStep * sNum;
      rH = rStep * cNum;
      xStep = rStep;
      yStep = rStep;
  	}
	/*转类为表*/
    var dataTable = [];
    var correctTable = [];
    for (var i = 0; i < sNum; i++) {
      var sData = doneData[i];
      var cData = correctData[i];
      for (var j = 0; j < cNum; j++) {
        var cName = courseList[j];
        if (sData[cName]) {
          dataTable.push(parseInt(sData[cName], 10));
        } else {
			//如果数据空缺，补0
          dataTable.push(0);
        }

        if (cData[cName]) {
          correctTable.push(parseInt(cData[cName], 10));
        } else {
          correctTable.push(0);
        }
      }
    }
    // // 根据排名
    // var dNum = dataTable.length;
    // var lStep = Math.round(dNum / level);
    // var sortList = _.sortBy(dataTable, function (d) {return d;});
    // var dR = maxR - minR;
    // var dStep = Math.floor(dR / level);

    // for (var i = 0; i < dNum; i++) {
    //   var data = dataTable[i];
    //   var num = _.sortedIndex(sortList, data);
    //   var l = Math.floor(num / lStep);
    //   var r = l * dStep + minR;
    //   dataTable[i] = {data: data, level: l, radius: r};
    // }

    // // 根据绝对值,渐变折算半径
    // var dNum = dataTable.length;
    // var min = _.min(dataTable);
    // var max = _.max(dataTable);
    // var dNum = max - min;
    // var lStep = dNum / level;
    // var sortList = _.sortBy(dataTable, function (d) {return d;});
    // var dR = maxR - minR;
    // var dStep = dR / level;

    // for (var i = 0; i < dNum; i++) {
    //   var data = dataTable[i];
    //   var num = _.sortedIndex(sortList, data);
    //   var l = Math.floor((num - min) / lStep);
    //   var r = (data - min) / dNum * dR;
    //   dataTable[i] = {data: data, level: l, radius: r};
    // }

    // 根据绝对值,跳阶折算半径
    var dNum = dataTable.length; //数据数
    var min = _.min(dataTable);//数据中的极值
    var max = _.max(dataTable);
    var dNum = max - min;
	/**
		ToDo：dNum重复定义
	**/
	


    /**
	var lStep = dNum / level; //根据跳级数来确定题数步长
    var sortList = _.sortBy(dataTable, function (d) {return d;});//为做题数排序
    var dR = maxR - minR;
    var dStep = dR / level;//根据跳级数来确定圆半径长
	闻啸的原始代码，做题数为圆半径，正确率为透明度
	for (var i = 0; i < dNum; i++) {
      var data = dataTable[i];
      var cData = correctTable[i];
      var l = Math.floor((data - min) / lStep); //跳级后的做题数类别
      var r = Math.floor(l * dStep + minR);//做题数类别所对应的圆长
      if (data === 0) {
        r = 2;
      }
      var pl;
      if (data) {
        pl = Math.round(cData / data * 100);//计算正确率, 100 = 100%
      } else {
        pl = 0;
      }

      var percentTitle = courseList[i % cNum] + '准确率';
      var itemNum = Math.floor(i / cNum);
      if (itemNum < sNum) {
        var item = doneData[itemNum];
        item[percentTitle] = pl;
      }

      dataTable[i] = {data: data, cData: cData, level: pl, radius: r}; //写入类中
    }
	**/
	
	/* 新代码，正确率为半径，做题数为透明度 */
	/* 正确率分5档，每20%为一档 */
    var dR = maxR - minR;
    var dStep = dR / level;//根据跳级数来确定圆半径长
	
	for (var i = 0; i < dNum; i++) {
      var data = dataTable[i];
      var cData = correctTable[i];
      var pl;
      if (data) {
        pl = Math.round(cData / data * 100);//计算正确率, 100 = 100%
      } else {
        pl = 0;
      }	  
	  
      var l = Math.floor((pl - 0) / 20); //正确率类别
      var r = Math.floor(l * dStep + minR);//正确率类别所对应的圆长
      if (data === 0) {
        r = 2;
      }
	
	  var opacityLevel =  data/100 //100题即为非常准确，但是参数值不能超过1
	  /** ToDo: 把100设置为系统参数 **/

      var percentTitle = courseList[i % cNum] + '准确率';
      var itemNum = Math.floor(i / cNum);
      if (itemNum < sNum) {
        var item = doneData[itemNum];
        item[percentTitle] = pl;
      }

      dataTable[i] = {data: data, cData: cData, level: opacityLevel, radius: r, correctPct: pl}; //写入类中
    }	

    this.doneData = doneData;
    this.correctData = correctData;
    this.dataTable = dataTable;
    this.nameList = nameList;
    this.courseList = courseList;
    this.rW = rW;
    this.rH = rH;
    this.startX = margin[3] + fontW;
    this.startY = margin[0] + fontH;
    this.xStep = xStep;
    this.yStep = yStep;
    this.fontH = fontH;

    this.setSelector();//排序法
  };
  
	//排序法设置
  Matrix.prototype.setSelector = function () {
    var that = this;
    var node = this.node;
    var cList = this.courseList;
    var cNum = cList.length;
    var startX = this.startX;
    var rW = this.rW;
    var fontH = this.fontH;
    var jNode = document.getElementById(node);

    var select = document.createElement("select");
    select.id = "selector";
    select.options.add(new Option("做题总数", 0));
    for (var i = 0, l = cNum; i < l; i++) {
      var cName = cList[i];
      select.options.add(new Option(cName + "做题数", (i + 1)));
    }
    select.options.add(new Option("总体准确率", cNum + 1));
    for (var i = 0, l = cList.length; i < l; i++) {
      var cName = cList[i];
      select.options.add(new Option(cName + "准确率", (i + cNum + 2)));
    }

    var x = startX + rW + 15;
    var y = fontH / 2;
    $(select).css({
      "position": "absolute",
      "left": x + "px",
      "top": y + "px"
    });

    $(select).change(function () {
      var index = select.selectedIndex;
      that.sortBy(index);
    });

    jNode.appendChild(select);
  };
	// 根据什么排序
  Matrix.prototype.sortBy = function (index) {
    var cList = this.courseList;
    var cNum = cList.length;
    var nList = this.nameList;
    var sList = this.studentList;
    var doneData = this.doneData;
    var correctData = this.correctData;
    var yStep = this.yStep;

    var moveList = [];
    var sortName;
    var sortData;
    if (index > 0 && index !== cNum + 1) {
      var sortCourse = cList[index - 1];
      if (index > cNum) {
        sortCourse = cList[index - cNum - 2];
        sortCourse += '准确率';
      }
      sortData = _.sortBy(doneData, function (d) {return 0 - d[sortCourse];});
      sortName = _.pluck(sortData, 'name');
    } else {
      sortData = _.sortBy(doneData, function (d, i) {
        var sum = 0;
        if (index) {
          var cD = correctData[i];
          var dSum = 0;
          var cSum = 0;
          for (var i = 0, l = cList.length; i < l; i++) {
            var cName = cList[i];
            dSum += d[cName];
            cSum += cD[cName];
          }
          
          if (dSum) {
            sum = 0 - Math.floor(cSum / dSum * 100);
          } else {
            sum = 0
          }
        } else {
          for (var i = 0, l = cList.length; i < l; i++) {
            var cName = cList[i];
            sum -= d[cName];
          }
        }

        console.log(d['name'], sum);
        return sum;
      });
      sortName = _.pluck(sortData, 'name');
    }

    console.log(sortData);
    console.log(sortData);

    for (var i = 0, l = nList.length; i < l; i++) {
      var name = nList[i];
      var num = _.indexOf(sortName, name) - i;
      moveList.push(num);
    }
    console.log(moveList);

    for (var j = 0, k = sList.length; j < k; j++) {
      var moveNum = moveList[j];
      var tranY = yStep * moveNum;
      var sItem = sList[j];
      // sItem.transform('t0,' + tranY);
      sItem.animate({transform: 't0,' + tranY}, 1000, "backIn");
    }
  };
	//画图
  Matrix.prototype.render = function () {
    $('#' + this.node).append(this.floatTag);
    var floatTag = this.floatTag;

    var conf = this.defaults;
    var hasMash = conf.hasMash;
    var colors = conf.colors;
    var fontStyle = conf.fontStyle;
    var ntp = conf.nTextPadding;
    var level = conf.level;
    var paper = this.paper;

    var doneData = this.doneData;
    var dataTable = this.dataTable;
    var nameList = this.nameList;
    var courseList = this.courseList;
    var startX = this.startX;
    var startY = this.startY;
    var xStep = this.xStep;
    var yStep = this.yStep;

    var fontH = this.fontH;
    var cNum = courseList.length;
    var cTitleList = paper.set();
    var cx = startX + xStep / 2 + 0.5;
    var cy = startY - fontH / 2 + 0.5;
    for (var i = 0; i < cNum; i++) {
      var cName = courseList[i];
      var cText = paper.text(cx, cy, cName).attr(fontStyle);
      cText.attr({'text-anchor': 'middle'});
      cText.data('name', cName);
      cTitleList.push(cText);
      cx += xStep;
    }

    var studentList = [];
    var sNum = nameList.length;
    var x = startX + 0.5; //确认圆心的位置，x轴
    var y = startY + yStep / 2 + 0.5;//确认圆心的位置，y轴
    for (var i = 0; i < sNum; i++) {
      var item = doneData[i];
      var st = paper.set();
      var nameText = paper.text(x - ntp, y, nameList[i]).attr(fontStyle);
      st.push(nameText);
      for (var j = 0; j < cNum; j++) {
        var num = i * cNum + j; // 第i个学生的第j个知识点
        var data = dataTable[num];
        var radius = data.radius;//选择半径
        var tlevel = data.level;//选择透明度
        var color = colors[j];//选择颜色
        var circle = paper.circle(x + xStep / 2, y, radius /1.5).attr({'fill': color, 'stroke': 'none','fill-opacity': _.max([tlevel, 0.4])});
        circle.data('count', data.data);
        circle.data('ccount', data.cData);
        circle.data('percent', data.correctPct);
        circle.mouseover(function () {
          floatTag.html('<div style = "text-align: center;margin:auto;color:#ffffff">' + '做题数：' + this.data('count') + '<br>' + '正确率：' + this.data('percent') + '%' + '</div>');
          floatTag.css({"visibility" : "visible"});
        }).mouseout(function () {
          floatTag.css({"visibility" : "hidden"});
        });
        st.push(circle);
        x += xStep;
      }
      studentList.push(st);
      x = startX;
      y += yStep;
    }

    this.studentList = studentList;

    if (hasMash) {
      var rW = this.rW;
      var rH = this.rH;
      var mashStyle = conf.mashStyle;

      var mx = startX + 0.5;
      var my = startY + 0.5;
      var xEnd = startX + rW + 0.5;
      paper.path(['M', mx, my, 'L', xEnd, my]).attr(mashStyle);
      for (var i = 0; i < sNum; i++) {
        my += yStep;
        paper.path(['M', mx, my, 'L', xEnd, my]).attr(mashStyle);
      } 

      var mx = startX + 0.5;
      var my = startY + 0.5;
      var yEnd = startY + rH + 0.5;
      paper.path(['M', mx, my, 'L', mx, yEnd]).attr(mashStyle);
      for (var i = 0; i < cNum; i++) {
        mx += xStep;
        paper.path(['M', mx, my, 'L', mx, yEnd]).attr(mashStyle);
      } 
    }
  };
}(window.Chart = window.Chart || {}));