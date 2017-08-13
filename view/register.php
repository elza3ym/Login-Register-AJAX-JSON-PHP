<form action="#" method="post" id="login-form">
    <input type="text" id="name" name="name" class="input-control" placeholder="Name" >
    <input type="email" id="email" name="email" class="input-control" placeholder="Email Address" >
    <input type="password" id="password" name="password" class="input-control" placeholder="Password" pattern=".{6,}" >
    <input type="password" id="password_confirmation" name="password_confirmation" class="input-control" placeholder="Confirm Password" pattern=".{6,}" >
    <input type="text" id="phone" name="phone" class="input-control" placeholder="Phone Number" >
    <button id="register" class="btn-submit btn-primary">Register</button>
</form>
<p class="lead">Already have account? Please click on login</p>
<button onclick="login()" class="btn-submit">Login</button>