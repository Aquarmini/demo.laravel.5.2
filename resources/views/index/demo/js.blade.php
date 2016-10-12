@extends('layouts.master')
@section('content')
    <code>
        <pre>
        aa();
        function aa() {
            var a = {
                "val": 1
            };
            conLog(a);bb(a);conLog(a);

            var b = 1;
            conLog(b);cc(b);conLog(b);
        }

        function bb(a) {
            ++a.val
            conLog(a);
        }

        function cc(a) {
            ++a;
            conLog(a);
        }
        </pre>

    </code>
    <script>
        aa();
        function aa() {
            var a = {
                "val": 1
            };
            conLog(a);
            bb(a);
            conLog(a);

            var b = 1;
            conLog(b);
            cc(b);
            conLog(b);
        }

        function bb(a) {
            ++a.val
            conLog(a);
        }

        function cc(a) {
            ++a;
            conLog(a);
        }


//        var a = {"val": 1};
//        console.log(a.val);
//        test(a);
//        console.log(a.val);
//
//        function test(a) {
//            console.log(++a.val);
//        }
    </script>
@endsection