@extends('layouts.master')
@section('content')
    <div id="content"></div>
    <script>
        var last_update = 0;
        var last_x = 0;
        var last_y = 0;
        var last_z = 0;
        var SHAKE_THRESHOLD = 1000;

        if (window.DeviceMotionEvent) {
            window.addEventListener('devicemotion', deviceMotionHandler, false);
        } else {
            $("#content").html("你的手机太差了，买个新的吧。");
        }

        function deviceMotionHandler(eventData) {
            var acceleration = eventData.accelerationIncludingGravity;
            var curTime = new Date().getTime();

            if ((curTime - last_update) > 100) {
                var diffTime = curTime - last_update;
                last_update = curTime;
                x = acceleration.x;
                y = acceleration.y;
                z = acceleration.z;
                var speed = Math.abs(x + y + z - last_x - last_y - last_z) / diffTime * 10000;
                var status = document.getElementById("status");

                if (speed > SHAKE_THRESHOLD) {
                    doResult(speed);
                }
//                doResult(speed);
                last_x = x;
                last_y = y;
                last_z = z;
            }
        }

        function doResult(speed) {
            $("#content").html("当前speed=" + speed);
        }
    </script>
@endsection