(function() {
    'use strict';

    angular
        .module('app.cores', [
            'app.cores.basic',
            'app.cores.services'
        ])
        .directive('amapDirective', function($scope) {

            return {

              restrict: 'EA',
              templateUrl: 'app/cores/directives/amap.html',
              scope: {
                lng: '=', //纬线
                lat: '=', //经线
                path: '&', //运动轨迹
                timeout: '=' //轨迹运行速度
              },
              controller: function($scope) {

                  $scope.AMapId = 'amap-container'; //高德地图的存放容器
                  $scope.mapObj; //获得的初始化高德地图对象

                  $scope.markerClickListener; //点击界面添加标记监听器

                  if(typeof $scope.timeout == 'undefined') {
                    $scope.timeout = 500;
                  }

                  $scope.initAMap = function() {

                    if(typeof $scope.lng == 'undefined') {
                      $scope.lng = 116.397428;
                    }

                    if(typeof $scope.lat == 'undefined') {
                      $scope.lng = 39.90923;
                    }

                    var position = new AMap.LngLat($scope.lng,$scope.lat); //初始化默认坐标
                    $scope.mapObj = new AMap.Map($scope.AMapId,{
                      view:new AMap.View2D({
                        center:position,
                        zoom:14,
                        rotation:0
                      }),
                      lang:'zh_cn'
                    });
                  };

                  $scope.ListenClick = function() {
                    $scope.markerClickListener=AMap.event.addListener($scope.mapObj,'click',function(e){
                      var lnglat=e.lnglat;
                      marker=new AMap.Marker({
                        map:$scope.mapObj,
                        position:e.lnglat,
                        icon:"http://webapi.amap.com/images/0.png",
                        offset:new AMap.Pixel(-10,-34) 
                      });
                      $scope.mapObj.setCenter(lnglat);
                    });
                  };

                  $scope.removeMarkerListener = function() {
                    AMap.event.removeListener($scope.markerClickListener); //移除事件
                  };

                  $scope.initAMap();
                  $scope.ListenClick();

                  var lineArr = $scope.path();

                  //给lineArr设置默认值
                  if(typeof lineArr == 'undefined') {
                    var lngX = $scope.lng;
                    var latY = $scope.lat;
                    var lineArr = [];
                    lineArr.push([lngX, latY]);
                    for (var i = 1; i < 3; i++) {
                      lngX = lngX + Math.random() * 0.05;
                      if (i % 2) {
                        latY = latY + Math.random() * 0.0001;
                      } else {
                        latY = latY + Math.random() * 0.06;
                      }
                      lineArr.push([lngX, latY]);
                    }
                  }

                  //绘制轨迹
                  var polyline = new AMap.Polyline({
                      map: $scope.mapObj,
                      path: lineArr,
                      strokeColor: "#00A",  //线颜色
                      strokeOpacity: 1,     //线透明度
                      strokeWeight: 3,      //线宽
                      strokeStyle: "solid"  //线样式
                  });

                  $scope.mapObj.setFitView();

                  var markerPerson = new AMap.Marker({
                    map: $scope.mapObj,
                    position: [$scope.lng, $scope.lat],
                    icon: "http://code.mapabc.com/images/car_03.png",
                    offset: new AMap.Pixel(-26, -13),
                    autoRotation: true
                  });

                  $scope.startAnimation = function() {
                    markerPerson.moveAlong(lineArr, $scope.timeout);//开始动画
                  };

                  $scope.stopAnimation = function() {
                    markerPerson.stopMove();//结束动画
                  };

              }
            }

          });

})();
