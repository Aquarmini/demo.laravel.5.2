@extends('layouts.master')
@section('content')
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
    </script>
@endsection