<div id="loginModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <div class="loginformblock">
                    <h4 class="text-center">
                        Log In Your Account
                    </h4>
                    <form action="{{route('login')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Your Email" />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="GlobalGarner@2016" />
                        </div>
                        <button type="submit" class="btn btn-lg btn-block px-5 btn-warning">
                            Login
                        </button>
                    </form>
                    <div class="text-center mt-3">
                        Don't have an account?
                        <a href="javascript:void(0);" onclick="getSignupForm();">
                            Sign up here.
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#loginModal').on('hidden.bs.modal', function() {
        location.reload();
    });
    $('#registerModal').on('hidden.bs.modal', function() {
        location.reload();
    });
</script>