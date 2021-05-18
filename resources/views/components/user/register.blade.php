<div id="registerModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <div class="loginformblock">
                    <h4 class="text-center">
                        Register an Account
                    </h4>
                    <form action="{{route('register')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" maxlength="30" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Your Name" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Your Email" />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                        </div>
                        <button type="submit" class="btn btn-lg btn-block px-5 btn-warning">
                            Sign up
                        </button>
                    </form>
                    <div class="text-center mt-3">
                        Already have an account?
                        <a href="javascript:void(0);" onclick="getLoginForm();">
                            Sign in here.
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