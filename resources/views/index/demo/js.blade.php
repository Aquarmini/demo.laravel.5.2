@extends('layouts.master')
@section('content')
    <code>
        <pre>
        var a = {"val": 1};
        console.log(a.val);
        test(a);
        console.log(a.val);
        function test(a) {
            console.log(++a.val);
        }

        var b = 1;
        console.log(b);
        test2(b);
        console.log(b);
        function test2(a) {
            console.log(++a);
        }
        </pre>

    </code>
    <script>

        var a = {"val": 1};
        console.log(a.val);
        test(a);
        console.log(a.val);
        function test(a) {
            console.log(++a.val);
        }

        var b = 1;
        console.log(b);
        test2(b);
        console.log(b);
        function test2(a) {
            console.log(++a);
        }

    </script>
@endsection