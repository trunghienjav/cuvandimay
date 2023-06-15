<form action="{{ route('process_login') }}" method="post">
    @csrf
    Email
    <input type="email" name="email">
    <br>
    Password
    <input type="password" name="password">
    <br>
    <button>Login</button>
</form>
