<!DOCTYPE html>
<html lang="en">

<head>
    @include('common.head')
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('common.sidebar')

        <!-- Page Content -->
        <div id="content">
            @include('common.navbar')

            <div class="main">
                <div class="main-content">
                    @include('components.error')
                    <div id="modal-content">
                        <!-- Modal will be placed -->
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <div class="overlaybg" id="overlay"></div>

    @include('common.scripts')

    @yield('add-script')

    @auth()
    @else

    @if(session()->has('login'))
    <script>
        $(function() {
            getLoginForm();
        });
    </script>
    @endif

    <script>
        $('.login-button').click(function() {
            getLoginForm();
        });

        function getLoginForm() {
            $('#registerModal').modal('hide');
            $('#modal-content').html('');
            var _url = "{{ route('login') }}";
            var _method = 'GET';
            var _data = {};

            $.ajax({
                url: _url,
                type: _method,
                data: _data,
                success: function(response) {
                    $('#modal-content').html(response);
                    $('#loginModal').modal('show');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                    $('#modal-content').html('');
                    // location.reload();
                }
            });
        }
    </script>
    <script>
        $('.signup-button').click(function() {
            getSignupForm();
        });

        function getSignupForm() {
            $('#loginModal').modal('hide');
            $('#modal-content').html('');
            var _url = "{{ route('register') }}";
            var _method = 'GET';
            var _data = {};

            $.ajax({
                url: _url,
                type: _method,
                data: _data,
                success: function(response) {
                    $('#modal-content').html(response);
                    $('#registerModal').modal('show');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                    $('#modal-content').html('');
                    // location.reload();
                }
            });
        }
    </script>
    @endauth

    <script>
        function setLanguage(lang) {
            location.href = "{{url('setlocale')}}/" + lang;
        }
    </script>


</body>

</html>